function bmrHesapla() {
    const bmrForm = document.getElementById('bmrForm');
    const boy = parseFloat(bmrForm.querySelector('#boy').value);
    const kilo = parseFloat(bmrForm.querySelector('#kilo').value);
    const yas = parseInt(bmrForm.querySelector('#yas').value);
    const cinsiyet = bmrForm.querySelector('input[name="gender"]:checked').value;

    if (!boy || !kilo || !yas) {
        alert("Ekspertiz için tüm veriler lazım beyim!");
        return;
    }

    let bmr;
    if (cinsiyet === 'male') {
        bmr = (10 * kilo) + (6.25 * boy) - (5 * yas) + 5;
    } else {
        bmr = (10 * kilo) + (6.25 * boy) - (5 * yas) - 161;
    }

    document.getElementById('bmrDeger').innerText = Math.round(bmr);
    document.getElementById('bmrSonuc').style.borderColor = "var(--accent-gold)";
}

function bmiHesapla() {
    const bmiForm = document.getElementById('bmiForm');
    const boy = parseFloat(bmiForm.querySelector('#boy').value) / 100;
    const kilo = parseFloat(bmiForm.querySelector('#kilo').value);

    if (!boy || !kilo) {
        alert("Boy ve kilo girmeden terazi çalışmaz!");
        return;
    }

    const bmi = kilo / (boy * boy);
    const bmiDeger = bmi.toFixed(1);
    document.getElementById('bmiDeger').innerText = bmiDeger;

    let durum = "";
    if (bmi < 18.5) durum = "Zayıf (Düşük Devir)";
    else if (bmi < 25) durum = "Normal (İdeal)";
    else if (bmi < 30) durum = "Kilolu (Ağır Yük)";
    else durum = "Obez (Ekspertiz Şart)";

    document.getElementById('bmiDurum').innerText = durum;
}

function yagHesapla() {
    const boy = parseFloat(document.getElementById('fat_boy').value);
    const bel = parseFloat(document.getElementById('fat_bel').value);
    const boyun = parseFloat(document.getElementById('fat_boyun').value);

    if (!boy || !bel || !boyun) {
        alert("Mezurayı tam gezdir beyim, eksik bilgi var!");
        return;
    }

    let yagOrani = 495 / (1.0324 - 0.19077 * Math.log10(bel - boyun) + 0.15456 * Math.log10(boy)) - 450;
    
    yagOrani = yagOrani.toFixed(1);
    document.getElementById('fatDeger').innerText = yagOrani;

    let kategori = "";
    if (yagOrani < 6) kategori = "Yarışma Formu";
    else if (yagOrani < 14) kategori = "Atletik";
    else if (yagOrani < 18) kategori = "Fit";
    else if (yagOrani < 25) kategori = "Ortalama";
    else kategori = "Yüksek";

    document.getElementById('fatDurum').innerText = kategori;
}