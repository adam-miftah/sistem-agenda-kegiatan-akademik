<form action="{{ route('admin.categories.store') }}" method="POST">
  @csrf

  <div class="modal-header border-0 pb-0">
    <div>
      <h5 class="modal-title fw-bold text-dark" id="modalLabel">Tambah Kategori</h5>
      <p class="text-muted small mb-0">Buat label kategori baru untuk agenda.</p>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body pt-4">
    <div class="mb-3">
      <label class="form-label fw-bold small text-secondary">Nama Kategori <span class="text-danger">*</span></label>
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-tag"></i></span>
        <input type="text" name="name" class="form-control bg-light border-start-0"
          placeholder="Contoh: Workshop, Seminar, Rapat" required autofocus>
      </div>
    </div>
  </div>

  <div class="modal-footer border-0 pt-0 px-4 pb-4">
    <button type="button" class="btn btn-secondary text-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
      <i class="fas fa-check me-2"></i> Simpan
    </button>
  </div>
</form>