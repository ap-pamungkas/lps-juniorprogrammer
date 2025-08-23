<?php

// Muat koneksi database
require_once '../db/connection.php';

// Fungsi untuk membersihkan input
function sanitizeInput(string $data): string {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Inisialisasi array untuk menyimpan error
$errors = [];
$response = ['success' => false, 'message' => ''];

// Cek apakah request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan sanitasi input
    $nama = isset($_POST['nama']) ? sanitizeInput($_POST['nama']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $pesan = isset($_POST['pesan']) ? sanitizeInput($_POST['pesan']) : '';

    // Validasi server-side
    if (empty($nama)) {
        $errors[] = 'Nama wajib diisi.';
    } elseif (strlen($nama) > 100) {
        $errors[] = 'Nama maksimal 100 karakter.';
    }

    if (empty($email)) {
        $errors[] = 'Email wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid.';
    } elseif (strlen($email) > 100) {
        $errors[] = 'Email maksimal 100 karakter.';
    }

    if (empty($pesan)) {
        $errors[] = 'Pesan wajib diisi.';
    }

    // Jika tidak ada error, simpan ke database
    if (empty($errors)) {
        try {
            // Siapkan query SQL
            $stmt = $conn->prepare("INSERT INTO pesan_kontak (nama, email, pesan) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nama, $email, $pesan);

            // Eksekusi query
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Pesan berhasil dikirim!';
            } else {
                $response['message'] = 'Gagal menyimpan pesan ke database.';
            }

            $stmt->close();
        } catch (Exception $e) {



            // $response['message'] = 'Terjadi kesalahan: ' . $e->getMessage();

            error_log($e->getMessage());
        }
    } else {
        $response['message'] = implode('<br>', $errors);
    }

    // Tutup koneksi
    $conn->close();
} else {
    $response['message'] = 'Metode request tidak valid.';
}

// Jika request adalah AJAX, kembalikan JSON
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}


?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pengiriman Kontak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $response['success'] ? 'Sukses' : 'Gagal'; ?></h2>
        <p><?php echo $response['message']; ?></p>
        <a href="index.php#contact" class="btn btn-primary">Kembali ke Formulir</a>
    </div>
</body>
</html>