$(document).ready(function() {
    let cards = document.querySelectorAll(".card");
    
    cards.forEach(link => {
        link.addEventListener("mouseover", () => {
            mouseCursor.classList.add('cursor-grow');
        });

        link.addEventListener("mouseleave", () => {
            mouseCursor.classList.remove('cursor-grow');
        });
    });
});