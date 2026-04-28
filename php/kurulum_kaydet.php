<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../giris_islemleri/giris.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $boy        = $_POST['boy'];
    $kilo       = $_POST['kilo'];
    $hedef_kilo = $_POST['hedef_kilo'];
    $hedef_tur  = $_POST['hedef_tur'];

    try {
        $sql = "UPDATE kullanicilar SET boy = ?, kilo = ?, hedef_kilo = ?, hedef_tur = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        
        if ($stmt->execute([$boy, $kilo, $hedef_kilo, $hedef_tur, $user_id])) {
            echo "<script>
                    alert('Karakterin şekillendi !!! Şimdi antrenman vakti.');
                    window.location.href = '../html/anasayfa.php';
                  </script>";
        } else {
            echo "Veriler kaydedilirken bir hata oluştu.";
        }
    } catch (PDOException $e) {
        die("Veritabanı Hatası: " . $e->getMessage());
    }
}
?>