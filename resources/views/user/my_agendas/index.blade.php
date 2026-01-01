@extends('layouts.app')
@section('title', 'Agenda Saya')
@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h4 class="fw-bold text-dark m-0">Agenda Saya</h4>
        <p class="text-muted small m-0">Kelola jadwal dan kegiatan pribadi Anda.</p>
    </div>

    <div>
        <button class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm btn-modal-action w-100 w-md-auto" 
                data-url="{{ route('user.agendas.create') }}">
            <i class="fas fa-plus me-2"></i> Buat Agenda
        </button>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    
    <div class="card-header bg-white border-bottom-0 p-4">
        <div class="input-group shadow-sm rounded-pill overflow-hidden border-0 bg-light" style="max-width: 400px;">
            <span class="input-group-text bg-transparent border-0 ps-3 text-muted">
                <i class="fas fa-search" id="my-search-icon"></i>
                <div class="spinner-border spinner-border-sm text-primary d-none" id="my-search-spinner" role="status"></div>
            </span>
            <input type="text" id="my-agenda-search" class="form-control bg-transparent border-0 py-2" 
                   placeholder="Cari agenda saya..." value="{{ request('search') }}">
        </div>
    </div>

    <div id="my-agenda-table-container">
        <div class="card-body p-0 mt-2">
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 mx-4 rounded-3 shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold" width="5%">No</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold" width="20%">Waktu</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold" width="30%">Detail Kegiatan</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold text-center" width="10%">Kategori</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold text-center" width="10%">Status</th>
                            <th class="pe-4 py-3 text-secondary small text-uppercase fw-bold text-end" width="25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="my-table-body" class="opacity-100 transition-opacity duration-300">
                        @forelse($agendas as $key => $agenda)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">{{ $agendas->firstItem() + $key }}</td>
                            
                            <td>
                                <div class="d-flex flex-column small">
                                    <span class="fw-bold text-dark mb-1">
                                        <i class="far fa-calendar-alt text-primary me-2"></i> 
                                        {{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}
                                    </span>
                                    <span class="text-muted">
                                        <i class="far fa-clock text-warning me-2"></i> 
                                        {{ $agenda->time }} WIB
                                    </span>
                                </div>
                            </td>

                            <td>
                                <span class="d-block fw-bold text-dark">{{ $agenda->title }}</span>
                                <small class="text-muted text-truncate d-block" style="max-width: 250px;">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i> 
                                    {{ $agenda->location ?? 'Online' }}
                                </small>
                            </td>

                            <td class="text-center">
                                <span class="badge bg-light text-secondary border fw-normal px-3 py-2 rounded-pill">
                                    {{ $agenda->category }}
                                </span>
                            </td>

                            <td class="text-center">
                                 @php
                                    $statusBadge = match($agenda->status) {
                                        'completed' => 'bg-success bg-opacity-10 text-success',
                                        'canceled' => 'bg-danger bg-opacity-10 text-danger',
                                        default => 'bg-warning bg-opacity-10 text-warning'
                                    };
                                    $statusLabel = match($agenda->status) {
                                        'completed' => 'Selesai',
                                        'canceled' => 'Batal',
                                        default => 'Pending'
                                    };
                                @endphp
                                <span class="badge {{ $statusBadge }} rounded-pill px-3 py-1">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    
                                    <button class="btn btn-sm btn-light text-primary btn-modal-action mx-1 rounded-circle border shadow-sm" 
                                            style="width: 32px; height: 32px;"
                                            data-url="{{ route('user.agendas.show', $agenda->id) }}" 
                                            title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    
                                    @if($agenda->status == 'pending')
                                        <button class="btn btn-sm btn-light text-warning btn-modal-action mx-1 rounded-circle border shadow-sm" 
                                                style="width: 32px; height: 32px;"
                                                data-url="{{ route('user.agendas.edit', $agenda->id) }}" 
                                                title="Edit Data">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <button class="btn btn-sm btn-light text-danger btn-delete-agenda mx-1 rounded-circle border shadow-sm" 
                                                style="width: 32px; height: 32px;"
                                                data-url="{{ route('user.agendas.destroy', $agenda->id) }}" 
                                                data-name="{{ $agenda->title }}" 
                                                title="Hapus Data">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted opacity-50 mb-3">
                                    <i class="fas fa-clipboard-list fa-3x"></i>
                                </div>
                                <h6 class="text-muted fw-bold">Belum ada agenda</h6>
                                <p class="text-muted small mb-0">Yuk, mulai buat jadwal kegiatanmu sekarang!</p>
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

<div class="modal fade" id="genericModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
        
        const searchInput = document.getElementById('my-agenda-search');
        const tableContainer = document.getElementById('my-agenda-table-container');
        const searchIcon = document.getElementById('my-search-icon');
        const searchSpinner = document.getElementById('my-search-spinner');
        let debounceTimer;

        if(searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                
                searchIcon.classList.add('d-none');
                searchSpinner.classList.remove('d-none');
                tableContainer.style.opacity = '0.5';

                debounceTimer = setTimeout(() => {
                    const searchValue = this.value;
                    const url = `{{ route('user.agendas.my') }}?search=${searchValue}`;

                    fetch(url, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newContent = doc.getElementById('my-agenda-table-container').innerHTML;
                        tableContainer.innerHTML = newContent;
                        
                        window.history.pushState(null, '', url);
                    })
                    .catch(error => console.error('Error fetching data:', error))
                    .finally(() => {
                        searchIcon.classList.remove('d-none');
                        searchSpinner.classList.add('d-none');
                        tableContainer.style.opacity = '1';
                    });
                }, 500); 
            });
        }

        const modalElement = document.getElementById('genericModal');
        const bsModal = new bootstrap.Modal(modalElement);
        const modalContent = modalElement.querySelector('.modal-content');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        document.body.addEventListener('click', function (e) {
            const trigger = e.target.closest('.btn-modal-action');
            if (trigger) {
                e.preventDefault();
                const url = trigger.getAttribute('data-url');
                bsModal.show();
                modalContent.innerHTML = `<div class="modal-body text-center py-5"><div class="spinner-border text-primary"></div><p class="mt-2 text-muted">Memuat data...</p></div>`;

                fetch(url)
                    .then(res => res.text())
                    .then(html => modalContent.innerHTML = html)
                    .catch(err => modalContent.innerHTML = `<div class="p-4 text-danger text-center">Error: ${err}</div>`);
            }
        });

        document.body.addEventListener('click', function (e) {
            const deleteBtn = e.target.closest('.btn-delete-agenda');
            if (deleteBtn) {
                const url = deleteBtn.getAttribute('data-url');
                const name = deleteBtn.getAttribute('data-name');
                const row = deleteBtn.closest('tr');

                Swal.fire({
                    title: 'Hapus Agenda?',
                    text: "Agenda '" + name + "' akan dihapus permanen.",
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
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire({ title: 'Terhapus!', text: data.message, icon: 'success', customClass: { popup: 'rounded-4' }});
                            if(searchInput) searchInput.dispatchEvent(new Event('input'));
                            else {
                                row.style.transition = "all 0.5s";
                                row.style.opacity = "0";
                                setTimeout(() => row.remove(), 500);
                            }
                        });
                    }
                });
            }
        });
    });
</script>
@endsection