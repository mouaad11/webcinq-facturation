<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Devis;
use App\Models\Invoice;
use App\Models\invoice_item;
use App\Models\InvoiceItem;
use App\Models\CompanyInfo;
use App\Models\DevisRecu;
use App\Models\ReceivedInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Client_contr extends Controller
{

    public function indexShowAll()
    {
        $clients = Client::all();

        foreach ($clients as $client) {
            $client->invoices_count = Invoice::where('client_id', $client->id)->count();
        }

        return view('clients.indexShowAll', compact('clients'));

    }
    public function dashboard()
    {
        $user = Auth::user();
        if (!$user || !$user->isClient()) {
            return redirect()->route('login')->with('error', 'Access denied.');
        }

        // Find the client associated with the user
        $client = Client::where('user_id', $user->id)->first();

        if (!$client) {
            return redirect()->route('home')->with('error', 'Client profile not found. Please contact support.');
        }

        $clientId = $client->id;

        $recentInvoices = Invoice::with(['client', 'companyinfo', 'invoice_items'])
            ->where('client_id', $clientId)
            ->latest()
            ->take(5)
            ->get();

        $recentQuotes = Devis::with(['client', 'companyinfo', 'devis_items'])
            ->where('client_id', $clientId)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($quote) {
                // Check if the quote has been converted to an invoice (meaning it's accepted)
                $isAccepted = devis::where('id', $quote->id)
                    ->where('client_id', $quote->client_id)
                    ->where('status', 1)
                    ->exists();

                $quote->status = $isAccepted ? 'Accepté' : 'Non Accepté';
                return $quote;
            });

        $totalInvoices = Invoice::where('client_id', $clientId)->count();
        $totalPaidAmount = Invoice::where('client_id', $clientId)->where('status', 'paid')->sum('total_amount');
        $totalUnpaidAmount = Invoice::where('client_id', $clientId)->where('status', 'unpaid')->sum('total_amount');
        $averageInvoiceValue = Invoice::where('client_id', $clientId)->avg('total_amount');

        // Add this line to get the total number of quotes
        $totalClientQuotes = Devis::where('client_id', $clientId)->count();

        // Calculate growth percentages
        $lastMonth = Carbon::now()->subMonth();
        $invoiceGrowth = $this->calculateGrowth(Invoice::class, $lastMonth, ['client_id' => $clientId]);
        $paidGrowth = $this->calculateGrowth(Invoice::class, $lastMonth, ['client_id' => $clientId, 'status' => 'paid']);
        $unpaidGrowth = $this->calculateGrowth(Invoice::class, $lastMonth, ['client_id' => $clientId, 'status' => 'unpaid']);
        $averageGrowth = $this->calculateAverageGrowth(Invoice::class, $lastMonth, ['client_id' => $clientId]);

        // Calculate percentages for pie chart
        $totalInvoiceCount = Invoice::where('client_id', $clientId)->count();
        $paidCount = Invoice::where('client_id', $clientId)->where('status', 'paid')->count();
        $paidPercentage = ($totalInvoiceCount > 0) ? round(($paidCount / $totalInvoiceCount) * 100, 2) : 0;
        $unpaidPercentage = 100 - $paidPercentage;

        // Get monthly revenue data for line chart
        $monthlyRevenue = $this->getMonthlyRevenue($clientId);

        return view('client.dashboard', compact(
            'recentInvoices',
            'recentQuotes',
            'totalInvoices',
            'totalPaidAmount',
            'totalUnpaidAmount',
            'averageInvoiceValue',
            'totalClientQuotes',  // Add this line
            'invoiceGrowth',
            'paidGrowth',
            'unpaidGrowth',
            'averageGrowth',
            'paidPercentage',
            'unpaidPercentage',
            'monthlyRevenue'
        )
        );
    }
    private function calculateGrowth($model, $date, $conditions = [])
    {
        $currentCount = $model::where($conditions)->count();
        $previousCount = $model::where($conditions)->where('created_at', '<', $date)->count();

        if ($previousCount > 0) {
            return round((($currentCount - $previousCount) / $previousCount) * 100, 2);
        }

        return 0;
    }

    private function calculateAverageGrowth($model, $date, $conditions = [])
    {
        $currentAvg = $model::where($conditions)->where('created_at', '>=', $date)->avg('total_amount');
        $previousAvg = $model::where($conditions)->where('created_at', '<', $date)->avg('total_amount');

        if ($previousAvg > 0) {
            return round((($currentAvg - $previousAvg) / $previousAvg) * 100, 2);
        }

        return 0;
    }

    private function getMonthlyRevenue($clientId)
    {
        $monthlyRevenue = [];
        $startDate = now()->startOfMonth();

        for ($i = 0; $i < 12; $i++) {
            $month = $startDate->copy()->subMonths($i);
            $revenue = Invoice::where('client_id', $clientId)
                ->whereYear('date', $month->year)
                ->whereMonth('date', $month->month)
                ->sum('total_amount');

            $monthlyRevenue[$month->format('M Y')] = $revenue;
        }

        return array_reverse($monthlyRevenue);
    }

    public function invoicesIndex()
    {
        $clientId = Auth::user()->client->id;
        $invoices = Invoice::where('client_id', $clientId)->orderBy('date', 'desc')->paginate(10);
        return view('client.invoices.index', compact('invoices'));
    }

    public function devisIndex()
    {
        $clientId = Auth::user()->client->id;
        $devis = Devis::where('client_id', $clientId)->orderBy('date', 'desc')->paginate(10);
        return view('client.devis.index', compact('devis'));
    }

    public function devisAccept($id)
    {
        $devis = Devis::findOrFail($id);
        $devis->status = 1;
        $devis->save();
        if ($devis->client_id != Auth::user()->client->id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accepter ce devis.');
        }

        $invoice = new Invoice();
        $invoice->client_id = $devis->client_id;
        $invoice->companyinfo_id = $devis->companyinfo_id;
        $invoice->date = now();
        $invoice->due_date = now()->addDays(30);
        $invoice->status = 'unpaid';
        $invoice->type = 'reçu';
        $invoice->fromdevis = 1; // Set this to 1 as it's converted from a devis
        $invoice->save();

        // Convert devis items to invoice items
        foreach ($devis->devis_items as $devisItem) {
            invoice_item::create([
                'description' => $devisItem->description,
                'quantity' => $devisItem->quantity,
                'unit_price' => $devisItem->unit_price,
                'tva' => $devisItem->tva,
                'invoice_id' => $invoice->id,
            ]);
        }


        return redirect()->route('invoices.index')->with('success', 'Le devis a été accepté et converti en facture avec succès. Délai maximal pour payer votre facture: 30 jours');
    }


}