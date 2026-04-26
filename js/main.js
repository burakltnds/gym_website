
let sonKaydirma = 0;
const navbar = document.querySelector('.navbar-ana');

window.addEventListener('scroll', () => {
    let suAnki = window.pageYOffset;
    if (suAnki > sonKaydirma && suAnki > 100) {
        navbar.style.transform = "translateY(-100%)"; // Gizle
    } else {
        navbar.style.transform = "translateY(0)"; // Göster
    }
    sonKaydirma = suAnki;
});

// 2. Progress Bar Animasyonu
window.onload = () => {
    const barlar = document.querySelectorAll('progress');
    barlar.forEach(bar => {
        let hedef = bar.value;
        bar.value = 0; // Sıfırla
        setTimeout(() => {
            bar.value = hedef; // Hedefe yumuşakça git
        }, 300);
    });
};

window.onload = function() {
    // Sayfadaki tüm progress etiketlerini bul
    const barlar = document.querySelectorAll('progress');

    barlar.forEach(bar => {
        // HTML'de yazdığın hedef değeri (mesela 80) bir kenara not al
        let hedefDeger = bar.value;

        // Barı önce görsel olarak sıfırla
        bar.value = 0;

        // Küçük bir gecikmeyle (100ms) hedef değere doğru fırlat
        setTimeout(() => {
            bar.value = hedefDeger;
        }, 100);
    });
};