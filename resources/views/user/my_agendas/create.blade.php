<form action="{{ route('user.agendas.store') }}" method="POST">
  @csrf

  <div class="modal-header border-0 pb-0">
    <div>
      <h5 class="modal-title fw-bold text-dark" id="modalLabel">Buat Agenda Baru</h5>
      <p class="text-muted small mb-0">Isi formulir di bawah ini untuk menambahkan kegiatan.</p>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body pt-4">
    <div class="mb-3">
      <label class="form-label fw-bold small text-secondary">Judul Kegiatan <span class="text-danger">*</span></label>
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0"><i class="fas fa-heading text-muted"></i></span>
        <input type="text" name="title" class="form-control bg-light border-start-0"
          placeholder="Contoh: Bimbingan Skripsi Bab 1" required>
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Tanggal <span class="text-danger">*</span></label>
        <input type="date" name="date" class="form-control bg-light" required>
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Jam <span class="text-danger">*</span></label>
        <input type="time" name="time" class="form-control bg-light" required>
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Kategori <span class="text-danger">*</span></label>
        <select name="category" class="form-select bg-light" required>
          <option value="">-- Pilih Kategori --</option>
          @foreach($categories as $cat)
            <option value="{{ $cat }}">{{ $cat }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Lokasi</label>
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0"><i class="fas fa-map-marker-alt text-muted"></i></span>
          <input type="text" name="location" class="form-control bg-light border-start-0"
            placeholder="Contoh: Ruang 305">
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold small text-secondary">Catatan / Deskripsi</label>
      <textarea name="description" class="form-control bg-light" rows="3"
        placeholder="Tambahkan detail kegiatan..."></textarea>
    </div>
  </div>

  <div class="modal-footer border-0 pt-0">
    <button type="button" class="btn btn-light text-secondary px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm"><i class="fas fa-check me-2"></i> Simpan
      Agenda</button>
  </div>
</form>