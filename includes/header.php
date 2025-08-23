<?php
// Set active page for navigation highlighting
$active_page = basename($_SERVER['PHP_SELF'], ".php");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMA Negeri Harapan Bangsa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <i class="fas fa-graduation-cap me-2"></i>
        SMA Negeri Harapan Bangsa
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo $active_page == 'index' ? 'active' : ''; ?>" href="index.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $active_page == 'about' ? 'active' : ''; ?>" href="about.php">Tentang Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $active_page == 'activities' ? 'active' : ''; ?>" href="activities.php">Kegiatan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $active_page == 'news' ? 'active' : ''; ?>" href="news.php">Berita</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $active_page == 'contact' ? 'active' : ''; ?>" href="contact.php">Kontak</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>