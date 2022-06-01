/* placeholder in manageArticle textarea */
const area = document.querySelector("textarea");

const textString =
`# You should use HTML tags fo a better view
<!-- text -->`;

if (!area.innerHTML) area.placeholder = textString;