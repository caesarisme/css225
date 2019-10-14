function header_menu_toggle(btn) {
    var fas = document.getElementsByClassName("caret")[0];
    fas.classList.toggle("fa-caret-square-down");
    fas.classList.toggle("fa-caret-square-up");

    var ele = document.getElementById(btn.id);

    var nav = document.getElementById(ele.getAttribute("data-toggle"));
    nav.classList.toggle("active");
}