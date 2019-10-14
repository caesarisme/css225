var menu_toggle = document.getElementById('menu-toggle');
var menu = document.getElementById('menu');

menu_toggle.onclick = function() {
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
}
