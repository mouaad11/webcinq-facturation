<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tableau de bord Admin Webcinq">
    <meta name="author" content="Webcinq">   
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>@yield('title', 'Document')</title>
    
    <style>
        .toggle-button {
            position: relative;
            width: 60px;
            height: 20px;
            background-color: red;
            border-radius: 20px;
            border: 2px solid black;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .toggle-button .toggle-circle {
            position: absolute;
            width: 17px;
            height: 17px;
            background-color: black;
            border-radius: 50%;
        }
        .toggle-button.on {
            background-color: green;
        }
        .toggle-button.on .toggle-circle {
            transform: translateX(40px);
        }
    </style>
</head>

<body>
    @auth
        @if (Auth::user()->uservalid === 'v')
            <div class="wrapper">
                <nav id="sidebar" class="sidebar js-sidebar">
                    <div class="sidebar-content js-simplebar">
                        <a class="sidebar-brand" href="{{ '/dashboard' }}">
                            <img src="{{ asset('/webcinq_logo.png') }}" height="40" alt="webcinq" loading="lazy" />
                            <span class="align-bottom">Admin</span>
                        </a>

                        <ul class="sidebar-nav">
                            <li class="sidebar-header">
                                Pages
                            </li>

                            <li class="sidebar-item active">
                                <a class="sidebar-link" href="{{route('dashboard')}}">
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
                                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Créer un
                                        nouveau compte</span>
                                </a>
                            </li>
        
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin_list_acc') }}">
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
                                <a class="sidebar-link" href="{{ route('clients.indexShowAll') }}">
                                    <i class="align-middle me-2" data-feather="list"></i> <span class="align-middle">Liste des clients</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('company_info') }}">
                                    <i class="align-middle me-2" data-feather="list"></i> <span class="align-middle">Liste des entreprises</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('invoices.index') }}">
                                    <i class="align-middle me-2" data-feather="list"></i> <span class="align-middle">Liste des factures</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('devis.index') }}">
                                    <i class="align-middle me-2" data-feather="list"></i> <span class="align-middle">Liste des devis</span>
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
                                            <a href="{{ route('messages.index') }}" class="text-muted">Afficher tous les messages</a>
                                        </div>
                                    </div>
                                </li>
        
                               
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
                                            <button class="dropdown-item">Déconnexion</button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <main class="content">
                        @yield('content')
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
        @else
            <h1>Attente de validation du compte</h1>
        @endif
    @else
        <div class="container-fluid">
            @yield('login_sign')
        </div>
    @endauth

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>