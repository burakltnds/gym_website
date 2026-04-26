const tooltip = document.createElement('div');
tooltip.id = 'vucut-tooltip';
document.body.appendChild(tooltip);

// Tüm kas parçalarını seç
const kaslar = document.querySelectorAll('.kas-parcasi');

kaslar.forEach(kas => {
    // Fare üzerine gelince
    kas.addEventListener('mousemove', (e) => {
        const bolgeAdi = kas.getAttribute('data-name') || "Bilinmeyen Bölge";
        const gelişim = kas.getAttribute('data-level') || "%0";

        tooltip.innerHTML = `<strong>${bolgeAdi}</strong><br>Gelişim: ${gelişim}`;
        tooltip.style.display = 'block';
        
        // Kutucuğu farenin ucuna yerleştir
        tooltip.style.left = e.pageX + 15 + 'px';
        tooltip.style.top = e.pageY + 15 + 'px';
    });

    // Fare ayrılınca gizle
    kas.addEventListener('mouseleave', () => {
        tooltip.style.display = 'none';
    });
});