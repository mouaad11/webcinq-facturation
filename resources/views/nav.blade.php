<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <div class="container-fluid">
      <button
          data-mdb-collapse-init
          class="navbar-toggler"
          type="button"
          data-mdb-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
          hidden
      >
          <i class="fas fa-bars"></i>
      </button>
      
      <a class="navbar-brand mt-2 mt-lg-0" href="{{ Auth::user()->isAdmin() ? route('dashboard') : route('client.dashboard') }}">
          <img src="{{ asset('/webcinq_logo.png') }}" height="50" alt="webcinq" loading="lazy" />
      </a>
      
      <div class="d-flex align-items-center">
          <a class="text-reset me-3" href="#">
              <i class="fas fa-shopping-cart"></i>
          </a>
          
          <div class="btn-group">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ Auth::user()->name }}
              </button>
              
              <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                      <form action="{{ route('setting') }}" method="POST">
                          @csrf
                          <button class="dropdown-item" type="submit">Paramètres du compte</button>
                      </form>
                  </li>

                  @if (Auth::user()->usertype == 'user')
                  <li>
                      <form action="{{ route('information') }}" method="POST">
                          @csrf
                          <button class="dropdown-item" type="submit">Informations</button>
                      </form>
                  </li>
                  @endif

                  @if (Auth::user()->usertype == 'admin')
                  <form action="{{ route('admin_list_acc') }}" method="POST">
                      @csrf
                      <li><button class="dropdown-item" type="submit">Admin</button></li>
                  </form>

                  <form action="{{ route('validation_list') }}" method="POST">
                      @csrf
                      <li><button class="dropdown-item" type="submit">Liste de validation</button></li>
                  </form>

                  <form action="{{ route('company_info') }}" method="POST">
                      @csrf
                      <li><button class="dropdown-item" type="submit">Informations sur les entreprises</button></li>
                  </form>
                  @endif

                  <li>
                      <form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <button class="dropdown-item" type="submit">Déconnexion</button>
                      </form>
                  </li>
              </ul>
          </div>
      </div>
  </div>
</nav>
