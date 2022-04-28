
let loadBtn = document.getElementById("load-more");
loadBtn.onclick = loadposts;

let numOfPosts = 3;

function loadposts(e) {
    let httpr = new XMLHttpRequest();
    httpr.onreadystatechange = manageResponse;
    httpr.open("GET", "index.php?more=" + numOfPosts, true);
    httpr.send();
}

function manageResponse(e) {
    if (e.target.readyState == XMLHttpRequest.DONE && e.target.status == 200) {
        let parser = new DOMParser();
	    let doc = parser.parseFromString(e.target.responseText, 'text/html');
        document.getElementsByName("contentBx")[0].innerHTML = doc.body.childNodes[3].childNodes[3].innerHTML;
        numOfPosts = doc.querySelectorAll('.postsColumn').length;

        if(numOfPosts%3 != 0 || numOfPosts == 0) loadBtn.style.visibility = "hidden";
    }
}
