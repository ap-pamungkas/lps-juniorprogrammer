<?php
// Koneksi database
require_once '../db/connection.php';
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Fungsi sanitasi input
function sanitizeInput(string $data): string {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Inisialisasi respons
$errors = [];
$response = ['success' => false, 'message' => ''];

// Jika request POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = isset($_POST['nama']) ? sanitizeInput($_POST['nama']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $pesan = isset($_POST['pesan']) ? sanitizeInput($_POST['pesan']) : '';

    // Validasi sederhana
    if (empty($nama)) {
        $errors[] = 'Nama wajib diisi.';
    } elseif (strlen($nama) > 100) {
        $errors[] = 'Nama maksimal 100 karakter.';
    }

    if (empty($email)) {
        $errors[] = 'Email wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid.';
    }

    if (empty($pesan)) {
        $errors[] = 'Pesan wajib diisi.';
    }

    if (empty($errors)) {
        try {
            // Simpan ke database
            $stmt = $conn->prepare("INSERT INTO pesan_kontak (nama, email, pesan) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nama, $email, $pesan);

            if ($stmt->execute()) {
         
                $mail = new PHPMailer(true);

                try {


$mail->isSMTP();
 
$mail->Host       = $_ENV['EMAIL_HOST'];
$mail->SMTPAuth   = true;
$mail->Username   = $_ENV['EMAIL_USER']; // ganti dengan email kamu
$mail->Password   = $_ENV['EMAIL_PASS']; // ganti dengan app password dari Google
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = $_ENV['SMTP_PORT'];

// Pengirim & penerima
$mail->setFrom($_ENV['EMAIL_USER'], 'Website Kontak');
$mail->addAddress($_ENV['EMAIL_ADMIN'], 'Admin'); 
$mail->addReplyTo($email, $nama);

// Isi email
$mail->isHTML(true);
$mail->Subject = 'Pesan Baru dari Form Kontak';
$mail->Body    = "
    <h3>Pesan Baru dari Website</h3>
    <p><b>Nama:</b> $nama</p>
    <p><b>Email:</b> $email</p>
    <p><b>Pesan:</b><br>$pesan</p>
";

                    $mail->send();

                    $response['success'] = true;
                    $response['message'] = 'Pesan berhasil dikirim dan email terkirim!';
                } catch (Exception $e) {
                    $response['success'] = false;
                    $response['message'] = "Pesan tersimpan, tetapi email gagal dikirim. Error: {$mail->ErrorInfo}";
                     $mail->SMTPDebug = 2; 
                    $mail->Debugoutput = 'html';
                }
            } else {
                $response['message'] = 'Gagal menyimpan pesan ke database.';
            }

            $stmt->close();
        } catch (Exception $e) {
            $response['message'] = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log($e->getMessage());
        }
    } else {
        $response['message'] = implode('<br>', $errors);
    }

    $conn->close();
} else {
    $response['message'] = 'Metode request tidak valid.';
}

// Jika request AJAX
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
