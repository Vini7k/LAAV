var activeMenu = null;

function toggleOptions(menuId) {
    var optionsMenu = document.getElementById(menuId);

    if (optionsMenu.style.display === "block" && activeMenu === menuId) {
        optionsMenu.style.display = "none";
        activeMenu = null;
    } 
    else {
        if (activeMenu !== null) {
        document.getElementById(activeMenu).style.display = "none";
    }
    optionsMenu.style.display = "block";
    activeMenu = menuId;
  }
}
// Fechar o menu se clicar fora dele
window.onclick = function(event) {
    if (!event.target.matches('.btn-edit-delete')) {
        if (activeMenu !== null) {
            document.getElementById(activeMenu).style.display = "none";
            activeMenu = null;
        }
    }
}