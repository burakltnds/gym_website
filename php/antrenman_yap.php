<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        die("Hata: Oturum bulunamadı, lütfen tekrar giriş yapın.");
    }

    $user_id = $_SESSION['user_id'];
    $ana_kas = $_POST['ana_kas'];
    $alt_kas = $_POST['alt_kas'];
    $zorluk  = (int)$_POST['zorluk'];

    try {
        $sql = "UPDATE kas_alt_bolgeler SET $alt_kas = $alt_kas + ? WHERE user_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$zorluk, $user_id]);

        if ($stmt->rowCount() == 0) {
            $check = $con->prepare("SELECT user_id FROM kas_alt_bolgeler WHERE user_id = ?");
            $check->execute([$user_id]);
            if (!$check->fetch()) {
                $con->prepare("INSERT INTO kas_alt_bolgeler (user_id) VALUES (?)")->execute([$user_id]);
                $stmt->execute([$zorluk, $user_id]);
            }
        }

        $hesap_sql = "";
        $ana_sutun = "";
        $bolen = 1;
        
        switch ($ana_kas) {
            case 'omuz': $hesap_sql = "SELECT omuz_anterior, omuz_posterior, omuz_trapez FROM kas_alt_bolgeler WHERE user_id = ?"; $ana_sutun = "omuz_xp"; $bolen = 3; break;
            case 'kol': $hesap_sql = "SELECT kol_biceps, kol_triceps, kol_bilek FROM kas_alt_bolgeler WHERE user_id = ?"; $ana_sutun = "kol_xp"; $bolen = 3; break;
            case 'gogus': $hesap_sql = "SELECT gogus_ust, gogus_alt FROM kas_alt_bolgeler WHERE user_id = ?"; $ana_sutun = "gogus_xp"; $bolen = 2; break;
            case 'karin': $hesap_sql = "SELECT karin_ust, karin_alt, karin_oblik FROM kas_alt_bolgeler WHERE user_id = ?"; $ana_sutun = "karin_xp"; $bolen = 3; break;
            case 'sirt': $hesap_sql = "SELECT sirt_ust, sirt_alt FROM kas_alt_bolgeler WHERE user_id = ?"; $ana_sutun = "sirt_xp"; $bolen = 2; break;
            case 'bacak': $hesap_sql = "SELECT bacak_quadriceps, bacak_hamstring, bacak_kalf, bacak_kalca FROM kas_alt_bolgeler WHERE user_id = ?"; $ana_sutun = "bacak_xp"; $bolen = 4; break;
        }

        if ($hesap_sql != "") {
            $sorgu = $con->prepare($hesap_sql);
            $sorgu->execute([$user_id]);
            $veriler = $sorgu->fetch(PDO::FETCH_NUM); 

            if ($veriler) {
                $toplam = array_sum($veriler);
                $ortalama = $toplam / $bolen;
                
                if ($ortalama >= 100) {
                    $seviye_sutun = str_replace("_xp", "_lvl", $ana_sutun);
                    
                    $con->prepare("UPDATE kullanicilar SET $seviye_sutun = $seviye_sutun + 1 WHERE id = ?")->execute([$user_id]);


                    $reset_sql = "";
                    switch ($ana_kas) {
                        case 'omuz': $reset_sql = "UPDATE kas_alt_bolgeler SET omuz_anterior=0, omuz_posterior=0, omuz_trapez=0 WHERE user_id=?"; break;
                        case 'kol': $reset_sql = "UPDATE kas_alt_bolgeler SET kol_biceps=0, kol_triceps=0, kol_bilek=0 WHERE user_id=?"; break;
                        case 'gogus': $reset_sql = "UPDATE kas_alt_bolgeler SET gogus_ust=0, gogus_alt=0 WHERE user_id=?"; break;
                        case 'karin': $reset_sql = "UPDATE kas_alt_bolgeler SET karin_ust=0, karin_alt=0, karin_oblik=0 WHERE user_id=?"; break;
                        case 'sirt': $reset_sql = "UPDATE kas_alt_bolgeler SET sirt_ust=0, sirt_alt=0 WHERE user_id=?"; break;
                        case 'bacak': $reset_sql = "UPDATE kas_alt_bolgeler SET bacak_quadriceps=0, bacak_hamstring=0, bacak_kalf=0, bacak_kalca=0 WHERE user_id=?"; break;
                    }
                    if ($reset_sql != "") { $con->prepare($reset_sql)->execute([$user_id]); }

                    $yeni_ana_xp = 0;
                    $seviye_mesaji = "TEBRİKLER " . strtoupper($ana_kas) . " Seviye Atladı!";
                } else {
                    $yeni_ana_xp = $ortalama;
                    $seviye_mesaji = "Antrenman tamamlandı +$zorluk XP işlendi.";
                }


                $con->prepare("UPDATE kullanicilar SET $ana_sutun = ? WHERE id = ?")->execute([$yeni_ana_xp, $user_id]);

                $con->prepare("INSERT INTO antrenman_gecmisi (user_id, kas_grubu, alt_bolge, xp_kazanilan) VALUES (?, ?, ?, ?)")
                    ->execute([$user_id, $ana_kas, $alt_kas, $zorluk]);
                

                echo "<script>
                        alert('$seviye_mesaji');
                        window.location.href = '../html/gunluk_gorevler.php';
                      </script>";
            } else {
                die("Hata: Veri çekilemedi.");
            }
        }

    } catch (PDOException $e) {
        die("Hata: " . $e->getMessage());
    }
}
?>