const area = document.querySelector("textarea");

const textString =
`# You can use this HTML elements:
# <p></p>
# <h4></h4>
# <div class="content-img-container"></div>
# <blockquote> "some text" </blockquote>

<!-- text -->`;

if (!area.innerHTML) area.placeholder = textString;