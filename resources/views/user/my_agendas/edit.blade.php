<form action="{{ route('user.agendas.update', $agenda->id) }}" method="POST">
  @csrf
  @method('PUT')

  <div class="modal-header border-0 pb-0">
    <div>
      <h5 class="modal-title fw-bold text-dark" id="modalLabel">Edit Agenda</h5>
      <p class="text-muted small mb-0">Perbarui informasi kegiatan Anda.</p>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body pt-4">
    <div class="mb-3">
      <label class="form-label fw-bold small text-secondary">Judul Kegiatan <span class="text-danger">*</span></label>
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0"><i class="fas fa-heading text-muted"></i></span>
        <input type="text" name="title" class="form-control bg-light border-start-0"
          value="{{ old('title', $agenda->title) }}" required>
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Tanggal <span class="text-danger">*</span></label>
        <input type="date" name="date" class="form-control bg-light" value="{{ old('date', $agenda->date) }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Jam <span class="text-danger">*</span></label>
        <input type="time" name="time" class="form-control bg-light" value="{{ old('time', $agenda->time) }}" required>
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Kategori <span class="text-danger">*</span></label>
        <select name="category" class="form-select bg-light" required>
          @foreach($categories as $cat)
            <option value="{{ $cat }}" {{ $agenda->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Lokasi</label>
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0"><i class="fas fa-map-marker-alt text-muted"></i></span>
          <input type="text" name="location" class="form-control bg-light border-start-0"
            value="{{ old('location', $agenda->location) }}">
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold small text-secondary">Catatan / Deskripsi</label>
      <textarea name="description" class="form-control bg-light"
        rows="3">{{ old('description', $agenda->description) }}</textarea>
    </div>
  </div>

  <div class="modal-footer border-0 pt-0">
    <button type="button" class="btn btn-light text-secondary px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-warning text-dark px-4 rounded-pill shadow-sm"><i class="fas fa-save me-2"></i>
      Update Perubahan</button>
  </div>
</form>