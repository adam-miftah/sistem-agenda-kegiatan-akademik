<form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="modal-header border-0 pb-0">
    <div>
      <h5 class="modal-title fw-bold text-dark" id="modalLabel">Tambah Pengguna</h5>
      <p class="text-muted small mb-0">Isi data di bawah untuk mendaftarkan user baru.</p>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body pt-4">
    <div class="mb-4 text-center">
      <div class="p-3 bg-light border border-dashed rounded-3">
        <input type="file" name="avatar" id="avatarUpload" class="form-control form-control-sm bg-white"
          accept="image/*">
        <div class="form-text text-muted small mt-1">Format: JPG, PNG. Maks: 2MB.</div>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold small text-secondary">Nama Lengkap <span class="text-danger">*</span></label>
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-user"></i></span>
        <input type="text" name="name" class="form-control bg-light border-start-0" placeholder="Contoh: Budi Santoso"
          required>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold small text-secondary">Alamat Email <span class="text-danger">*</span></label>
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-envelope"></i></span>
        <input type="email" name="email" class="form-control bg-light border-start-0" placeholder="nama@email.com"
          required>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Password <span class="text-danger">*</span></label>
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-lock"></i></span>
          <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="••••••"
            required>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Role <span class="text-danger">*</span></label>
        <select name="role" class="form-select bg-light" required>
          <option value="">-- Pilih --</option>
          <option value="user">User (Mahasiswa)</option>
          <option value="admin">Administrator</option>
        </select>
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