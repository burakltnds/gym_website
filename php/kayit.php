<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['kullanici_adi'];
    $mail = $_POST['email'];
    $pass = $_POST['sifre'];

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    try {

        $sorgu = $con->prepare("INSERT INTO kullanicilar (kullanici_adi, email, sifre) VALUES (?, ?, ?)");
        $sorgu->execute([$user, $mail, $hashed_pass]);

        $yeni_user_id = $con->lastInsertId();

        $sorgu_alt = $con->prepare("INSERT INTO kas_alt_bolgeler (user_id) VALUES (?)");
        $sorgu_alt->execute([$yeni_user_id]);

        echo "<script>
                alert('Karakter oluşturuldu Aramıza hoş geldin.');
                window.location.href = '../index.html';
              </script>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "<script>alert('Bu kullanıcı adı veya e-posta zaten alınmış!'); history.back();</script>";
        } else {
            echo "Hata: " . $e->getMessage();
        }
    }
}
?>