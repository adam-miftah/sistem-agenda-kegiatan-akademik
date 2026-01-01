@extends('layouts.app')
@section('title', 'Kelola Kategori')
@section('content')

  <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-4 gap-3">
    <div>
      <h4 class="fw-bold text-dark m-0">Kategori Agenda</h4>
      <p class="text-muted small m-0">Atur label kategori untuk pengelompokan kegiatan.</p>
    </div>

    <div class="d-flex gap-2 flex-column flex-sm-row">
      <div class="input-group shadow-sm rounded-pill overflow-hidden border-0" style="min-width: 300px;">
        <span class="input-group-text bg-white border-0 ps-3">
          <i class="fas fa-search text-muted" id="search-icon"></i>
          <span class="spinner-border spinner-border-sm text-primary d-none" id="search-spinner" role="status"></span>
        </span>
        <input type="text" id="searchInput" class="form-control border-0 py-2" placeholder="Cari kategori..."
          value="{{ request('search') }}">
      </div>

      <button
        class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm btn-modal-action d-flex align-items-center justify-content-center gap-2"
        data-url="{{ route('admin.categories.create') }}">
        <i class="fas fa-plus me-2"></i> Tambah
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
                <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold" width="10%">No</th>
                <th class="py-3 text-secondary small text-uppercase fw-bold" width="70%">Nama Kategori</th>
                <th class="pe-4 py-3 text-secondary small text-uppercase fw-bold text-end" width="20%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($categories as $key => $category)
                <tr>
                  <td class="ps-4 text-muted fw-bold">{{ $categories->firstItem() + $key }}</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div
                        class="bg-light text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 35px; height: 35px;">
                        <i class="fas fa-tag"></i>
                      </div>
                      <span class="fw-bold text-dark">{{ $category->name }}</span>
                    </div>
                  </td>
                  <td class="pe-4 text-end">
                    <div class="btn-group">
                      <button
                        class="btn btn-sm btn-light text-warning btn-modal-action rounded-circle border shadow-sm p-0 d-flex align-items-center justify-content-center mx-1"
                        style="width: 32px; height: 32px;" data-url="{{ route('admin.categories.edit', $category->id) }}"
                        title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                      </button>

                      <button
                        class="btn btn-sm btn-light text-danger btn-modal-action rounded-circle border shadow-sm p-0 d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;" data-url="{{ route('admin.categories.destroy', $category->id) }}"
                        data-name="{{ $category->name }}" title="Hapus">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="text-center py-5">
                    <div class="text-muted opacity-50 mb-3">
                      <i class="fas fa-tags fa-3x"></i>
                    </div>
                    <h6 class="text-muted fw-bold">Belum ada kategori</h6>
                    <p class="text-muted small mb-0">Silakan tambahkan kategori baru.</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      @if($categories->hasPages())
        <div class="card-footer bg-white border-0 py-3">
          <div class="d-flex justify-content-end">
            {{ $categories->links() }}
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
      const searchInput = document.getElementById('searchInput');
      const tableContainer = document.getElementById('table-container');
      const searchIcon = document.getElementById('search-icon');
      const searchSpinner = document.getElementById('search-spinner');
      let timeout = null;

      function fetchTableData(url) {
        searchIcon.classList.add('d-none');
        searchSpinner.classList.remove('d-none');
        tableContainer.style.opacity = '0.5';

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
          .then(response => response.text())
          .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newTableContent = doc.getElementById('table-container').innerHTML;

            tableContainer.innerHTML = newTableContent;

            window.history.pushState(null, '', url);
          })
          .catch(error => console.error('Error:', error))
          .finally(() => {
            searchIcon.classList.remove('d-none');
            searchSpinner.classList.add('d-none');
            tableContainer.style.opacity = '1';
          });
      }

      if (searchInput) {
        searchInput.addEventListener('keyup', function () {
          clearTimeout(timeout);
          const query = this.value;
          const url = `{{ route('admin.categories.index') }}?search=${query}`;
          timeout = setTimeout(() => {
            fetchTableData(url);
          }, 500);
        });
      }

      document.body.addEventListener('click', function (e) {
        const paginationLink = e.target.closest('.pagination a');
        if (paginationLink) {
          e.preventDefault();
          const url = paginationLink.getAttribute('href');
          fetchTableData(url);
        }
      });

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

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

      document.body.addEventListener('click', function (e) {
        const deleteBtn = e.target.closest('.btn-delete-category');
        if (deleteBtn) {
          e.preventDefault();
          const url = deleteBtn.getAttribute('data-url');
          const name = deleteBtn.getAttribute('data-name');
          const row = deleteBtn.closest('tr');

          Swal.fire({
            title: 'Hapus Kategori?',
            text: "Kategori '" + name + "' akan dihapus.",
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
                  Swal.fire({
                    title: 'Terhapus!',
                    text: data.message,
                    icon: 'success',
                    customClass: { popup: 'rounded-4' }
                  });
                  row.style.transition = "all 0.5s ease";
                  row.style.opacity = "0";
                  setTimeout(() => {
                    row.remove();
                    if (document.querySelector('tbody').children.length === 0) location.reload();
                  }, 500);
                })
                .catch(err => Swal.fire('Error', 'Gagal menghapus.', 'error'));
            }
          });
        }
      });
    });
  </script>
@endsection