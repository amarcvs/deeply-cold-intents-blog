/* dark mode theme script */
let isLight = localStorage.getItem("lightMode");
let icon = "toggle-off";

if(isLight != undefined) {
    $("html").attr("data-theme", "light");
    icon = "toggle-on";
}

$(".theme_icon").toggleClass("fa-" + icon);

$(document).ready(function() {    
    $(".theme_icon").on('click', function() {
        $(".theme_icon").toggleClass("flip");
        $(".theme_icon").toggleClass("fa-toggle-off");
        $(".theme_icon").toggleClass("fa-toggle-on");

        let current_theme = $("html").attr("data-theme");

        if(current_theme == "dark") {
            $("html").attr("data-theme", "light");
            localStorage.setItem("lightMode", "true");
        }
        else if(current_theme == "light"){
            $("html").attr("data-theme", "dark");
            localStorage.removeItem("lightMode");
        }
    });
});