document.addEventListener("DOMContentLoaded", function() {
 
    const kaslar = document.querySelectorAll('.kas-parcasi');
    let tooltip = document.getElementById('vucut-tooltip');


    if (!tooltip) {
        tooltip = document.createElement('div');
        tooltip.id = 'vucut-tooltip';
        document.body.appendChild(tooltip);
    }

    kaslar.forEach(kas => {
  
        kas.addEventListener('mousemove', function(e) {

            const ad = this.getAttribute('data-name') || "Bilinmeyen Bölge";
            const seviye = this.getAttribute('data-seviye') || "1";
            const xp = this.getAttribute('data-xp') || "0";


            tooltip.innerHTML = `
                <div style="font-size: 1.1rem; color: var(--text-primary); margin-bottom: 3px; font-weight: 800;">${ad}</div>
                <div style="color: var(--accent-warm); font-size: 0.95rem; font-weight: 700;">
                    Lvl: ${seviye} <span style="color: var(--text-dim); font-size: 0.8rem; margin-left: 5px;">(${xp} XP)</span>
                </div>
            `;

            tooltip.style.display = 'block';
            tooltip.style.left = (e.pageX + 15) + 'px'; 
            tooltip.style.top = (e.pageY + 15) + 'px';  
        });


        kas.addEventListener('mouseleave', function() {
            tooltip.style.display = 'none';
        });
    });
});