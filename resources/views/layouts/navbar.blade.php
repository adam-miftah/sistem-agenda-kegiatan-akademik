<nav class="navbar navbar-expand-lg bg-white w-100 p-3">
  <div class="container-fluid px-0">
    <button type="button" id="sidebarCollapse" class="btn btn-light text-primary bg-transparent border-0">
      <i class="fas fa-bars fa-lg"></i>
    </button>

    <div class="ms-auto d-flex align-items-center">
      <div class="dropdown">
        <a class="d-flex align-items-center text-decoration-none dropdown-toggle p-1 rounded" href="#"
          id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="transition: 0.3s;">

          <div class="text-end me-2 d-none d-md-block" style="line-height: 1.2;">
            <span class="d-block fw-bold text-dark small">{{ Auth::user()->name }}</span>
            <span class="d-block text-muted" style="font-size: 0.7rem;">{{ ucfirst(Auth::user()->role) }}</span>
          </div>

          <img src="{{ Auth::user()->avatar_url }}" alt="User" class="rounded-circle border"
            style="width: 38px; height: 38px; object-fit: cover;">
        </a>

        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2 animate-slide"
          aria-labelledby="navbarDropdown">
          <li class="d-md-none text-center py-2">
            <strong>{{ Auth::user()->name }}</strong>
          </li>
          <li>
            <hr class="dropdown-divider d-md-none">
          </li>
          <li>
            <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
              <i class="fas fa-user-circle me-2 text-primary"></i> Profil Saya
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item py-2 text-danger">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>