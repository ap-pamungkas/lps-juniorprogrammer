$(document).ready(function() {
    // Validasi form saat submit
    $('.contact-form').on('submit', function(e) {
        e.preventDefault(); // Mencegah submit default
        // Reset pesan error
        $('.form-error').remove();
        let isValid = true;

        // Ambil elemen form
        const nama = $('#nama').val().trim();
        const email = $('#email').val().trim();
        const pesan = $('#pesan').val().trim();

        // Validasi nama
        if (!nama) {
            $('#nama').after('<div class="form-error text-danger">Nama wajib diisi.</div>');
            isValid = false;
        } else if (nama.length > 100) {
            $('#nama').after('<div class="form-error text-danger">Nama maksimal 100 karakter.</div>');
            isValid = false;
        }

        // Validasi email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email) {
            $('#email').after('<div class="form-error text-danger">Email wajib diisi.</div>');
            isValid = false;
        } else if (!emailRegex.test(email)) {
            $('#email').after('<div class="form-error text-danger">Format email tidak valid.</div>');
            isValid = false;
        } else if (email.length > 100) {
            $('#email').after('<div class="form-error text-danger">Email maksimal 100 karakter.</div>');
            isValid = false;
        }
        // Validasi pesan
        if (!pesan) {
            $('#pesan').after('<div class="form-error text-danger">Pesan wajib diisi.</div>');
            isValid = false;
        }
        // Jika validasi lolos, kirim data via AJAX
        if (isValid) {
            $.ajax({
                url: 'backend/submit_contact.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // Nonaktifkan tombol submit selama pengiriman
                    $('.contact-form button').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...');
                },
                success: function(response) {
                    // Tampilkan pesan sukses atau gagal
                    const alertClass = response.success ? 'alert-success' : 'alert-danger';
                    const alertMessage = `<div class="alert ${alertClass} mt-3">${response.message}</div>`;
                    $('.contact-form').prepend(alertMessage);

                    // Jika sukses, reset form
                    if (response.success) {
                        $('.contact-form')[0].reset();
                    }
                },
                error: function() {
                    $('.contact-form').prepend('<div class="alert alert-danger mt-3">Terjadi kesalahan saat mengirim pesan.</div>');
                },
                complete: function() {
                    // Aktifkan kembali tombol submit
                    $('.contact-form button').prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i>Kirim Pesan');
                }
            });
        }
    });
});