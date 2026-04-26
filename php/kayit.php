<?php
// Hataları görmek için (Geliştirme aşamasında hayat kurtarır)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php'; // Veritabanı bağlantısı

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // HTML'deki 'name' özniteliklerini yakalıyoruz
    $user = $_POST['kullanici_adi'];
    $mail = $_POST['email'];
    $pass = $_POST['sifre'];

    // Şifreyi güvenlik için hashliyoruz
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    try {
        // Hazır sorgu (SQL Injection koruması)
        $sorgu = $con->prepare("INSERT INTO kullanicilar (kullanici_adi, email, sifre) VALUES (?, ?, ?)");
        $sorgu->execute([$user, $mail, $hashed_pass]);

        // Başarılıysa kullanıcıyı geri gönder
        echo "<script>
                alert('Karakter oluşturuldu beyim! Aramıza hoş geldin.');
                window.location.href = '../../index.html';
              </script>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "<script>alert('Bu kullanıcı adı veya e-posta zaten kapılmış!'); history.back();</script>";
        } else {
            echo "Ekspertiz Hatası: " . $e->getMessage();
        }
    }
}
?>