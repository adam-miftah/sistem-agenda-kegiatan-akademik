<form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="modal-header border-0 pb-0">
    <div>
      <h5 class="modal-title fw-bold text-dark" id="modalLabel">Edit Pengguna</h5>
      <p class="text-muted small mb-0">Perbarui informasi akun <strong>{{ $user->name }}</strong>.</p>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body pt-4">

    <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 border">
      <img src="{{ $user->avatar_url }}" alt="Avatar" class="rounded-circle shadow-sm border me-3 bg-white"
        style="width: 60px; height: 60px; object-fit: cover;">

      <div class="flex-grow-1">
        <label class="form-label fw-bold small text-dark mb-1">Ganti Foto Profil</label>
        <input type="file" name="avatar" class="form-control form-control-sm bg-white" accept="image/*">
        <div class="form-text text-muted" style="font-size: 0.7rem;">Kosongkan jika tidak ingin mengubah foto.</div>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold small text-secondary">Nama Lengkap <span class="text-danger">*</span></label>
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-user"></i></span>
        <input type="text" name="name" class="form-control bg-light border-start-0"
          value="{{ old('name', $user->name) }}" required>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold small text-secondary">Alamat Email <span class="text-danger">*</span></label>
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-envelope"></i></span>
        <input type="email" name="email" class="form-control bg-light border-start-0"
          value="{{ old('email', $user->email) }}" required>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Password Baru</label>
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-key"></i></span>
          <input type="password" name="password" class="form-control bg-light border-start-0"
            placeholder="Biarkan kosong">
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Role <span class="text-danger">*</span></label>
        <select name="role" class="form-select bg-light" required>
          <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User (Mahasiswa)</option>
          <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
        </select>
      </div>
    </div>
  </div>

  <div class="modal-footer border-0 pt-0 px-4 pb-4">
    <button type="button" class="btn btn-secondary text-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-warning text-dark px-4 rounded-pill shadow-sm">
      <i class="fas fa-save me-2"></i> Update Data
    </button>
  </div>
</form>