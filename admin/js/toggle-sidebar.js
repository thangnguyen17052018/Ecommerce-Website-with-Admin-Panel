var wrapper = document.querySelector("#wrapper");
var toggleButton = document.querySelector("#menu-toggle");
var icon = document.querySelector(".fa-align-left");
toggleButton.onclick = () => {
    wrapper.classList.toggle("toggled");
    icon.classList.toggle("fa-align-right");
}