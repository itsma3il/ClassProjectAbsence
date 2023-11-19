function toggle_overlay() {
    let overlay = document.getElementById('overlay-add-stagiaire');
    overlay.style.display = (overlay.style.display === 'none' || overlay.style.display === '') ? 'flex' : 'none';
}