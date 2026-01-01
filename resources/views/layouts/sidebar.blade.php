<nav id="sidebar">
  <div class="sidebar-header d-flex align-items-center gap-2 px-4 border-bottom"
    style="height: 78px; background-color: #fff;">
    <div class="bg-primary text-white rounded p-2 d-flex align-items-center justify-content-center"
      style="width: 40px; height: 40px;">
      <i class="fas fa-university fa-lg"></i>
    </div>
    <div>
      <h5 class="mb-0 fw-bold text-primary">AgendaApp</h5>
      <small class="text-muted" style="font-size: 0.75rem;">Sistem Akademik</small>
    </div>
  </div>

  <div class="sidebar-content py-3">
    <ul class="list-unstyled components">
      <li class="px-3 mb-2">
        <small class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem;">Menu Utama</small>
      </li>

      <li class="{{ request()->is('*/dashboard') ? 'active' : '' }}">
        <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('user.dashboard') }}">
          <i class="fas fa-tachometer-alt me-3" style="width: 20px;"></i> Dashboard
        </a>
      </li>

      @if(Auth::user()->role == 'admin')
        <li class="px-3 mb-2 mt-4">
          <small class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem;">Administrator</small>
        </li>

        <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
          <a href="{{ route('admin.users.index') }}">
            <i class="fas fa-users-cog me-3" style="width: 20px;"></i> Data User
          </a>
        </li>

        <li class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
          <a href="{{ route('admin.categories.index') }}">
            <i class="fas fa-tags me-3" style="width: 20px;"></i> Kategori
          </a>
        </li>

        <li class="{{ request()->is('admin/agendas*') ? 'active' : '' }}">
          <a href="{{ route('admin.agendas.index') }}">
            <i class="fas fa-calendar-alt me-3" style="width: 20px;"></i> Kelola Agenda
          </a>
        </li>

        <li class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
          <a href="{{ route('admin.laporan.index') }}">
            <i class="fas fa-file-invoice me-3" style="width: 20px;"></i> Laporan
          </a>
        </li>

      @elseif(Auth::user()->role == 'user')
        <li class="px-3 mb-2 mt-4">
          <small class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem;">Mahasiswa</small>
        </li>

        <li class="{{ request()->routeIs('user.agendas.index') ? 'active' : '' }}">
          <a href="{{ route('user.agendas.index') }}">
            <i class="fas fa-globe me-3" style="width: 20px;"></i> Info Kampus
          </a>
        </li>

        <li class="{{ request()->routeIs('user.agendas.my') ? 'active' : '' }}">
          <a href="{{ route('user.agendas.my') }}">
            <i class="fas fa-user-edit me-3" style="width: 20px;"></i> Agenda Saya
          </a>
        </li>
      @endif
    </ul>
  </div>
</nav>