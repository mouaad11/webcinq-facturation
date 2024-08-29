@extends('template')

@section('title', 'Webcinq - Facturation')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="shortcut icon" href="img/icons/icon-48x48.png"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <link rel="canonical" href="https://demo-basic.adminkit.io/" />

        <title>Webcinq - Facturation</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    </head>

    <body>
        <div class="wrapper">


            <div class="main">


                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h1 class="h3 mb-3"> Analytiques des factures <strong>envoyées</strong> par Webcinq (Factures de vente)</h1>
                <!-- Analytics Section -->
                <div class="row mt-4">
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
                                            @if ($invoiceGrowth > 0)
                                                <div class="mb-0">
                                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                        {{ $invoiceGrowth }}% </span>
                                                    <span class="text-muted">Depuis le mois dernier</span>
                                                </div>
                                            @else
                                                <div class="mb-0">
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                        {{ $invoiceGrowth }}% </span>
                                                    <span class="text-muted">Depuis le mois dernier</span>
                                                </div>
                                            @endif
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
                                            @if ($paidGrowth > 0)
                                                <div class="mb-0">
                                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                        {{ $paidGrowth }}%
                                                    </span>
                                                    <span class="text-muted">Depuis le mois dernier</span>
                                                </div>
                                            @else
                                                <div class="mb-0">
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                        {{ $paidGrowth }}%
                                                    </span>
                                                    <span class="text-muted">Depuis le mois dernier</span>
                                                </div>
                                            @endif
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
                                            @if ($unpaidGrowth >= 0)
                                                <div class="mb-0">
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                        {{ $unpaidGrowth }}% </span>
                                                    <span class="text-muted">Depuis le mois dernier</span>
                                                </div>
                                            @else
                                                <div class="mb-0">
                                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                        {{ $unpaidGrowth }}% </span>
                                                    <span class="text-muted">Depuis le mois dernier</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Valeur Moyenne des Factures</h5>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="shopping-cart"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{ number_format($averageInvoiceValue, 2) }} DH</h1>
                                            @if ($averageGrowth > 0)
                                                <div class="mb-0">
                                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                        {{ $averageGrowth }}% </span>
                                                    <span class="text-muted">Depuis le mois dernier</span>
                                                </div>
                                            @else
                                                <div class="mb-0">
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                        {{ $averageGrowth }}% </span>
                                                    <span class="text-muted">Depuis le mois dernier</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-xxl-7">
                        <div class="card flex-fill w-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Revenus Mensuels</h5>
                            </div>
                            <div class="card-body py-3">
                                <div class="chart chart-sm">
                                    <canvas id="chartjs-dashboard-line"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 d-flex mx-auto">
                        <div class="card flex-fill w-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Statut des Factures</h5>
                            </div>
                            <div class="card-body d-flex">
                                <div class="align-self-center w-100">
                                    <div class="py-3">
                                        <div class="chart chart-xs">
                                            <canvas id="chartjs-dashboard-pie"></canvas>
                                        </div>
                                    </div>
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Payées</td>
                                                <td class="text-end">{{ $paidPercentage }}%</td>
                                            </tr>
                                            <tr>
                                                <td>Non Payées</td>
                                                <td class="text-end">{{ $unpaidPercentage }}%</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                                            <th>Numéro</th>
                                            <th>Type</th>
                                            <th>Client</th>
                                            <th>Entreprise</th>
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
                                                <td>{{ $invoice->type }}</td>
                                                <td>{{ $invoice->client->name }}</td>
                                                <td>{{ $invoice->companyinfo->name }}</td>
                                                <td>{{ number_format($invoice->total_amount, 2) }} DH</td>
                                                <td>{{ $invoice->date instanceof \Carbon\Carbon ? $invoice->date->format('d/m/Y') : $invoice->date }}
                                                </td>
                                                <td>{{ $invoice->due_date instanceof \Carbon\Carbon ? $invoice->due_date->format('d/m/Y') : $invoice->due_date }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $invoice->status == 'paid' ? 'success' : 'danger' }}">
                                                        {{ $invoice->status == 'paid' ? 'Payée' : 'Non payée' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('detail_invoice', ['type' => 'sent', 'id' => $invoice->id]) }}"
                                                        class="btn btn-sm btn-primary">Voir</a>
                                                    <a href="{{ route('invoices.edit', $invoice->id) }}"
                                                        class="btn btn-sm btn-warning">Modifier</a>
                                                    <form action="{{ route('invoices.destroy', $invoice->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture?')">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-3">
                                    <a href="{{ route('invoices.index') }}" class="btn btn-primary">Voir toutes les
                                        factures</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clients Table -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Clients</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Adresse</th>
                                            <th>Téléphone</th>
                                            <th>Nombre de Factures</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                            <tr>
                                                <td>{{ $client->name }}</td>
                                                <td>{{ $client->address }}</td>
                                                <td>{{ $client->tel }}</td>
                                                <td>{{ $client->invoices_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-3">
                                    <a href="{{ route('clients.indexShowAll') }}" class="btn btn-primary">Voir tous
                                        les clients</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Companies Table -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Entreprises</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Adresse</th>
                                            <th>Ville</th>
                                            <th>Téléphone</th>
                                            <th>Email</th>
                                            <th>Nombre de Factures</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr>
                                                <td>{{ $company->name }}</td>
                                                <td>{{ $company->adress }}</td>
                                                <td>{{ $company->city }}</td>
                                                <td>{{ $company->tel }}</td>
                                                <td>{{ $company->email }}</td>
                                                <td>{{ $company->invoices_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-3">
                                    <a href="{{ route('company_info') }}" class="btn btn-primary">Voir toutes les
                                        entreprises</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Quotes Table -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Devis Récents</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>Numéro de Devis</th>
                                            <th>Client</th>
                                            <th>Entreprise</th>
                                            <th>Montant</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentQuotes as $quote)
                                            <tr>
                                                <td>{{ $quote->id }}</td>
                                                <td>{{ $quote->client->name }}</td>
                                                <td>{{ $quote->companyinfo->name }}</td>
                                                <td>{{ number_format($quote->total_amount, 2) }} DH</td>
                                                <td>{{ $quote->date instanceof \Carbon\Carbon ? $quote->date->format('d/m/Y') : $quote->date }}
                                                </td>
                                                <td>
                                                    @if ($quote->status == 'Accepté')
                                                        <span class="badge bg-success">{{ $quote->status }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ $quote->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('detail_devis', ['type' => 'sent', 'id' => $quote->id]) }}"
                                                        class="btn btn-sm btn-primary">Voir</a>
                                                        @if ($quote->status == 'Non Accepté')
                                                        <form action="{{ route('client.devis.accept', $quote->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Êtes-vous sûr de vouloir accepter ce devis?')">Accepter</button>
                                                        </form>
                                                        @endif
                                                    <a href="{{ route('devis.edit', $quote->id) }}"
                                                        class="btn btn-sm btn-warning">Modifier</a>
                                                    <form action="{{ route('devis.destroy', $quote->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce devis?')">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-3">
                                    <a href="{{ route('devis.index') }}" class="btn btn-primary">Voir tous les
                                        devis</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>



        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
                var gradient = ctx.createLinearGradient(0, 0, 0, 225);
                gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
                gradient.addColorStop(1, "rgba(215, 227, 244, 0)");

                var monthlyRevenue = @json($monthlyRevenue);
                var labels = Object.keys(monthlyRevenue);
                var data = Object.values(monthlyRevenue);

                new Chart(document.getElementById("chartjs-dashboard-line"), {
                    type: "line",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Revenus (DH)",
                            fill: true,
                            backgroundColor: gradient,
                            borderColor: window.theme.primary,
                            data: data
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            intersect: false
                        },
                        hover: {
                            intersect: true
                        },
                        plugins: {
                            filler: {
                                propagate: false
                            }
                        },
                        scales: {
                            xAxes: [{
                                reverse: true,
                                gridLines: {
                                    color: "rgba(0,0,0,0.0)"
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    stepSize: 1000
                                },
                                display: true,
                                borderDash: [3, 3],
                                gridLines: {
                                    color: "rgba(0,0,0,0.0)"
                                }
                            }]
                        }
                    }
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
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
                            display: true, // Enable the legend
                            position: 'bottom', // Position of the legend (bottom, top, left, right)
                            labels: {
                                boxWidth: 20, // Width of the color box
                                padding: 15, // Padding between legend items
                                fontSize: 14, // Font size for legend text
                                fontColor: '#333', // Font color for legend text
                            }
                        },
                        cutoutPercentage: 75
                    }
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Bar chart
                new Chart(document.getElementById("chartjs-dashboard-bar"), {
                    type: "bar",
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                            "Dec"
                        ],
                        datasets: [{
                            label: "This year",
                            backgroundColor: window.theme.primary,
                            borderColor: window.theme.primary,
                            hoverBackgroundColor: window.theme.primary,
                            hoverBorderColor: window.theme.primary,
                            data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: false
                                },
                                stacked: false,
                                ticks: {
                                    stepSize: 20
                                }
                            }],
                            xAxes: [{
                                stacked: false,
                                gridLines: {
                                    color: "transparent"
                                }
                            }]
                        }
                    }
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
                var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
                document.getElementById("datetimepicker-dashboard").flatpickr({
                    inline: true,
                    prevArrow: "<span title=\"Previous month\">&laquo;</span>",
                    nextArrow: "<span title=\"Next month\">&raquo;</span>",
                    defaultDate: defaultDate
                });
            });


            document.addEventListener("DOMContentLoaded", function() {
                var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
                var gradient = ctx.createLinearGradient(0, 0, 0, 225);
                gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
                gradient.addColorStop(1, "rgba(215, 227, 244, 0)");

                new Chart(document.getElementById("chartjs-dashboard-line"), {
                    type: "line",
                    data: {
                        labels: {!! json_encode(array_keys($monthlyRevenue)) !!},
                        datasets: [{
                            label: "Revenus (DH)",
                            fill: true,
                            backgroundColor: gradient,
                            borderColor: window.theme.primary,
                            data: {!! json_encode(array_values($monthlyRevenue)) !!}
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            intersect: false
                        },
                        hover: {
                            intersect: true
                        },
                        plugins: {
                            filler: {
                                propagate: false
                            }
                        },
                        scales: {
                            xAxes: [{
                                reverse: true,
                                gridLines: {
                                    color: "rgba(0,0,0,0.0)"
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    stepSize: 1000
                                },
                                display: true,
                                borderDash: [3, 3],
                                gridLines: {
                                    color: "rgba(0,0,0,0.0)"
                                }
                            }]
                        }
                    }
                });
            });
        </script>

@endsection
