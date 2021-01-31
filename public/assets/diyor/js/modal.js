var modal = document.getElementById("modalID");

var btn = document.getElementById("myBtn");

var span = document.getElementsByClassName("cls")[0];

btn.onclick = function() {
    modal.style.display = "block";
};

span.onclick = function() {
    modal.style.display = "none";
};


window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}