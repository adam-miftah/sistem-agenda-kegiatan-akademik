<form action="{{ route('user.agendas.store') }}" method="POST">
  @csrf

  <div class="modal-header border-0 pb-0">
    <div>
      <h5 class="modal-title fw-bold text-dark" id="modalLabel">Buat Agenda Baru</h5>
      <p class="text-muted small mb-0">Isi detail kegiatan di bawah ini.</p>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body pt-4">
    <div class="mb-3">
      <label class="form-label fw-bold small text-secondary">Judul Kegiatan <span class="text-danger">*</span></label>
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-heading"></i></span>
        <input type="text" name="title" class="form-control bg-light border-start-0"
          placeholder="Contoh: Bimbingan Skripsi" required autofocus>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Tanggal <span class="text-danger">*</span></label>
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0 text-muted"><i class="far fa-calendar-alt"></i></span>
          <input type="date" name="date" class="form-control bg-light border-start-0" required>
        </div>
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Jam <span class="text-danger">*</span></label>
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0 text-muted"><i class="far fa-clock"></i></span>
          <input type="time" name="time" class="form-control bg-light border-start-0" required>
        </div>
      </div>
    </div>

    <div class="row g-3 mt-1">
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Kategori <span class="text-danger">*</span></label>
        <select name="category" class="form-select bg-light" required>
          <option value="">-- Pilih --</option>
          @foreach($categories as $cat)
            <option value="{{ $cat }}">{{ $cat }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Lokasi</label>
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-map-marker-alt"></i></span>
          <input type="text" name="location" class="form-control bg-light border-start-0"
            placeholder="Contoh: Auditorium Lantai 8">
        </div>
      </div>
    </div>

    <div class="mt-3">
      <label class="form-label fw-bold small text-secondary">Catatan</label>
      <textarea name="description" class="form-control bg-light" rows="3"
        placeholder="Tambahkan keterangan..."></textarea>
    </div>
  </div>

  <div class="modal-footer border-0 pt-0 px-4 pb-4">
    <button type="button" class="btn btn-secondary text-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
      <i class="fas fa-check me-2"></i> Simpan Agenda
    </button>
  </div>
</form>