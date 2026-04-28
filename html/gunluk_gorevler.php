<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/veriables.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/gunluk_gorevler.css">
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

        <section class="gorevler">
            <h2>Antrenmanını Planla</h2>
            
            <article>
                <form action="../php/antrenman_yap.php" method="POST">
                    <input type="hidden" name="ana_kas" value="omuz">
                    <h3>Omuz</h3>
                    <select name="alt_kas" required>    
                        <option value="">--- Seçiniz ---</option>
                        <option value="omuz_anterior">Anterior</option>
                        <option value="omuz_posterior">Posterior</option>
                        <option value="omuz_trapez">Trapez</option>
                    </select>
                    <div class="zorluk-grubu">          
                        <input type="radio" name="zorluk" value="5" id="o1" required> <label for="o1">Low</label>
                        <input type="radio" name="zorluk" value="10" id="o2"> <label for="o2">Mid</label>            
                        <input type="radio" name="zorluk" value="20" id="o3"> <label for="o3">High</label>
                    </div>
                    <button type="submit">Antrenmanı Kaydet ve XP Kazan</button>
                </form>
                <hr>
            </article>

            <article>
                <form action="../php/antrenman_yap.php" method="POST">
                    <input type="hidden" name="ana_kas" value="kol">
                    <h3>Kol</h3>
                    <select name="alt_kas" required>    
                        <option value="">--- Seçiniz ---</option>
                        <option value="kol_biceps">Biceps</option>
                        <option value="kol_triceps">Triceps</option>
                        <option value="kol_bilek">Bilek</option>
                    </select>
                    <div class="zorluk-grubu">
                        <input type="radio" name="zorluk" value="5" id="k1" required> <label for="k1">Low</label>
                        <input type="radio" name="zorluk" value="10" id="k2"> <label for="k2">Mid</label>
                        <input type="radio" name="zorluk" value="20" id="k3"> <label for="k3">High</label>
                    </div>
                    <button type="submit">Antrenmanı Kaydet ve XP Kazan</button>
                </form>
                <hr>
            </article>

            <article>
                <form action="../php/antrenman_yap.php" method="POST">
                    <input type="hidden" name="ana_kas" value="gogus">
                    <h3>Göğüs</h3>
                    <select name="alt_kas" required>    
                        <option value="">--- Seçiniz ---</option>
                        <option value="gogus_ust">Üst Göğüs</option>
                        <option value="gogus_alt">Alt Göğüs</option>
                    </select>
                    <div class="zorluk-grubu">
                        <input type="radio" name="zorluk" value="5" id="g1" required> <label for="g1">Low</label>
                        <input type="radio" name="zorluk" value="10" id="g2"> <label for="g2">Mid</label>
                        <input type="radio" name="zorluk" value="20" id="g3"> <label for="g3">High</label>
                    </div>
                    <button type="submit">Antrenmanı Kaydet ve XP Kazan</button>
                </form>
                <hr>
            </article>

            <article>
                <form action="../php/antrenman_yap.php" method="POST">
                    <input type="hidden" name="ana_kas" value="karin">
                    <h3>Karın</h3>
                    <select name="alt_kas" required>    
                        <option value="">--- Seçiniz ---</option>
                        <option value="karin_ust">Üst Karın</option>
                        <option value="karin_alt">Alt Karın</option>
                        <option value="karin_oblik">Oblikler</option>
                    </select>
                    <div class="zorluk-grubu">
                        <input type="radio" name="zorluk" value="5" id="ka1" required> <label for="ka1">Low</label>
                        <input type="radio" name="zorluk" value="10" id="ka2"> <label for="ka2">Mid</label>
                        <input type="radio" name="zorluk" value="20" id="ka3"> <label for="ka3">High</label>
                    </div>
                    <button type="submit">Antrenmanı Kaydet ve XP Kazan</button>
                </form>
                <hr>
            </article>

            <article>
                <form action="../php/antrenman_yap.php" method="POST">
                    <input type="hidden" name="ana_kas" value="sirt">
                    <h3>Sırt</h3>
                    <select name="alt_kas" required>    
                        <option value="">--- Seçiniz ---</option>
                        <option value="sirt_ust">Üst Sırt</option>
                        <option value="sirt_alt">Alt Sırt</option>
                    </select>
                    <div class="zorluk-grubu">
                        <input type="radio" name="zorluk" value="5" id="si1" required> <label for="si1">Low</label>
                        <input type="radio" name="zorluk" value="10" id="si2"> <label for="si2">Mid</label>
                        <input type="radio" name="zorluk" value="20" id="si3"> <label for="si3">High</label>
                    </div>
                    <button type="submit">Antrenmanı Kaydet ve XP Kazan</button>
                </form>
                <hr>
            </article>

            <article>
                <form action="../php/antrenman_yap.php" method="POST">
                    <input type="hidden" name="ana_kas" value="bacak">
                    <h3>Bacak</h3>
                    <select name="alt_kas" required>    
                        <option value="">--- Seçiniz ---</option>
                        <option value="bacak_quadriceps">Quadriceps</option>
                        <option value="bacak_hamstring">Hamstrings</option>
                        <option value="bacak_kalf">Kalf</option>
                        <option value="bacak_kalca">Kalça</option>
                    </select>
                    <div class="zorluk-grubu">
                        <input type="radio" name="zorluk" value="5" id="b1" required> <label for="b1">Low</label>
                        <input type="radio" name="zorluk" value="10" id="b2"> <label for="b2">Mid</label>
                        <input type="radio" name="zorluk" value="20" id="b3"> <label for="b3">High</label>
                    </div>
                    <button type="submit">Antrenmanı Kaydet ve XP Kazan</button>
                </form>
            </article>
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
        <script src="../js/gorevler.js"></script>
    </body>
</html>