/* menu animation */
const toggle = document.querySelector(".toggleMenu");
const navigation = document.querySelector(".navigation");

toggle.onclick = function() {
    toggle.classList.toggle("active");
    navigation.classList.toggle("active");
}

window.addEventListener("scroll", function() {
    const header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 0);
});

function toggleMenu() {
    toggle.classList.remove("active");
    navigation.classList.remove("active");
}