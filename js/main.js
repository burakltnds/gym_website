let sonKaydirma = 0;
const navbar = document.querySelector('.navbar-ana');

window.addEventListener('scroll', () => {
    let suAnki = window.pageYOffset;
    if (suAnki > sonKaydirma && suAnki > 100) {
        navbar.style.transform = "translateY(-100%)"; 
    } else {
        navbar.style.transform = "translateY(0)"; 
    }
    sonKaydirma = suAnki;
});


window.onload = () => {
    const barlar = document.querySelectorAll('progress');
    barlar.forEach(bar => {
        let hedef = bar.value;
        bar.value = 0; 
        setTimeout(() => {
            bar.value = hedef;
        }, 300);
    });
};

window.onload = function() {
    const barlar = document.querySelectorAll('progress');
    barlar.forEach(bar => {
        let hedefDeger = bar.value;
        bar.value = 0;
        setTimeout(() => {
            bar.value = hedefDeger;
        }, 100);
    });
};