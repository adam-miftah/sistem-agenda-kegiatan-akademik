<div class="modal-header border-0 p-4 pb-0">
  <div class="w-100">
    <div class="d-flex justify-content-between align-items-start mb-2">
      <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-normal">
        <i class="fas fa-tag me-1"></i> {{ $agenda->category }}
      </span>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <h4 class="modal-title fw-bold text-dark lh-sm" id="modalLabel">{{ $agenda->title }}</h4>
  </div>
</div>

<div class="modal-body p-4">
  <div class="card border-0 bg-light rounded-4 mb-4">
    <div class="card-body p-3">
      <div class="row g-3">
        <div class="col-sm-4 border-end-sm">
          <div class="text-center">
            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Tanggal</small>
            <div class="d-block mt-1">
              <i class="far fa-calendar-alt text-primary mb-1 d-block"></i>
              <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}</span>
            </div>
          </div>
        </div>

        <div class="col-sm-4 border-end-sm">
          <div class="text-center">
            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Waktu</small>
            <div class="d-block mt-1">
              <i class="far fa-clock text-warning mb-1 d-block"></i>
              <span class="fw-bold text-dark">{{ $agenda->time }} WIB</span>
            </div>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="text-center">
            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Lokasi</small>
            <div class="d-block mt-1">
              <i class="fas fa-map-marker-alt text-danger mb-1 d-block"></i>
              <span class="fw-bold text-dark">{{ $agenda->location ?? 'Online' }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="mb-4">
    <h6 class="fw-bold text-secondary small text-uppercase mb-2">Deskripsi Kegiatan</h6>
    <div class="p-0 text-secondary" style="white-space: pre-line; line-height: 1.6;">
      {{ $agenda->description ?? 'Tidak ada deskripsi tambahan.' }}
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light">
    <div class="d-flex align-items-center">
      <img src="{{ $agenda->user->avatar_url }}" alt="User" class="rounded-circle border me-2 shadow-sm"
        style="width: 35px; height: 35px; object-fit: cover;">
      <div>
        <small class="text-muted d-block" style="font-size: 0.7rem;">Dibuat Oleh</small>
        <span class="fw-bold text-dark small">{{ $agenda->user->name }}</span>
      </div>
    </div>

    <div class="text-end">
      @php
        $statusBadge = match ($agenda->status) {
          'completed' => 'bg-success bg-opacity-10 text-success',
          'canceled' => 'bg-danger bg-opacity-10 text-danger',
          default => 'bg-warning bg-opacity-10 text-warning'
        };
        $statusLabel = match ($agenda->status) {
          'completed' => 'Selesai',
          'canceled' => 'Dibatalkan',
          default => 'Pending'
        };
      @endphp
      <small class="text-muted d-block" style="font-size: 0.7rem;">Status</small>
      <span class="badge {{ $statusBadge }} rounded-pill px-3 py-1">
        {{ $statusLabel }}
      </span>
    </div>
  </div>
</div>

<hr>

<div class="modal-footer border-0 pt-0 pb-4 px-4">
  <button type="button" class="btn btn-secondary text-light w-100 rounded-pill py-2"
    data-bs-dismiss="modal">Tutup</button>
</div>

<style>
  @media (min-width: 576px) {
    .border-end-sm {
      border-right: 1px solid #dee2e6;
    }
  }

  @media (max-width: 575.98px) {
    .border-end-sm {
      border-bottom: 1px solid #dee2e6;
      padding-bottom: 1rem;
      margin-bottom: 1rem;
    }
  }
</style>