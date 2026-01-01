@extends('layouts.app')
@section('title', 'Dashboard Administrator')
@section('content')

  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
    <div>
      <h4 class="fw-bold text-dark m-0">Dashboard Admin</h4>
      <p class="text-muted small m-0">Ringkasan statistik dan aktivitas terbaru.</p>
    </div>
    <div class="mt-3 mt-md-0">
      <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
        <i class="far fa-calendar-alt me-2"></i> {{ date('d F Y') }}
      </span>
    </div>
  </div>

  <div class="row g-3 mb-4">

    <div class="col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div>
            <h6 class="text-uppercase text-muted small fw-bold mb-1">Mahasiswa</h6>
            <h2 class="mb-0 fw-bold text-dark">{{ $stats['total_user'] }}</h2>
            <small class="text-success fw-bold" style="font-size: 0.75rem;">
              <i class="fas fa-user-check me-1"></i> Terdaftar
            </small>
          </div>
          <div
            class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 d-flex align-items-center justify-content-center"
            style="width: 50px; height: 50px;">
            <i class="fas fa-users fa-lg"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div>
            <h6 class="text-uppercase text-muted small fw-bold mb-1">Total Agenda</h6>
            <h2 class="mb-0 fw-bold text-dark">{{ $stats['total_agenda'] }}</h2>
            <small class="text-primary fw-bold" style="font-size: 0.75rem;">
              <i class="fas fa-database me-1"></i> Data Masuk
            </small>
          </div>
          <div class="bg-info bg-opacity-10 text-info rounded-circle p-3 d-flex align-items-center justify-content-center"
            style="width: 50px; height: 50px;">
            <i class="fas fa-calendar-alt fa-lg"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div>
            <h6 class="text-uppercase text-muted small fw-bold mb-1">Agenda Hari Ini</h6>
            <h2 class="mb-0 fw-bold text-dark">{{ $stats['agenda_today'] }}</h2>
            <small class="text-warning fw-bold" style="font-size: 0.75rem;">
              <i class="fas fa-clock me-1"></i> Berlangsung
            </small>
          </div>
          <div
            class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 d-flex align-items-center justify-content-center"
            style="width: 50px; height: 50px;">
            <i class="fas fa-bell fa-lg"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
          <div>
            <h6 class="text-uppercase text-muted small fw-bold mb-1">Dibatalkan</h6>
            <h2 class="mb-0 fw-bold text-dark">{{ $stats['agenda_canceled'] }}</h2>
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
      <h6 class="m-0 fw-bold text-dark"><i class="fas fa-history me-2 text-secondary"></i> 5 Agenda Terbaru</h6>
      <a href="{{ route('admin.agendas.index') }}" class="btn btn-sm btn-primary text-light rounded-pill px-3">
        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
      </a>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light">
            <tr>
              <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold">Waktu</th>
              <th class="py-3 text-secondary small text-uppercase fw-bold">Judul Kegiatan</th>
              <th class="py-3 text-secondary small text-uppercase fw-bold">Pembuat</th>
              <th class="py-3 text-secondary small text-uppercase fw-bold text-center">Status</th>
              <th class="pe-4 py-3 text-secondary small text-uppercase fw-bold text-end">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recent_agendas as $agenda)
              <tr>
                <td class="ps-4">
                  <span class="fw-bold text-dark d-block">{{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}</span>
                  <small class="text-muted">{{ $agenda->time }}</small>
                </td>
                <td>
                  <span class="fw-bold text-dark d-block">{{ $agenda->title }}</span>
                  <small class="text-muted"><i class="fas fa-tag me-1"></i> {{ $agenda->category }}</small>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <div
                      class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                      style="width: 25px; height: 25px; font-size: 0.7rem;">
                      {{ substr($agenda->user->name, 0, 1) }}
                    </div>
                    <span class="small fw-medium">{{ $agenda->user->name }}</span>
                  </div>
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
                  <span class="badge {{ $statusClass }} rounded-pill px-3">{{ $statusLabel }}</span>
                </td>
                <td class="pe-4 text-end">
                  <button class="btn btn-sm btn-light text-primary btn-modal-action rounded-circle"
                    style="width: 32px; height: 32px;" data-url="{{ route('admin.agendas.show', $agenda->id) }}">
                    <i class="fas fa-eye"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-5 text-muted">
                  <i class="fas fa-box-open fa-2x mb-2 opacity-50"></i>
                  <p class="m-0 small">Belum ada data agenda.</p>
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
    });
  </script>

@endsection