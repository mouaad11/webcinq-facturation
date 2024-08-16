<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tableau de bord client Webcinq">
    <meta name="author" content="Webcinq">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../../img/icons/icon-48x48.png" />

    <title>Webcinq - Tableau de bord Client</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ '/client-dashboard' }}">
                    <img src="{{ asset('/webcinq_logo.png') }}" height="40" alt="webcinq" loading="lazy" />
                    <span class="align-bottom">Client</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Menu
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ '/client-dashboard' }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Tableau de bord</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('setting')}}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('logout') }}">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Se déconnecter</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('sign_up') }}">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Créer un nouveau compte</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('devis_form_client') }}">
                            <i class="align-middle me-2" data-feather="edit"></i> <span class="align-middle">Ajouter un devis</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('client.invoices.index') }}">
                            <i class="align-middle me-2" data-feather="list"></i> <span class="align-middle">Liste des factures</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('client.devis.index') }}">
                            <i class="align-middle me-2" data-feather="list"></i> <span class="align-middle">Liste des devis</span>
                        </a>
                    </li>
                </ul>

                <div class="sidebar-cta">
                    <div class="sidebar-cta-content">
                        <strong class="d-inline-block mb-2">Visiter notre site web</strong>
                        <div class="mb-3 text-sm">
                            Vous voulez d'autres services et solutions digitales? Visitez notre site web.
                        </div>
                        <div class="d-grid">
                            <a href="https://webcinq.com/" target="_blank" class="btn btn-primary">Webcinq</a>
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
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                    <span class="indicator" id="unread-count"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        Nouveaux Messages
                                    </div>
                                </div>
                                <div class="list-group" id="message-list">
                                    <!-- Messages will be inserted here -->
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="{{ route('messages.index') }}" class="text-muted">Afficher tous les messages</a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="../img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="profil" /> <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{route('setting')}}"><i class="align-middle me-1" data-feather="user"></i> Profil</a>
                                <div class="dropdown-divider"></div>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button class="dropdown-item">Déconnexion</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
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
                                            @foreach($recentInvoices as $invoice)
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
                            <th>Montant</th>
                            <th>Date</th>
                            <th>Status</th> <!-- Add this line -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentQuotes as $quote)
                        <tr>
                            <td>{{ $quote->id }}</td>
                            <td>{{ number_format($quote->total_amount, 2) }} DH</td>
                            <td>{{ $quote->date instanceof \Carbon\Carbon ? $quote->date->format('d/m/Y') : $quote->date }}</td>
                            <td>
                                @if($quote->status == 'Accepté')
                                    <span class="badge bg-success">{{ $quote->status }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $quote->status }}</span>
                                @endif
                            </td>                            <td>
                                <a href="{{ route('detail_devis', ['type' => 'sent', 'id' => $quote->id]) }}" class="btn btn-sm btn-primary">Voir</a>
                                @if($quote->status == 'Non Accepté')
                                <form action="{{ route('client.devis.accept', $quote->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Êtes-vous sûr de vouloir accepter ce devis?')">Accepter</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center mt-3">
                    <a href="{{ route('client.devis.index') }}" class="btn btn-primary">Voir tous les devis</a>
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
                                <a class="text-muted"></a><a class="text-muted"><strong>Tous les droits sont réservés</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://webcinq.com/contact/" target="_blank">Contact</a>
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
                    display: true, // Enable the legend
                    position: 'bottom', // Position of the legend (bottom, top, left, right)
                    labels: {
                        boxWidth: 20, // Width of the color box
                        padding: 15,  // Padding between legend items
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
</body>

</html>