<?php
session_start();
include '../php/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    $sorgu = $con->prepare("SELECT * FROM antrenman_gecmisi WHERE user_id = ? ORDER BY tarih DESC LIMIT 15");
    $sorgu->execute([$user_id]);
    $aktiviteler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Hata beyim: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/veriables.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/takvim.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <nav id="navbar" class="navbar-ana">
        <a href="anasayfa.php" class="baslik">
          <img src="../asset/dumbbell.png" alt="Logo" class="navbar-logo">
          <h1>GYM WEB</h1>
        </a>
        <ul class="nav-linkler">
            <li><a href="anasayfa.php">Anasayfa</a></li>
            <li><a href="gunluk_gorevler.php">Görevler</a></li>
            <li><a href="takvim.php">Takvim</a></li>
            <li><a href="calc.html">Hesaplamalar</a></li>
        </ul>
    </nav>

    <hr>

    <section class="antrenman-gunlugu">
        <header>
            <h2>Antrenman Takvimi ve Geçmişi</h2>
        </header>

        <main>
            <div class="takvim-izgarasi">
                <p><em>Son Aktivite Haritası</em></p>
                <div class="gun-kutucuklari">
                    </div>
            </div>

            <hr>

            <div class="gunluk-liste">
                <h3>Son Aktiviteler</h3>
                
                <?php if (count($aktiviteler) > 0): ?>
                    <?php foreach ($aktiviteler as $islem): ?>
                        <article class="gunluk-item">
                            <time datetime="<?php echo $islem['tarih']; ?>">
                                <?php echo date('d.m.Y - H:i', strtotime($islem['tarih'])); ?>
                            </time>
                            <ul>
                                <li>
                                    <strong><?php echo ucfirst($islem['kas_grubu']); ?>:</strong> 
                                    <?php echo str_replace('_', ' ', $islem['alt_bolge']); ?> 
                                    - <span class="xp">+<?php echo $islem['xp_kazanilan']; ?> XP</span>
                                </li>
                            </ul>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align:center; color: #777;">Antrenman kaydı bulunamadı, harekete geçin !!!</p>
                <?php endif; ?>
            </div>
        </main>
    </section>

    <footer class="ana-footer">   
          <h2>İLETİŞİM</h2>  
          <div class="footer-ikon-grubu">
            <a href="mailto:burakaltundas52@gmail.com" class="footer-link">   
              <img src="../asset/gmail.png" alt="Gmail">  
            </a>   
            <a href="https://github.com/burakltnds" target="_blank" class="footer-link">
              <img src="../asset/Github.png" alt="Github">
            </a>
            <a href="https://linkedin.com/burakltnds" target="_blank" class="footer-link">
              <img src="../asset/linkedin.png" alt="Linkedin">
            </a>
          </div>    
          <p class="telif-yazisi">&copy; 2026 GYM WEB | Burak ALTUNDAŞ</p>

        </footer>
    <script src="../js/main.js"></script>
</body>
</html>