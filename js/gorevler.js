function xpBildirimiGoster(baslik, mesaj) {
    // Önce kapsayıcı div var mı kontrol et, yoksa oluştur
    let container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        document.body.appendChild(container);
    }

    // Yeni bildirim oluştur
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `
        <div class="toast-icon">🔥</div>
        <div class="toast-content">
            <strong>${baslik}</strong>
            <span>${mesaj}</span>
        </div>
    `;

    container.appendChild(toast);

    // 3 saniye sonra bildirimi kaldır
    setTimeout(() => {
        toast.classList.add('removing');
        toast.addEventListener('animationend', () => {
            toast.remove();
        });
    }, 3000);
}