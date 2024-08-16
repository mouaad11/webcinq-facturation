@extends('template')

@section('title','Factures')
<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />

@section('content')
<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />

<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Mes Factures</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Numéro de Facture</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Échéance</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ number_format($invoice->total_amount, 2) }} DH</td>
                                <td>{{ $invoice->date->format('d/m/Y') }}</td>
                                <td>{{ $invoice->due_date->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : 'danger' }}">
                                        {{ $invoice->status == 'paid' ? 'Payée' : 'Non payée' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('detail_invoice', ['type' => 'sent', 'id' => $invoice->id]) }}" class="btn btn-sm btn-primary">Voir</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection