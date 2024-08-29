<!-- nav-client.blade.php -->
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

    <title>@yield('title', 'Webcinq - Tableau de bord Client')</title>

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
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Tableau de
                                bord</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('setting') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('logout') }}">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Se
                                déconnecter</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('sign_up') }}">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Créer un
                                nouveau compte</span>
                        </a>
                    </li>



                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('client.invoices.index') }}">
                            <i class="align-middle me-2" data-feather="list"></i> <span class="align-middle">Liste des
                                factures</span>
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
                                    <a href="{{ route('messages.index') }}" class="text-muted">Afficher tous les
                                        messages</a>
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
                                <img src="../img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1"
                                    alt="profil" /> <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('setting') }}"><i class="align-middle me-1"
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
    @yield('scripts')
</body>

</html>
