@extends('layouts.app')
@section('title', 'Laporan Kegiatan')
@section('content')

  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
      <h4 class="fw-bold text-dark m-0">Laporan Kegiatan</h4>
      <p class="text-muted small m-0">Rekapitulasi dan ekspor data agenda akademik.</p>
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white border-0 p-4 pb-0 d-flex justify-content-between align-items-center">
      <h6 class="fw-bold text-primary m-0"><i class="fas fa-filter me-2"></i> Filter Data Laporan</h6>

      <div id="loading-spinner" class="d-none">
        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
        <small class="text-muted ms-1">Memuat data...</small>
      </div>
    </div>

    <div class="card-body p-4">
      <div class="row g-3">

        <div class="col-md-3">
          <label class="form-label small fw-bold text-secondary">Dari Tanggal</label>
          <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="far fa-calendar"></i></span>
            <input type="date" id="start_date" class="form-control bg-light border-start-0 filter-input"
              value="{{ $startDate }}">
          </div>
        </div>

        <div class="col-md-3">
          <label class="form-label small fw-bold text-secondary">Sampai Tanggal</label>
          <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="far fa-calendar-check"></i></span>
            <input type="date" id="end_date" class="form-control bg-light border-start-0 filter-input"
              value="{{ $endDate }}">
          </div>
        </div>

        <div class="col-md-3">
          <label class="form-label small fw-bold text-secondary">Kategori</label>
          <select id="category" class="form-select bg-light text-muted filter-input" style="cursor: pointer;">
            <option value="">-- Semua Kategori --</option>
            @foreach($categories as $cat)
              <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-3">
          <label class="form-label small fw-bold text-secondary">Status</label>
          <select id="status" class="form-select bg-light text-muted filter-input" style="cursor: pointer;">
            <option value="">-- Semua Status --</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
            <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Batal</option>
          </select>
        </div>

        <div class="col-12 mt-4 d-flex justify-content-end">
          <a href="{{ route('admin.laporan.pdf', request()->all()) }}" id="btn-export-pdf" target="_blank"
            class="btn btn-danger rounded-pill px-4 shadow-sm">
            <i class="fas fa-file-pdf me-2"></i> Ekspor PDF
          </a>
        </div>

      </div>
    </div>
  </div>

  <div id="table-container">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
      <div class="card-body p-0">

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="bg-white text-uppercase">
              <tr>
                <th class="ps-4 py-3 text-secondary small fw-bold" width="5%">No</th>
                <th class="py-3 text-secondary small fw-bold" width="15%">Waktu</th>
                <th class="py-3 text-secondary small fw-bold" width="25%">Kegiatan</th>
                <th class="py-3 text-secondary small fw-bold" width="15%">Kategori</th>
                <th class="py-3 text-secondary small fw-bold" width="15%">Pelaksana</th>
                <th class="py-3 text-secondary small fw-bold" width="15%">Lokasi</th>
                <th class="pe-4 py-3 text-secondary small fw-bold text-center" width="10%">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($agendas as $key => $agenda)
                <tr>
                  <td class="ps-4 text-muted fw-bold">{{ $agendas->firstItem() + $key }}</td>
                  <td>
                    <div class="d-flex flex-column small">
                      <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($agenda->date)->format('d/m/Y') }}</span>
                      <span class="text-muted">{{ $agenda->time }} WIB</span>
                    </div>
                  </td>
                  <td>
                    <span class="fw-bold text-dark d-block">{{ $agenda->title }}</span>
                  </td>
                  <td>
                    <span class="badge bg-light text-secondary border">{{ $agenda->category }}</span>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <i class="fas fa-user-circle text-muted me-2"></i>
                      <small class="text-dark">{{ $agenda->user->name }}</small>
                    </div>
                  </td>
                  <td class="small text-muted">
                    <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $agenda->location ?? '-' }}
                  </td>
                  <td class="text-center pe-4">
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
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center py-5">
                    <div class="text-muted opacity-50 mb-3">
                      <i class="fas fa-file-excel fa-3x"></i>
                    </div>
                    <h6 class="text-muted fw-bold">Data tidak ditemukan</h6>
                    <p class="text-muted small mb-0">Silakan sesuaikan filter tanggal atau kategori.</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      @if($agendas->hasPages())
        <div class="card-footer bg-white border-0 py-3">
          <div class="d-flex justify-content-end">
            {{ $agendas->links() }}
          </div>
        </div>
      @endif
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const inputs = document.querySelectorAll('.filter-input');
      const startDateInput = document.getElementById('start_date');
      const endDateInput = document.getElementById('end_date');
      const categoryInput = document.getElementById('category');
      const statusInput = document.getElementById('status');
      const tableContainer = document.getElementById('table-container');
      const btnExportPdf = document.getElementById('btn-export-pdf');
      const loadingSpinner = document.getElementById('loading-spinner');

      function fetchFilteredData() {
        loadingSpinner.classList.remove('d-none');
        tableContainer.style.opacity = '0.5';

        const params = new URLSearchParams({
          start_date: startDateInput.value,
          end_date: endDateInput.value,
          category: categoryInput.value,
          status: statusInput.value
        });

        const pdfBaseUrl = "{{ route('admin.laporan.pdf') }}";
        btnExportPdf.href = `${pdfBaseUrl}?${params.toString()}`;

        const url = `{{ route('admin.laporan.index') }}?${params.toString()}`;

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
          .then(response => response.text())
          .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.getElementById('table-container').innerHTML;

            tableContainer.innerHTML = newContent;
            window.history.pushState(null, '', url);
          })
          .catch(error => console.error('Error:', error))
          .finally(() => {
            loadingSpinner.classList.add('d-none');
            tableContainer.style.opacity = '1';
          });
      }

      inputs.forEach(input => {
        input.addEventListener('change', fetchFilteredData);
      });

      document.body.addEventListener('click', function (e) {
        const paginationLink = e.target.closest('.pagination a');
        if (paginationLink) {
          e.preventDefault();
          const url = paginationLink.getAttribute('href');

          loadingSpinner.classList.remove('d-none');
          tableContainer.style.opacity = '0.5';

          fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
              const parser = new DOMParser();
              const doc = parser.parseFromString(html, 'text/html');
              const newContent = doc.getElementById('table-container').innerHTML;
              tableContainer.innerHTML = newContent;
            })
            .finally(() => {
              loadingSpinner.classList.add('d-none');
              tableContainer.style.opacity = '1';
            });
        }
      });
    });
  </script>

@endsection