const area = document.querySelector("textarea");

let textString = `
/* text */


# You can use this HTML elements:
# <p></p>
# <h4></h4>
# <div class="content-img-container"></div>
# <blockquote> "some text" </blockquote>    
`;

if (!area.innerHTML) area.innerHTML = textString;