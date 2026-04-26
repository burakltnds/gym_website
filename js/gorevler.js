function xpBildirimiGoster(baslik, mesaj) {
    let container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        document.body.appendChild(container);
    }


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


    setTimeout(() => {
        toast.classList.add('removing');
        toast.addEventListener('animationend', () => {
            toast.remove();
        });
    }, 3000);
}