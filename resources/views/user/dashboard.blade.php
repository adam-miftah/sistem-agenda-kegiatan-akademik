@extends('layouts.app')
@section('title', 'Dashboard Mahasiswa')
@section('content')

  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
    <div>
      <h4 class="fw-bold text-dark m-0">Dashboard Mahasiswa</h4>
      <p class="text-muted small m-0">Ringkasan aktivitas dan agenda akademik Anda.</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex gap-2 align-items-center">
      <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
        <i class="far fa-calendar-alt me-2"></i> {{ date('d F Y') }}
      </span>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
      <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="row g-3 mb-4">

    <div class="col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div>
            <h6 class="text-uppercase text-muted small fw-bold mb-1">Total Agenda</h6>
            <h2 class="mb-0 fw-bold text-dark">{{ count($my_agendas) }}</h2>
            <small class="text-primary fw-bold" style="font-size: 0.75rem;">
              <i class="fas fa-list-ul me-1"></i> Semua Kegiatan
            </small>
          </div>
          <div
            class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 d-flex align-items-center justify-content-center"
            style="width: 50px; height: 50px;">
            <i class="fas fa-calendar-check fa-lg"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div>
            <h6 class="text-uppercase text-muted small fw-bold mb-1">Menunggu</h6>
            <h2 class="mb-0 fw-bold text-dark">{{ $my_agendas->where('status', 'pending')->count() }}</h2>
            <small class="text-warning fw-bold" style="font-size: 0.75rem;">
              <i class="fas fa-clock me-1"></i> Belum Selesai
            </small>
          </div>
          <div
            class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 d-flex align-items-center justify-content-center"
            style="width: 50px; height: 50px;">
            <i class="fas fa-hourglass-half fa-lg"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div>
            <h6 class="text-uppercase text-muted small fw-bold mb-1">Selesai</h6>
            <h2 class="mb-0 fw-bold text-dark">{{ $my_agendas->where('status', 'completed')->count() }}</h2>
            <small class="text-success fw-bold" style="font-size: 0.75rem;">
              <i class="fas fa-check-circle me-1"></i> Terlaksana
            </small>
          </div>
          <div
            class="bg-success bg-opacity-10 text-success rounded-circle p-3 d-flex align-items-center justify-content-center"
            style="width: 50px; height: 50px;">
            <i class="fas fa-check fa-lg"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div>
            <h6 class="text-uppercase text-muted small fw-bold mb-1">Dibatalkan</h6>
            <h2 class="mb-0 fw-bold text-dark">{{ $my_agendas->where('status', 'canceled')->count() }}</h2>
            <small class="text-danger fw-bold" style="font-size: 0.75rem;">
              <i class="fas fa-ban me-1"></i> Tidak Terlaksana
            </small>
          </div>
          <div
            class="bg-danger bg-opacity-10 text-danger rounded-circle p-3 d-flex align-items-center justify-content-center"
            style="width: 50px; height: 50px;">
            <i class="fas fa-times-circle fa-lg"></i>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
      <h6 class="m-0 fw-bold text-dark"><i class="fas fa-history me-2 text-secondary"></i> Agenda Terbaru Saya</h6>
      <a href="{{ route('user.agendas.my') }}" class="btn btn-sm btn-primary text-light rounded-pill px-3">
        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
      </a>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light">
            <tr>
              <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold" width="20%">Waktu</th>
              <th class="py-3 text-secondary small text-uppercase fw-bold" width="30%">Detail Kegiatan</th>
              <th class="py-3 text-secondary small text-uppercase fw-bold" width="15%">Kategori</th>
              <th class="py-3 text-secondary small text-uppercase fw-bold text-center" width="15%">Status</th>
              <th class="pe-4 py-3 text-secondary small text-uppercase fw-bold text-end" width="20%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($my_agendas->take(5) as $agenda)
              <tr>
                <td class="ps-4">
                  <span class="fw-bold text-dark d-block">{{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}</span>
                  <small class="text-muted"><i class="far fa-clock me-1"></i> {{ $agenda->time }} WIB</small>
                </td>
                <td>
                  <span class="fw-bold text-dark d-block">{{ $agenda->title }}</span>
                  <small class="text-muted text-truncate d-block" style="max-width: 250px;">
                    <i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $agenda->location ?? 'Online' }}
                  </small>
                </td>
                <td>
                  <span class="badge bg-light text-secondary border fw-normal px-3 py-1 rounded-pill">
                    {{ $agenda->category }}
                  </span>
                </td>
                <td class="text-center">
                  @php
                    $statusClass = match ($agenda->status) {
                      'completed' => 'bg-success bg-opacity-10 text-success',
                      'canceled' => 'bg-danger bg-opacity-10 text-danger',
                      default => 'bg-warning bg-opacity-10 text-warning'
                    };
                    $statusLabel = match ($agenda->status) {
                      'completed' => 'Selesai',
                      'canceled' => 'Batal',
                      default => 'Pending'
                    };
                  @endphp
                  <span class="badge {{ $statusClass }} rounded-pill px-3 py-1">{{ $statusLabel }}</span>
                </td>
                <td class="pe-4 text-end">
                  <div class="d-flex justify-content-end gap-1">
                    <button
                      class="btn btn-sm btn-light text-primary btn-modal-action rounded-circle border shadow-sm p-0 d-flex align-items-center justify-content-center"
                      style="width: 32px; height: 32px;" data-url="{{ route('user.agendas.show', $agenda->id) }}"
                      title="Detail">
                      <i class="fas fa-eye"></i>
                    </button>

                    @if($agenda->status == 'pending')
                      <button
                        class="btn btn-sm btn-light text-warning btn-modal-action rounded-circle border shadow-sm p-0 d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;" data-url="{{ route('user.agendas.edit', $agenda->id) }}"
                        title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                      </button>

                      <button
                        class="btn btn-sm btn-light text-danger btn-delete-agenda rounded-circle border shadow-sm p-0 d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;" data-url="{{ route('user.agendas.destroy', $agenda->id) }}"
                        data-name="{{ $agenda->title }}" title="Hapus">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-5">
                  <div class="text-muted opacity-50 mb-2">
                    <i class="fas fa-box-open fa-2x"></i>
                  </div>
                  <p class="m-0 small text-muted">Belum ada agenda yang dibuat.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="genericModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-0 rounded-4 shadow-lg">
        <div class="modal-body text-center py-5">
          <div class="spinner-border text-primary" role="status"></div>
          <p class="mt-3 text-muted small">Memuat data...</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const modalElement = document.getElementById('genericModal');
      const bsModal = new bootstrap.Modal(modalElement);
      const modalContent = modalElement.querySelector('.modal-content');

      document.body.addEventListener('click', function (e) {
        const trigger = e.target.closest('.btn-modal-action');
        if (trigger) {
          e.preventDefault();
          const url = trigger.getAttribute('data-url');
          bsModal.show();
          modalContent.innerHTML = `<div class="modal-body text-center py-5"><div class="spinner-border text-primary"></div><p class="mt-3 text-muted small">Memuat...</p></div>`;

          fetch(url)
            .then(res => res.text())
            .then(html => modalContent.innerHTML = html)
            .catch(err => modalContent.innerHTML = `<div class="p-4 text-danger text-center small">Error: ${err}</div>`);
        }
      });

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

      document.body.addEventListener('click', function (e) {
        const deleteBtn = e.target.closest('.btn-delete-agenda');
        if (deleteBtn) {
          e.preventDefault();
          const url = deleteBtn.getAttribute('data-url');
          const name = deleteBtn.getAttribute('data-name');
          const row = deleteBtn.closest('tr');

          Swal.fire({
            title: 'Hapus Agenda?',
            text: "Agenda '" + name + "' akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#333',
            cancelButtonColor: '#ddd',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            customClass: { popup: 'rounded-3' }
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
                    title: 'Terhapus',
                    text: data.message,
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                  });
                  row.style.opacity = "0";
                  setTimeout(() => {
                    row.remove();
                    if (document.querySelector('tbody').children.length === 0) location.reload();
                  }, 300);
                });
            }
          });
        }
      });
    });
  </script>

@endsection