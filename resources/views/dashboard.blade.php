<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Webcinq - Facturation</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ '/dashboard' }}">
                    <img src="{{ asset('/webcinq_logo.png') }}" height="30" alt="webcinq" loading="lazy" />

                    <span class="align-middle">Admin</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="dashboard.blade.php">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Tableau de
                                bord</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-profile.html">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('login') }}">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Changer de
                                compte</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('sign_up') }}">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Créer un
                                nouveau compte</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('validation_list') }}">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Demandes de
                                validation du compte</span>
                        </a>
                    </li>



                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('invoice_form') }}">
                            <i class="align-middle me-2" data-feather="edit"></i> <span class="align-middle">Ajouter une facture</span>
                        </a>
                    </li>

					<li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('devis_form_client') }}">
                            <i class="align-middle me-2" data-feather="edit"></i> <span class="align-middle">Ajouter un devis</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('company_info') }}">
                            <i class="align-middle me-2" data-feather="list"></i> <span class="align-middle">Liste des entreprises</span>
                        </a>
                    </li>

                </ul>

                <div class="sidebar-cta">
                    <div class="sidebar-cta-content">
                        <strong class="d-inline-block mb-2">Visiter notre site web</strong>
                        <div class="mb-3 text-sm">
                            Vous voulez d'autres services et solutions digiteles? visitez notre site web.
                        </div>
                        <div class="d-grid">
                            <a href="https://webcinq.com/" target=”_blank” class="btn btn-primary">Webcinq</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                    <span class="indicator" id="unread-count"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        Nouveaux Messages
                                    </div>
                                </div>
                                <div class="list-group" id="message-list">
                                    <!-- Messages will be inserted here -->
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="{{ route('messages.index') }}" class="text-muted">Show all messages</a>
                                </div>
                            </div>
                        </li>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
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
															<img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="${message.sender.name}">
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
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1"
                                    alt="profil" /> <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{route('setting')}}"><i class="align-middle me-1"
                                        data-feather="user"></i> Profil</a>
                                <div class="dropdown-divider"></div>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button class="dropdown-item">Log out</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>Suivi de Facturation</strong> Webcinq</h1>
			
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
											@foreach($recentInvoices as $invoice)
											<tr>
												<td>{{ $invoice->id }}</td>
												<td>{{ $invoice->client->name }}</td>
												<td>{{ $invoice->companyinfo->name }}</td>
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
													<a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture?')">Supprimer</button>
                                                    </form>
                                                </td>
											</tr>
											@endforeach
										</tbody>
									</table>
									<div class="text-center mt-3">
										<a href="{{ route('invoices.index') }}" class="btn btn-primary">Voir toutes les factures</a>
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
											@foreach($clients as $client)
											<tr>
												<td>{{ $client->name }}</td>
												<td>{{ $client->adress }}</td>
												<td>{{ $client->tel }}</td>
												<td>{{ $client->invoices_count }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									<div class="text-center mt-3">
										<a href="{{ route('clients.indexShowAll') }}" class="btn btn-primary">Voir tous les clients</a>
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
											@foreach($companies as $company)
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
										<a href="{{ route('company_info') }}" class="btn btn-primary">Voir toutes les entreprises</a>
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
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											@foreach($recentQuotes as $quote)
											<tr>
												<td>{{ $quote->id }}</td>
												<td>{{ $quote->client->name }}</td>
												<td>{{ $quote->companyinfo->name }}</td>
                                                <td>{{ $quote->date instanceof \Carbon\Carbon ? $quote->date->format('d/m/Y') : $quote->date }}</td>
                                                <td>{{ $quote->due_date instanceof \Carbon\Carbon ? $quote->due_date->format('d/m/Y') : $quote->due_date }}</td>
												<td>
													<a href="{{  route('detail_devis', ['type' => 'sent', 'id' => $quote->id]) }}" class="btn btn-sm btn-primary">Voir</a>
													<a href="{{ route('devis.edit', $quote->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                                    <form action="{{ route('devis.destroy', $quote->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce devis?')">Supprimer</button>
                                                    </form>
                                                </td>
											</tr>
											@endforeach
										</tbody>
									</table>
									<div class="text-center mt-3">
										<a href="{{ route('devis.index') }}" class="btn btn-primary">Voir tous les devis</a>
									</div>
								</div>
							</div>
						</div>
					</div>
			
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
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $invoiceGrowth }}% </span>
													<span class="text-muted">Depuis le mois dernier</span>
												</div>
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
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $paidGrowth }}% </span>
													<span class="text-muted">Depuis le mois dernier</span>
												</div>
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
												<div class="mb-0">
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $unpaidGrowth }}% </span>
													<span class="text-muted">Depuis le mois dernier</span>
												</div>
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
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $averageGrowth }}% </span>
													<span class="text-muted">Depuis le mois dernier</span>
												</div>
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
						<div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
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
				</div>
			</main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted"></a><a class="text-muted"><strong>Tous les droits sont
                                        réservés</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://webcinq.com/contact/"
                                        target="_blank">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="/js/app.js"></script>

    <script>
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
                display: false
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
            var markers = [{
                    coords: [33.5731, -7.5898],
                    name: "Casablanca"
                },
                {
                    coords: [31.6295, -7.9811],
                    name: "Marrakesh"
                },
                {
                    coords: [34.0209, -6.8416],
                    name: "Rabat"
                },
                {
                    coords: [35.7595, -5.8340],
                    name: "Tangier"
                },
                {
                    coords: [33.9716, -6.8498],
                    name: "Salé"
                }
                // Add more Moroccan cities or client locations as needed
            ];

            var map = new jsVectorMap({
                map: "morocco", // You'll need to ensure you have the Morocco map data
                selector: "#morocco_map", // Update the selector to match your HTML
                zoomButtons: true,
                markers: markers,
                markerStyle: {
                    initial: {
                        r: 9,
                        strokeWidth: 7,
                        stokeOpacity: .4,
                        fill: window.theme.primary
                    },
                    hover: {
                        fill: window.theme.primary,
                        stroke: window.theme.primary
                    }
                },
                zoomOnScroll: false,
                focusOn: {
                    coords: [31.7917, -7.0926], // Coordinates for center of Morocco
                    scale: 7 // Adjust this value to zoom in or out
                },
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4'
                    }
                }
            });

            window.addEventListener("resize", () => {
                map.updateSize();
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
	
	
</body>

</html>
