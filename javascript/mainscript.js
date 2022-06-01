/* script common to all pages */

/* header menu animation */
const toggle = document.querySelector(".toggleMenu");
const navigation = document.querySelector(".navigation");
const pagepathname = window.location.pathname;
const page = pagepathname.replaceAll('/', '');

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

if (page.indexOf('.php') !== -1 || page === "postssearch") $(`li#li-posts a`).addClass("addWeight");
else $(`li#li-${page} a`).addClass("addWeight");

/* custom cursor animation */
const html = document.documentElement;
const body = document.body;
const navLinks = document.querySelectorAll('a');

window.addEventListener('mousemove', cursor);

function cursor(e) {
    mouseCursor.style.top = e.pageY + "px";
    mouseCursor.style.left = e.pageX + "px";
}

navLinks.forEach(link => {
    link.addEventListener("mouseover", () => {
        mouseCursor.classList.add('cursor-grow');
    });

    link.addEventListener("mouseleave", () => {
        mouseCursor.classList.remove('cursor-grow');
    });
});

const mouseCursor = document.querySelector(".cursor");

$(document).ready(function() {
    $(document).mouseleave(function () {
        mouseCursor.style.display = 'none';
    });

    $(document).mouseenter(function () {
        mouseCursor.style.display = 'block';
    });
});

let allFormFields = new Array;
let sendBtn;
let inputs = document.querySelectorAll("input");
let textarea = document.querySelector("textarea");

for (let i = 0; i < inputs.length; ++i)
    if(inputs[i].type != "submit")
        allFormFields.push(inputs[i]);
    else sendBtn = inputs[i];
    
allFormFields.push(textarea);

allFormFields.forEach(link => {
    if(link != null) {
        link.addEventListener("mouseover", () => {
            mouseCursor.classList.add('cursor-grow');
        });

        link.addEventListener("mouseleave", () => {
            mouseCursor.classList.remove('cursor-grow');
        });
    }
});
if(sendBtn != null) {
    sendBtn.addEventListener("mouseover", () => {
        mouseCursor.classList.add('cursor-grow');
    });

    sendBtn.addEventListener("mouseleave", () => {
        mouseCursor.classList.remove('cursor-grow');
    });
}

/* form */
$(document).ready(function() {
    /* disabling autocomplete form input field */
    $('input').attr('autocomplete','off');
});

const pushBtn = document.querySelector('#push');
if(pushBtn != null) {
    pushBtn.onclick = function() {
        if(document.querySelector('#newtopic input').value.length == 0) {
            alert("Please Enter a topic")
        }

        else {
            document.querySelector('#topics').innerHTML += `
                <input type="text" name="topics[]" value="${document.querySelector('#newtopic input').value}">
            `;

            document.querySelector('#topic-bar').value = "";

            let current_topics = document.querySelectorAll(".delete");
            for(let i = 0; i < current_topics.length; ++i) {
                current_topics[i].onclick = function() {
                    this.parentNode.remove();
                }
            }
        }
    }
}

/* warning message when done delicate operations */
function warnBeforeUnload() {
    const warning = "Are you sure you want to proceed?";
    if (confirm(warning)) return true;
    else return false;
}