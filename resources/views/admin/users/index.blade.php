@extends('layouts.app')
@section('title', 'Manajemen User')

@section('content')

  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
      <h4 class="fw-bold text-dark m-0">Data Pengguna</h4>
      <p class="text-muted small m-0">Kelola akun administrator dan mahasiswa.</p>
    </div>

    <div class="d-flex flex-column flex-sm-row gap-2">
      
      <div class="input-group shadow-sm rounded-pill overflow-hidden border-0" style="min-width: 280px;">
        <span class="input-group-text bg-white border-0 ps-3">
          <i class="fas fa-search text-muted" id="search-icon"></i>
          <span class="spinner-border spinner-border-sm text-primary d-none" id="search-spinner" role="status"></span>
        </span>
        <input type="text" id="searchInput" class="form-control border-0 py-2" 
               placeholder="Cari nama atau email..." value="{{ request('search') }}">
      </div>

      <button class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm btn-modal-action d-flex align-items-center justify-content-center gap-2"
        style="white-space: nowrap;" 
        data-url="{{ route('admin.users.create') }}">
        <i class="fas fa-plus"></i> Tambah User
      </button>

    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
      <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div id="table-container">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="bg-light">
                <tr>
                  <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold" width="5%">No</th>
                  <th class="py-3 text-secondary small text-uppercase fw-bold" width="30%">Pengguna</th>
                  <th class="py-3 text-secondary small text-uppercase fw-bold" width="25%">Email</th>
                  <th class="py-3 text-secondary small text-uppercase fw-bold text-center" width="15%">Role</th>
                  <th class="py-3 text-secondary small text-uppercase fw-bold" width="15%">Bergabung</th>
                  <th class="pe-4 py-3 text-secondary small text-uppercase fw-bold text-end" width="10%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($users as $key => $user)
                  <tr>
                    <td class="ps-4 text-muted fw-bold">{{ $users->firstItem() + $key }}</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{ $user->avatar_url }}" alt="Avatar" class="rounded-circle border shadow-sm me-3"
                          style="width: 40px; height: 40px; object-fit: cover;">
                        <div>
                          <span class="d-block fw-bold text-dark">{{ $user->name }}</span>
                          <small class="text-muted d-block d-md-none" style="font-size: 0.75rem;">{{ $user->email }}</small>
                        </div>
                      </div>
                    </td>
                    <td class="text-secondary">{{ $user->email }}</td>
                    <td class="text-center">
                      @if($user->role == 'admin')
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1 border border-danger border-opacity-10">
                          <i class="fas fa-shield-alt me-1"></i> Admin
                        </span>
                      @else
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 border border-primary border-opacity-10">
                          <i class="fas fa-user-graduate me-1"></i> User
                        </span>
                      @endif
                    </td>
                    <td class="text-secondary small">
                      <i class="far fa-calendar me-1 text-muted"></i>
                      {{ $user->created_at->format('d M Y') }}
                    </td>
                    
                    <td class="pe-4 text-end">
                      <div class="d-flex justify-content-end gap-1">
                        <button class="btn btn-sm btn-light text-warning btn-modal-action rounded-circle border shadow-sm p-0 d-flex align-items-center justify-content-center"
                          style="width: 32px; height: 32px;" 
                          data-url="{{ route('admin.users.edit', $user->id) }}" 
                          title="Edit">
                          <i class="fas fa-pencil-alt"></i>
                        </button>
    
                        <button class="btn btn-sm btn-light text-danger btn-delete-user rounded-circle border shadow-sm p-0 d-flex align-items-center justify-content-center"
                          style="width: 32px; height: 32px;" 
                          data-url="{{ route('admin.users.destroy', $user->id) }}"
                          data-name="{{ $user->name }}" 
                          title="Hapus">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center py-5">
                      <div class="text-muted opacity-50 mb-3">
                        <i class="fas fa-users-slash fa-3x"></i>
                      </div>
                      <h6 class="text-muted fw-bold">Tidak ada data pengguna</h6>
                      <p class="text-muted small mb-0">Coba ubah kata kunci pencarian atau tambah user baru.</p>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
    
        @if($users->hasPages())
          <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-end">
              {{ $users->links() }} 
            </div>
          </div>
        @endif
    </div>
  </div>

  <div class="modal fade" id="genericModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg rounded-4">
        <div class="modal-body text-center py-5">
          <div class="spinner-border text-primary" role="status"></div>
          <p class="mt-3 text-muted fw-medium">Memuat data...</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      
      // --- 1. LIVE SEARCH LOGIC (Full Page Fetch & Parse) ---
      const searchInput = document.getElementById('searchInput');
      const tableContainer = document.getElementById('table-container');
      const searchIcon = document.getElementById('search-icon');
      const searchSpinner = document.getElementById('search-spinner');
      let timeout = null;

      function fetchTableData(url) {
        // Tampilkan loading
        searchIcon.classList.add('d-none');
        searchSpinner.classList.remove('d-none');
        tableContainer.style.opacity = '0.5';

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            // Parsing HTML response (Ambil hanya bagian tabel)
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newTableContent = doc.getElementById('table-container').innerHTML;

            // Replace isi container
            tableContainer.innerHTML = newTableContent;
            
            // Update URL browser
            window.history.pushState(null, '', url);
        })
        .catch(error => console.error('Error:', error))
        .finally(() => {
            // Sembunyikan loading
            searchIcon.classList.remove('d-none');
            searchSpinner.classList.add('d-none');
            tableContainer.style.opacity = '1';
        });
      }

      if (searchInput) {
          searchInput.addEventListener('keyup', function () {
            clearTimeout(timeout);
            const query = this.value;
            const url = `{{ route('admin.users.index') }}?search=${query}`;

            // Delay 500ms
            timeout = setTimeout(() => {
                fetchTableData(url);
            }, 500); 
          });
      }

      // --- 2. HANDLE PAGINATION VIA AJAX ---
      document.body.addEventListener('click', function(e) {
          const paginationLink = e.target.closest('.pagination a');
          if (paginationLink) {
              e.preventDefault();
              const url = paginationLink.getAttribute('href');
              fetchTableData(url);
          }
      });

      // --- 3. LOGIKA MODAL ---
      const modalElement = document.getElementById('genericModal');
      const bsModal = new bootstrap.Modal(modalElement);
      const modalContent = modalElement.querySelector('.modal-content');

      document.body.addEventListener('click', function (e) {
        const trigger = e.target.closest('.btn-modal-action');
        if (trigger) {
          e.preventDefault();
          const url = trigger.getAttribute('data-url');

          bsModal.show();
          modalContent.innerHTML = `<div class="modal-body text-center py-5"><div class="spinner-border text-primary"></div><p class="mt-3 text-muted fw-medium">Memuat data...</p></div>`;

          fetch(url)
            .then(res => res.text())
            .then(html => modalContent.innerHTML = html)
            .catch(err => modalContent.innerHTML = `<div class="p-4 text-danger text-center">Error: ${err}</div>`);
        }
      });

      // --- 4. LOGIKA DELETE ---
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

      document.body.addEventListener('click', function (e) {
        const deleteBtn = e.target.closest('.btn-delete-user');
        if (deleteBtn) {
          e.preventDefault();
          const url = deleteBtn.getAttribute('data-url');
          const name = deleteBtn.getAttribute('data-name');
          const row = deleteBtn.closest('tr');

          Swal.fire({
            title: 'Hapus User?',
            text: "Akun '" + name + "' akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: { popup: 'rounded-4' }
          }).then((result) => {
            if (result.isConfirmed) {
              fetch(url, {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': csrfToken,
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                }
              })
              .then(response => response.json())
              .then(data => {
                Swal.fire({ title: 'Terhapus!', text: data.message, icon: 'success', customClass: { popup: 'rounded-4' } });
                row.style.transition = "all 0.5s ease";
                row.style.opacity = "0";
                setTimeout(() => {
                    row.remove();
                    if (document.querySelector('tbody').children.length === 0) location.reload();
                }, 500);
              });
            }
          });
        }
      });

    });
  </script>

@endsection