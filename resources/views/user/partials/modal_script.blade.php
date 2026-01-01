<div class="modal fade" id="genericModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center py-5">
        <div class="spinner-border text-primary"></div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const modalEl = document.getElementById('genericModal');
    const bsModal = new bootstrap.Modal(modalEl);
    const content = modalEl.querySelector('.modal-content');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    document.body.addEventListener('click', e => {
      const btn = e.target.closest('.btn-modal-action');
      if (btn) {
        bsModal.show();
        content.innerHTML = '<div class="modal-body text-center py-5"><div class="spinner-border text-primary"></div></div>';
        fetch(btn.dataset.url).then(r => r.text()).then(h => content.innerHTML = h);
      }
    });

    document.body.addEventListener('click', e => {
      const btn = e.target.closest('.btn-delete-agenda');
      if (btn) {
        Swal.fire({
          title: 'Hapus Agenda?', text: "Agenda '" + btn.dataset.name + "' akan dihapus.", icon: 'warning',
          showCancelButton: true, confirmButtonText: 'Ya, Hapus!', confirmButtonColor: '#d33'
        }).then(res => {
          if (res.isConfirmed) {
            fetch(btn.dataset.url, {
              method: 'DELETE', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
            }).then(r => r.json()).then(d => {
              Swal.fire('Terhapus!', d.message, 'success');
              btn.closest('tr').remove();
            });
          }
        });
      }
    });
  });
</script>