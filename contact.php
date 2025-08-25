<?php include 'includes/header.php'; ?>

<!-- Contact Section -->
<section id="contact" class="py-5 mt-5">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2>Hubungi Kami</h2>
      <p class="subtitle">Kirimkan pesan Anda untuk informasi lebih lanjut</p>
    </div>

    <div class="row">
      <!-- Form Kontak -->
      <div class="col-lg-6 mb-4">
        <form action="backend/submit_contact.php" method="POST" class="contact-form p-4 shadow rounded bg-light">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" maxlength="100" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" maxlength="100" required>
          </div>
          <div class="mb-3">
            <label for="pesan" class="form-label">Pesan</label>
            <textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
          </button>
        </form>
      </div>
      
      <!-- Info Kontak -->
      <div class="col-lg-6">
        <div class="contact-info p-4 shadow rounded bg-white">
          <h5 class="mb-3">Kontak Kami</h5>
          <p><i class="fas fa-map-marker-alt text-danger me-2"></i>Jl. Pendidikan No. 123, Pontianak</p>
          <p><i class="fas fa-phone text-success me-2"></i>(0561) 123-4567</p>
          <p><i class="fas fa-envelope text-primary me-2"></i>info@smaharapanbangsa.sch.id</p>
          <p><i class="fas fa-clock text-warning me-2"></i>Senin - Jumat, 07:00 - 16:00</p>

          <div class="mt-3">
            <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn btn-outline-danger btn-sm me-2"><i class="fab fa-instagram"></i></a>
            <a href="#" class="btn btn-outline-danger btn-sm"><i class="fab fa-youtube"></i></a>
          </div>
        </div>

        <!-- Google Maps -->
        <div class="mt-4">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.3057072787!2d109.333!3d-0.022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d5d6f62d98f6b%3A0xabcdef123456789!2sPontianak!5e0!3m2!1sid!2sid!4v1692699999999"
            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Tambahkan jQuery dan contact.js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="ajax/contact.js"></script>

<?php include 'includes/footer.php'; ?>
