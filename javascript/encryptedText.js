/* home effect: encrypted/decrypted text */
if(sessionStorage.getItem('wasAnimated') == null)
    sessionStorage.setItem('wasAnimated', false);    

let sessionVar = sessionStorage.getItem('wasAnimated');

const toggleEffect = document.querySelector(".home-effect");
const introBtn = document.getElementsByClassName("intro");

//removed latin letters: 'DEPLYCOINTS' to make them appear less often
const latin = 'ABFGHJKMQRUVWXZ';
const nums = '0123456789';
const otherSimbols = '.,:;"\'*+-/=<>_#!?%&|$';
const alphabet = latin + nums + otherSimbols;

let text = document.querySelectorAll(".hometext");
let letterscopy =  [];

for(let i = 0; i < text.length; ++i) {
    
    let innerletters = text[i].innerHTML.split("");
    letterscopy = letterscopy.concat(innerletters);

    for(let j = 0; j < innerletters.length; ++j) {
        innerletters[j] = "<span class=\"letter "+i+j+"\">" + innerletters[j] + "</span>";
    }
    
    text[i].innerHTML = innerletters.join("");
}

let letters = document.querySelectorAll(".letter");
let speed = 20, intervalId, position = 0;

if(sessionVar == "false") {
    setTimeout(function() { endEffect() }, 2000);
    intervalId = window.setInterval(encryptLetters, speed);
} else {
    setTimeout(function() { endEffect() }, 10);
}

function encryptLetters() {
    let encrypt = Math.floor(Math.random() * 2);
    let whichchar = Math.floor(Math.random() * letters.length);
    const character = alphabet.charAt(Math.floor(Math.random() * alphabet.length));
    
    if(encrypt) {
        letters[whichchar].innerHTML = character;
        letters[whichchar].style.color = "var(--first)";
        letters[whichchar].style.backgroundColor = "var(--details)";
    }
    else {
        letters[whichchar].innerHTML = letterscopy[whichchar];
        letters[whichchar].style.color = "var(--details)";
        letters[whichchar].style.backgroundColor = "initial";
    }
}

function endEffect() {
    clearInterval(intervalId);
    speed = 40;
    intervalId = window.setInterval(decryptLetters, speed);
    setTimeout(function() { 
        clearInterval(intervalId);
        intervalId = null;
        showComponents();
        sessionStorage.setItem('wasAnimated', true);  
    }, 1000);
}

function decryptLetters() {
    if(position == letterscopy.length) return;
    
    letters[position].innerHTML = letterscopy[position];
    
    if(letterscopy[position] == letterscopy[position].toUpperCase() && 
        letterscopy[position].toLowerCase() != letterscopy[position].toUpperCase()) {
        
        letters[position].style.color = "var(--first)";
        letters[position].style.backgroundColor = "var(--details)";
    } else {
        letters[position].style.color = "var(--details)";
        letters[position].style.backgroundColor = "var(--first)";
    }

    position++;
}

function showComponents() {
    toggleEffect.classList.remove("home-effect");
    introBtn[0].style.opacity = "1";
    introBtn[1].style.opacity = "1";
    introBtn[2].style.opacity = "1";
    introBtn[0].style.visibility = "initial";
    introBtn[1].style.visibility = "initial";
    introBtn[2].style.visibility = "initial";
    setTimeout(function() {
        introBtn[1].style.transition = "0.25s";
        introBtn[2].style.transition = "0.50s";
    }, 2000);
}