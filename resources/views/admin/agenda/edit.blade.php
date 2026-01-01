<form action="{{ route('user.agendas.update', $agenda->id) }}" method="POST">
  @csrf
  @method('PUT')

  <div class="modal-header border-0 pb-0">
    <div>
      <h5 class="modal-title fw-bold text-dark" id="modalLabel">Edit Agenda</h5>
      <p class="text-muted small mb-0">Perbarui informasi kegiatan.</p>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body pt-4">
    <div class="mb-3">
      <label class="form-label fw-bold small text-secondary">Judul Kegiatan <span class="text-danger">*</span></label>
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-heading"></i></span>
        <input type="text" name="title" class="form-control bg-light border-start-0"
          value="{{ old('title', $agenda->title) }}" required>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Tanggal <span class="text-danger">*</span></label>
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0 text-muted"><i class="far fa-calendar-alt"></i></span>
          <input type="date" name="date" class="form-control bg-light border-start-0"
            value="{{ old('date', $agenda->date) }}" required>
        </div>
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold small text-secondary">Jam <span class="text-danger">*</span></label>
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0 text-muted"><i class="far fa-clock"></i></span>
          <input type="time" name="time" class="form-control bg-light border-start-0"
            value="{{ old('time', $agenda->time) }}" required>
        </div>
      </div>
    </div>

    <div class="row g-3 mt-1">
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
          <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-map-marker-alt"></i></span>
          <input type="text" name="location" class="form-control bg-light border-start-0"
            value="{{ old('location', $agenda->location) }}">
        </div>
      </div>
    </div>

    <div class="mt-3">
      <label class="form-label fw-bold small text-secondary">Catatan / Deskripsi</label>
      <textarea name="description" class="form-control bg-light"
        rows="3">{{ old('description', $agenda->description) }}</textarea>
    </div>
  </div>

  <div class="modal-footer border-0 pt-0 px-4 pb-4">
    <button type="button" class="btn btn-secondary text-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-warning text-dark px-4 rounded-pill shadow-sm">
      <i class="fas fa-save me-2"></i> Update Perubahan
    </button>
  </div>
</form>