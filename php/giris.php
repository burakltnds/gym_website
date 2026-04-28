<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = trim($_POST['kullanici_adi']);
    $pass = $_POST['sifre'];

    try {
        $sorgu = $con->prepare("SELECT * FROM kullanicilar WHERE kullanici_adi = ?");
        $sorgu->execute([$user_name]);
        $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($kullanici && password_verify($pass, $kullanici['sifre'])) {
            
            $_SESSION['user_id'] = $kullanici['id'];
            $_SESSION['username'] = $kullanici['kullanici_adi'];

            if ($kullanici['boy'] == 0 || $kullanici['kilo'] == 0) {
                header("Location: ../html/karakter_kurulum.html");
            } else {

                header("Location: ../html/anasayfa.php");
            }
            exit();
        } else {
            echo "<script>alert('Kullanıcı adı veya şifre hatalı'); history.back();</script>";
        }
    } catch (PDOException $e) {
        die("Hata: " . $e->getMessage());
    }
}
?>