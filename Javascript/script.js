if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

var modal = document.getElementById("modal");
var openBtn = document.getElementById("add");
var closeBtn = document.getElementById("close");

openBtn.onclick = function() {
    modal.style.display = "flex";
}

closeBtn.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}