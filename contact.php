<?php include 'includes/header.php'; ?>

<!-- Contact Section -->
<section id="contact" class="py-5 mt-5">
  <div class="container">
    <div class="section-title">
      <h2>Hubungi Kami</h2>
      <p class="subtitle">Kirimkan pesan Anda untuk informasi lebih lanjut</p>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <form action="backend/submit_contact.php" method="POST" class="contact-form">
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
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
          </button>
        </form>
      </div>
      
      <div class="col-lg-6">
        <div class="contact-info">
          <h5>Kontak Kami</h5>
          <p><i class="fas fa-map-marker-alt me-2"></i>Jl. Pendidikan No. 123, Pontianak</p>
          <p><i class="fas fa-phone me-2"></i>(0561) 123-4567</p>
          <p><i class="fas fa-envelope me-2"></i>info@smaharapanbangsa.sch.id</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Tambahkan jQuery dan contact.js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="ajax/contact.js"></script>

<?php include 'includes/footer.php'; ?>