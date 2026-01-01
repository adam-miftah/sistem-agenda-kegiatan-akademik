@extends('layouts.app')
@section('title', 'Edit Profil')
@section('content')

  <style>
    .btn:focus,
    .form-control:focus,
    .nav-link:focus,
    .nav-link:active {
      outline: none !important;
      box-shadow: none !important;
    }

    .profile-tabs {
      border-bottom: 2px solid #f0f0f0;
    }

    .profile-tabs .nav-link {
      border: none !important;
      background: transparent !important;
      color: #6c757d;
      font-weight: 600;
      padding: 1rem 1.5rem;
      transition: all 0.3s ease;
      position: relative;
    }

    .profile-tabs .nav-link.active {
      color: #0d6efd !important;
      background: transparent !important;
    }

    .profile-tabs .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 3px;
      background-color: #0d6efd;
      border-radius: 3px 3px 0 0;
    }

    .profile-tabs .nav-link:hover {
      color: #0d6efd;
    }

    .avatar-wrapper img {
      border: 4px solid #ffffff;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      object-fit: cover;
    }

    .avatar-icon-overlay {
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 2px solid #ffffff;
      font-size: 0.7rem;
    }

    .row-equal-height {
      display: flex;
      flex-wrap: wrap;
    }

    .card-full-height {
      height: 100%;
      display: flex;
      flex-direction: column;
    }
  </style>

  <div class="d-flex align-items-center mb-4">
    <div>
      <h4 class="fw-bold text-dark m-0">Pengaturan Akun</h4>
      <p class="text-muted small m-0">Perbarui informasi profil dan keamanan akun Anda.</p>
    </div>
  </div>

  <div class="row g-4 row-equal-height">

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden card-full-height">
        <div class="card-body text-center p-5 d-flex flex-column justify-content-center align-items-center">

          <div class="avatar-wrapper position-relative d-inline-block mb-3">
            <img src="{{ $user->avatar_url }}" alt="Avatar" class="rounded-circle" style="width: 120px; height: 120px;">

            <div class="avatar-icon-overlay position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-1">
              <i class="fas fa-camera small"></i>
            </div>
          </div>

          <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
          <p class="text-muted small mb-3">{{ $user->email }}</p>

          <div class="mb-4">
            @if($user->role == 'admin')
              <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                <i class="fas fa-shield-alt me-1"></i> Administrator
              </span>
            @else
              <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                <i class="fas fa-user-graduate me-1"></i> Mahasiswa
              </span>
            @endif
          </div>

          <hr class="w-100 opacity-10">

          <div class="text-start w-100">
            <small class="text-uppercase text-muted fw-bold" style="font-size: 0.65rem;">Informasi Tambahan</small>
            <div class="mt-2 small text-dark">
              <div class="d-flex justify-content-between mb-2">
                <span><i class="far fa-calendar me-2 text-secondary"></i> Bergabung</span>
                <span class="fw-bold">{{ $user->created_at->format('d M Y') }}</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden card-full-height">

        <div class="card-header bg-white p-0">
          <ul class="nav nav-tabs profile-tabs m-0" id="profileTabs" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" id="biodata-tab" data-bs-toggle="tab" data-bs-target="#biodata"
                type="button">
                <i class="far fa-id-card me-2"></i> Edit Biodata
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button">
                <i class="fas fa-lock me-2"></i> Ganti Password
              </button>
            </li>
          </ul>
        </div>

        <div class="card-body p-4 p-md-5">

          @if(session('success'))
            <div
              class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm mb-4 bg-success bg-opacity-10 text-success"
              role="alert">
              <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <div class="tab-content" id="profileTabsContent">

            <div class="tab-pane fade show active" id="biodata" role="tabpanel">
              <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                  <label class="form-label small fw-bold text-secondary">Foto Profil Baru</label>
                  <div class="input-group">
                    <input type="file" name="avatar" class="form-control bg-light border-0 shadow-sm" accept="image/*">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-upload text-muted"></i></span>
                  </div>
                  <div class="form-text text-muted small mt-1 ps-1">
                    <i class="fas fa-info-circle me-1"></i> Format: JPG, PNG. Ukuran Maksimal: 2MB.
                  </div>
                </div>

                <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                    <div class="input-group shadow-sm rounded-3 overflow-hidden">
                      <span class="input-group-text bg-light border-0 ps-3"><i class="far fa-user text-muted"></i></span>
                      <input type="text" name="name" class="form-control bg-light border-0 py-2"
                        value="{{ old('name', $user->name) }}" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                    <div class="input-group shadow-sm rounded-3 overflow-hidden">
                      <span class="input-group-text bg-light border-0 ps-3"><i
                          class="far fa-envelope text-muted"></i></span>
                      <input type="email" name="email" class="form-control bg-light border-0 py-2"
                        value="{{ old('email', $user->email) }}" required>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end pt-2">
                  <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm fw-bold">
                    <i class="fas fa-check me-2"></i> Simpan Perubahan
                  </button>
                </div>
              </form>
            </div>

            <div class="tab-pane fade" id="password" role="tabpanel">
              <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                  <label class="form-label small fw-bold text-secondary">Password Saat Ini</label>
                  <div class="input-group shadow-sm rounded-3 overflow-hidden">
                    <span class="input-group-text bg-light border-0 ps-3"><i class="fas fa-key text-muted"></i></span>
                    <input type="password" name="current_password" class="form-control bg-light border-0 py-2"
                      placeholder="••••••••" required>
                  </div>
                </div>

                <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Password Baru</label>
                    <div class="input-group shadow-sm rounded-3 overflow-hidden">
                      <span class="input-group-text bg-light border-0 ps-3"><i class="fas fa-lock text-muted"></i></span>
                      <input type="password" name="password" class="form-control bg-light border-0 py-2"
                        placeholder="Minimal 8 karakter" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-secondary">Konfirmasi Password</label>
                    <div class="input-group shadow-sm rounded-3 overflow-hidden">
                      <span class="input-group-text bg-light border-0 ps-3"><i
                          class="fas fa-check-double text-muted"></i></span>
                      <input type="password" name="password_confirmation" class="form-control bg-light border-0 py-2"
                        placeholder="Ulangi password baru" required>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end pt-2">
                  <button type="submit" class="btn btn-warning text-dark rounded-pill px-4 py-2 shadow-sm fw-bold">
                    <i class="fas fa-sync-alt me-2"></i> Update Password
                  </button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const tabs = document.querySelectorAll('#profileTabs .nav-link');

      tabs.forEach(tab => {
        tab.addEventListener('click', function () {
          tabs.forEach(t => {
            t.classList.remove('active');
          });
          this.classList.add('active');
        });
      });
    });
  </script>

@endsection