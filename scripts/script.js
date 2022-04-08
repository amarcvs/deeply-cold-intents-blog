/* menu animation */
const toggle = document.querySelector(".toggleMenu");
const navigation = document.querySelector(".navigation");

toggle.onclick = function() {
    toggle.classList.toggle("active");
    navigation.classList.toggle("active");
}

function toggleMenu() {
    toggle.classList.remove("active");
    navigation.classList.remove("active");
}