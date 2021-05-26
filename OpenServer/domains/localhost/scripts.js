function ShowList() {
    var list = document.getElementById('submenu');
    list.style.display = 'block';
    list.style.background = 'rgb(0, 195, 135)';
    list.style.zIndex = 999;
}

function ShowList1() {
    var list = document.getElementById('submenu1');
    list.style.display = 'block';
    list.style.background = 'rgb(236, 195, 135)';
    list.style.zIndex = 999;
}

function closeList() {
    var list = document.getElementById('submenu');
    list.style.display = 'none';
}


function closeList1() {
    var list = document.getElementById('submenu1');
    list.style.display = 'none';
}

function gotogame(id) {
    location = "game.php?game=" + id;
}