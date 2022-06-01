/* script for load more posts when is clicked the load-more btn, using asynchronous Ajax */
let loadBtn = document.getElementById("load-more");
if(loadBtn != null)
    loadBtn.onclick = loadposts;

let numOfPosts = 4;

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

        if(numOfPosts%4 != 0 || numOfPosts == 0) {
            loadBtn.style.opacity = "0.5";
            loadBtn.style.pointerEvents = "none";
        }
    }
}
