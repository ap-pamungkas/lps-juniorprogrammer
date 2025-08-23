<?php


// Muat koneksi database dan PHPMailer
require_once '../db/connection.php';
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

                // Kirim notifikasi email ke admin menggunakan PHPMailer
                $mail = new PHPMailer(true);
                try {
                    // Konfigurasi SMTP
                    $mail->isSMTP();
                    $mail->Host = $_ENV['SMTP_HOST'];
                    $mail->SMTPAuth = true;
                    $mail->Username = $_ENV['SMTP_USER'];
                    $mail->Password = $_ENV['SMTP_PASS'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = $_ENV['SMTP_PORT'];

                    // Pengaturan email
                    $mail->setFrom($_ENV['SMTP_FROM'], $_ENV['SMTP_FROM_NAME']);
                    $mail->addAddress('agustinusputra94@gmail.com', 'Admin SMA Harapan Bangsa');
                    $mail->addReplyTo($email, $nama); // Balasan ke email pengirim

                    // Konten email
                    $mail->isHTML(true);
                    $mail->Subject = 'Pesan Kontak Baru dari Website';
                    $mail->Body = "
                        <h3>Pesan Kontak Baru</h3>
                        <p><strong>Nama:</strong> {$nama}</p>
                        <p><strong>Email:</strong> {$email}</p>
                        <p><strong>Pesan:</strong><br>" . nl2br($pesan) . "</p>
                        <p><small>Dikirim pada: " . date('Y-m-d H:i:s') . "</small></p>
                    ";
                    $mail->AltBody = "Pesan Kontak Baru\nNama: {$nama}\nEmail: {$email}\nPesan: {$pesan}\nDikirim pada: " . date('Y-m-d H:i:s');

                    // Kirim email
                    $mail->send();
                } catch (Exception $e) {
                    // Log error email, tapi tidak gagalakan response ke pengguna
                    error_log("Gagal mengirim email: {$mail->ErrorInfo}");
                }
            } else {
                $response['message'] = 'Gagal menyimpan pesan ke database.';
            }

            $stmt->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
            $response['message'] = 'Terjadi kesalahan saat menyimpan pesan.';
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
        <a href="contact.php" class="btn btn-primary">Kembali ke Formulir</a>
    </div>
</body>
</html>