<?php
session_start();
include '../php/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: giris.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$sorgu = $con->prepare("SELECT * FROM kullanicilar WHERE id = ?");
$sorgu->execute([$user_id]);
$karakter = $sorgu->fetch(PDO::FETCH_ASSOC);

$toplam_lvl = $karakter['omuz_lvl'] + 
              $karakter['kol_lvl'] + 
              $karakter['gogus_lvl'] + 
              $karakter['sirt_lvl'] + 
              $karakter['karin_lvl'] + 
              $karakter['bacak_lvl'];

$genel_seviye = floor($toplam_lvl / 6);

$genel_xp_ortalama = ($karakter['omuz_xp'] + $karakter['kol_xp'] + $karakter['gogus_xp'] + 
                      $karakter['sirt_xp'] + $karakter['karin_xp'] + $karakter['bacak_xp']) / 6;

function kasRengiHesapla($mevcut_xp, $max_xp = 100) {
    if ($mevcut_xp <= 0) return "#e2e8f0"; 
    $oran = $mevcut_xp / $max_xp;
    if ($oran > 1) $oran = 1; 
    $alpha = 0.2 + ($oran * 0.8); 
    return "rgba(74, 222, 128, " . $alpha . ")"; 
}
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <title>GYM WEB - Anasayfa</title>
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/veriables.css">
        <link rel="stylesheet" href="../css/karakter-atlas.css">
    </head>
    
    <body>
        <nav id="navbar" class="navbar-ana">
            <a href="../index.html" class="baslik">
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

        <div class="main-icerik">
          <header class="kahraman-header">
            <h1>Kahraman: <?= htmlspecialchars($karakter['kullanici_adi']); ?> </h1>
            <div class="seviye-badge">Genel Seviye: <?= $genel_seviye; ?></div>
            <div class="genel-xp-bar-konteynir">
                <label>Sonraki Seviye: %<?= round($genel_xp_ortalama, 1); ?></label>
                <div class="progress-bar-dis">
                    <div class="progress-bar-ic" style="width: <?= $genel_xp_ortalama; ?>%;"></div>
                </div>
            </div>
          </header>

          <div class="panel-grid">
            
            <div class="sol-panel">
              <section class="gelisim-alani">
                <h3>Vücut Gelişim Alanı</h3>  
                
                <div class="stat-item">              
                    <div class="stat-header">        
                        <label>Omuz</label>        
                        <span class="lvl-badge">Lvl: <?= $karakter['omuz_lvl']; ?></span>
                    </div>
                    <progress value="<?= $karakter['omuz_xp']; ?>" max="100"></progress> <span>%<?= $karakter['omuz_xp']; ?></span>
                </div>
                
                <div class="stat-item">
                    <div class="stat-header">
                        <label>Sırt</label>
                        <span class="lvl-badge">Lvl: <?= $karakter['sirt_lvl']; ?></span>
                    </div>
                    <progress value="<?= $karakter['sirt_xp']; ?>" max="100"></progress> <span>%<?= $karakter['sirt_xp']; ?></span>                    
                </div>
                
                <div class="stat-item">
                    <div class="stat-header">
                        <label>Göğüs</label>
                        <span class="lvl-badge">Lvl: <?= $karakter['gogus_lvl']; ?></span>
                    </div>
                    <progress value="<?= $karakter['gogus_xp']; ?>" max="100"></progress> <span>%<?= $karakter['gogus_xp']; ?></span>
                </div>
                
                <div class="stat-item">
                    <div class="stat-header">
                        <label>Kol</label>
                        <span class="lvl-badge">Lvl: <?= $karakter['kol_lvl']; ?></span>
                    </div>
                    <progress value="<?= $karakter['kol_xp']; ?>" max="100"></progress> <span>%<?= $karakter['kol_xp']; ?></span>
                </div>
                
                <div class="stat-item">
                    <div class="stat-header">
                        <label>Karın</label>
                        <span class="lvl-badge">Lvl: <?= $karakter['karin_lvl']; ?></span>
                    </div>
                    <progress value="<?= $karakter['karin_xp']; ?>" max="100"></progress> <span>%<?= $karakter['karin_xp']; ?></span>
                </div>
                
                <div class="stat-item">
                    <div class="stat-header">
                        <label>Bacak</label>
                        <span class="lvl-badge">Lvl: <?= $karakter['bacak_lvl']; ?></span>
                    </div>
                    <progress value="<?= $karakter['bacak_xp']; ?>" max="100"></progress> <span>%<?= $karakter['bacak_xp']; ?></span>
                </div>
              </section>

              <section class="istatistik-paneli">
                <h3>İstatistikler</h3>
                <div class="bilgi-satiri">
                  <p>Mevcut Kilo: <strong><?= $karakter['kilo']; ?> kg</strong></p>
                  <p>Hedef Kilo: <strong><?= $karakter['hedef_kilo']; ?> kg</strong></p>
                </div>
                <div class="ana-gorev">
                  <label>Ana Görev: <strong><?= htmlspecialchars($karakter['hedef_tur']); ?></strong></label>
                  <progress value="<?= $karakter['kilo']; ?>" max="<?= $karakter['hedef_kilo']; ?>"></progress>
                </div>
                <a href="karakter_kurulum.html" class="guncelle-link">Karakteri Güncelle</a>
              </section>
            </div>

            <div class="sag-panel">
              <section class="karakter-atlas-konteynir">
                  
                  <article class="vucut-on">
                    <h3>Ön Görünüm</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 550" class="vucut-svg"> 
                      <g class="vucut-grup"> 
                        <circle id="kafa_on" data-name="Kafa" cx="200" cy="50" r="25" fill="#e2e8f0" />         
                        
                        <path id="gogus" class="kas-parcasi" data-name="Göğüs" data-seviye="<?= $karakter['gogus_lvl']; ?>" data-xp="<?= $karakter['gogus_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['gogus_xp']); ?>;" d="M160,100 Q200,85 240,100 L245,160 Q200,170 155,160 Z" /> 
                        
                        <path id="karin" class="kas-parcasi" data-name="Karın" data-seviye="<?= $karakter['karin_lvl']; ?>" data-xp="<?= $karakter['karin_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['karin_xp']); ?>;" d="M165,170 Q200,170 235,170 L230,260 Q200,275 170,260 Z" />         
                        
                        <circle id="sol_omuz_on" class="kas-parcasi" data-name="Ön Omuz" data-seviye="<?= $karakter['omuz_lvl']; ?>" data-xp="<?= $karakter['omuz_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['omuz_xp']); ?>;" cx="135" cy="115" r="22" /> 
                        <circle id="sag_omuz_on" class="kas-parcasi" data-name="Ön Omuz" data-seviye="<?= $karakter['omuz_lvl']; ?>" data-xp="<?= $karakter['omuz_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['omuz_xp']); ?>;" cx="265" cy="115" r="22" />
 
                        <path id="sol_pazu_on" class="kas-parcasi" data-name="Biceps" data-seviye="<?= $karakter['kol_lvl']; ?>" data-xp="<?= $karakter['kol_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['kol_xp']); ?>;" d="M115,135 L100,210 L130,210 L145,145 Z" /> 
                        <path id="sag_pazu_on" class="kas-parcasi" data-name="Biceps" data-seviye="<?= $karakter['kol_lvl']; ?>" data-xp="<?= $karakter['kol_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['kol_xp']); ?>;" d="M285,135 L300,210 L270,210 L255,145 Z" /> 
                        
                        <path id="sol_on_kol_on" class="kas-parcasi" data-name="Bilek" data-seviye="<?= $karakter['kol_lvl']; ?>" data-xp="<?= $karakter['kol_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['kol_xp']); ?>;" d="M100,215 L85,300 L115,300 L130,215 Z" />
                        <path id="sag_on_kol_on" class="kas-parcasi" data-name="Bilek" data-seviye="<?= $karakter['kol_lvl']; ?>" data-xp="<?= $karakter['kol_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['kol_xp']); ?>;" d="M300,215 L315,300 L285,300 L270,215 Z" />         
                        
                        <path id="sol_ust_bacak_on" class="kas-parcasi" data-name="Quadriceps" data-seviye="<?= $karakter['bacak_lvl']; ?>" data-xp="<?= $karakter['bacak_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['bacak_xp']); ?>;" d="M170,270 L140,400 L180,400 L195,270 Z" />
                        <path id="sag_ust_bacak_on" class="kas-parcasi" data-name="Quadriceps" data-seviye="<?= $karakter['bacak_lvl']; ?>" data-xp="<?= $karakter['bacak_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['bacak_xp']); ?>;" d="M230,270 L260,400 L220,400 L205,270 Z" />
                      </g>
                    </svg>
                  </article>

                  <article class="vucut-arka">  
                    <h3>Arka Görünüm</h3>  
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 550" class="vucut-svg">  
                      <g class="vucut-grup">  
                        <circle id="kafa_arka" data-name="Kafa" cx="200" cy="50" r="25" fill="#e2e8f0" />          
                        
                        <path id="trapez" class="kas-parcasi" data-name="Trapez" data-seviye="<?= $karakter['sirt_lvl']; ?>" data-xp="<?= $karakter['sirt_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['sirt_xp']); ?>;" d="M180,75 L200,60 L220,75 L225,120 L175,120 Z" />  
                        <path id="sirt_kanat" class="kas-parcasi" data-name="Üst Sırt" data-seviye="<?= $karakter['sirt_lvl']; ?>" data-xp="<?= $karakter['sirt_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['sirt_xp']); ?>;" d="M160,120 Q200,100 240,120 L245,210 Q200,220 155,210 Z" />  
                        <path id="bel_arka" class="kas-parcasi" data-name="Alt Sırt" data-seviye="<?= $karakter['sirt_lvl']; ?>" data-xp="<?= $karakter['sirt_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['sirt_xp']); ?>;" d="M170,215 Q200,215 230,215 L225,260 Q200,270 175,260 Z" />  
                        
                        <circle id="sol_omuz_arka" class="kas-parcasi" data-name="Arka Omuz" data-seviye="<?= $karakter['omuz_lvl']; ?>" data-xp="<?= $karakter['omuz_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['omuz_xp']); ?>;" cx="135" cy="115" r="20" />  
                        <circle id="sag_omuz_arka" class="kas-parcasi" data-name="Arka Omuz" data-seviye="<?= $karakter['omuz_lvl']; ?>" data-xp="<?= $karakter['omuz_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['omuz_xp']); ?>;" cx="265" cy="115" r="20" />  
                        
                        <path id="sol_triceps" class="kas-parcasi" data-name="Triceps" data-seviye="<?= $karakter['kol_lvl']; ?>" data-xp="<?= $karakter['kol_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['kol_xp']); ?>;" d="M120,135 L105,210 L135,210 L150,145 Z" />        
                        <path id="sag_triceps" class="kas-parcasi" data-name="Triceps" data-seviye="<?= $karakter['kol_lvl']; ?>" data-xp="<?= $karakter['kol_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['kol_xp']); ?>;" d="M280,135 L295,210 L265,210 L250,145 Z" />  
                        
                        <path id="kalca" class="kas-parcasi" data-name="Kalça" data-seviye="<?= $karakter['bacak_lvl']; ?>" data-xp="<?= $karakter['bacak_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['bacak_xp']); ?>;" d="M165,260 Q200,250 235,260 L230,320 Q200,330 170,320 Z" />  
                        <path id="sol_arka_bacak" class="kas-parcasi" data-name="Hamstring" data-seviye="<?= $karakter['bacak_lvl']; ?>" data-xp="<?= $karakter['bacak_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['bacak_xp']); ?>;" d="M170,325 L140,450 L180,450 L195,325 Z" />  
                        <path id="sag_arka_bacak" class="kas-parcasi" data-name="Hamstring" data-seviye="<?= $karakter['bacak_lvl']; ?>" data-xp="<?= $karakter['bacak_xp']; ?>" style="fill: <?= kasRengiHesapla($karakter['bacak_xp']); ?>;" d="M230,325 L260,450 L220,450 L205,325 Z" />  
                      </g>  
                    </svg>  
                  </article>
              </section> 
            </div> 
          </div>
        </div>
    
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
        <script src="../js/karakter-atlas.js"></script>
        


        <div id="vucut-tooltip"></div>
    </body>
</html>