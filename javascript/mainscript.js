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

/* custom cursor animation */
let html = document.documentElement;
let body = document.body;

let mouseCursor = document.querySelector(".cursor");
let navLinks = document.querySelectorAll('a');
let inputs = document.querySelectorAll("input");
let textarea = document.querySelector("textarea");

let fullDcoumentHeight = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);

window.addEventListener('mousemove', cursor);

function cursor(e) {
    mouseCursor.style.top = e.pageY + "px";
    mouseCursor.style.left = e.pageX + "px";

    if(e.pageX > document.documentElement.clientWidth || e.pageY > fullDcoumentHeight - 24) {
        mouseCursor.classList.add('hidecursor');
        html.classList.add('showcursor');
    } else {
        mouseCursor.classList.remove('hidecursor');
        html.classList.remove('showcursor');
    }
}

navLinks.forEach(link => {
    link.addEventListener("mouseover", () => {
        mouseCursor.classList.add('cursor-grow');
    });

    link.addEventListener("mouseleave", () => {
        mouseCursor.classList.remove('cursor-grow');
    });
});

$(document).ready(function() {
    $(document).mouseleave(function () {
        mouseCursor.style.display = 'none';
    });

    $(document).mouseenter(function () {
        mouseCursor.style.display = 'block';
    });

    /* disabling autocomplete form input field */
    $('input').attr('autocomplete','off');

    /* add weight to focused li-nav-item */
    const pagepathname = window.location.pathname;
    const page = pagepathname.replaceAll('/', '');
    
    if (page.indexOf('.php') !== -1 || page === "postssearch") $(`li#li-posts a`).addClass("addWeight");
    else $(`li#li-${page} a`).addClass("addWeight");
});