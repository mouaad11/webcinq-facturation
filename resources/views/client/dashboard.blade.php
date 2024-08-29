<!-- dashboard.blade.php -->
@extends('nav-client')

@section('title', 'Webcinq - Tableau de bord Client')

@section('content')
    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Tableau de bord Client</strong> Webcinq</h1>

        <!-- Client Analytics Section -->
        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Total Factures</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="file-text"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalInvoices }}</h1>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Factures Payées</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ number_format($totalPaidAmount, 2) }} DH</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Factures Non Payées</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="alert-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ number_format($totalUnpaidAmount, 2) }} DH</h1>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Nombre de Devis</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="file"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalClientQuotes }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Statut des Factures</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="chartjs-dashboard-pie"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Invoices Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Factures Récentes</h5>
                    </div>
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
                                @foreach ($recentInvoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->id }}</td>
                                        <td>{{ number_format($invoice->total_amount, 2) }} DH</td>
                                        <td>{{ $invoice->date instanceof \Carbon\Carbon ? $invoice->date->format('d/m/Y') : $invoice->date }}</td>
                                        <td>{{ $invoice->due_date instanceof \Carbon\Carbon ? $invoice->due_date->format('d/m/Y') : $invoice->due_date }}</td>
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
                        <div class="text-center mt-3">
                            <a href="{{ route('client.invoices.index') }}" class="btn btn-primary">Voir toutes les factures</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pie chart for invoice status
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: ["Payées", "Non Payées"],
                    datasets: [{
                        data: [{{ $paidPercentage }}, {{ $unpaidPercentage }}],
                        backgroundColor: [
                            window.theme.success,
                            window.theme.danger
                        ],
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            boxWidth: 20,
                            padding: 15,
                            fontSize: 14,
                            fontColor: '#333',
                        }
                    },
                    cutoutPercentage: 75
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function fetchUnreadMessages() {
                fetch('/unread-messages')
                    .then(response => response.json())
                    .then(messages => {
                        const messageList = document.getElementById('message-list');
                        const unreadCount = document.getElementById('unread-count');

                        messageList.innerHTML = '';
                        unreadCount.textContent = messages.length;

                        messages.forEach(message => {
                            const timeDiff = new Date() - new Date(message.created_at);
                            const timeAgo = Math.floor(timeDiff / (1000 * 60)) + 'm ago';

                            messageList.innerHTML += `
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded-circle" alt="${message.sender.name}">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark">${message.sender.name} <i>${message.sender.role}</i></div>
                                        <div class="text-muted small mt-1">${message.content}</div>
                                        <div class="text-muted small mt-1">${timeAgo}</div>
                                    </div>
                                </div>
                            </a>
                            `;
                        });
                    });
            }

            fetchUnreadMessages();
            setInterval(fetchUnreadMessages, 60000); // Refresh every minute
        });
    </script>
@endsection