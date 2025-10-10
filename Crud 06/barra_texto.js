let senhaInput = document.getElementById('senha');
let barra = document.getElementById('barra-forca');
let nivelTexto = document.getElementById('nivel-senha');

senhaInput.addEventListener('input', () => {
    let senha = senhaInput.value;
    let forca = calcularForca(senha);
    atualizarBarra(forca);
});

function calcularForca(senha) {
    let forca = 0;
    if(senha.length >= 8) forca++;
    if(/[A-Z]/.test(senha)) forca++;
    if(/[0-9]/.test(senha)) forca++;
    if(/[^a-zA-Z0-9]/.test(senha)) forca++;
    return forca; // 0 a 4
}

function atualizarBarra(forca) {
    let cores = ['#e74c3c','#e67e22','#f1c40f','#3498db','#2ecc71'];
    let niveis = ['Muito Fraca', 'Fraca', 'Média', 'Forte', 'Muito Forte'];

    barra.style.width = ((forca/4)*100) + '%';
    barra.style.backgroundColor = cores[forca];
    nivelTexto.textContent = niveis[forca];
}
