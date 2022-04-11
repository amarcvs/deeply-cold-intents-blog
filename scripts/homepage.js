let allFormFields = new Array;
let sendBtn;
for (let i = 0; i < inputs.length; ++i)
    if(inputs[i].type != "submit")
        allFormFields.push(inputs[i]);
    else sendBtn = inputs[i];
    
allFormFields.push(textarea);

allFormFields.forEach(link => {
    link.addEventListener("mouseover", () => {
        mouseCursor.classList.add('cursor-change');
    });

    link.addEventListener("mouseleave", () => {
        mouseCursor.classList.remove('cursor-change');
    });
});

sendBtn.addEventListener("mouseover", () => {
    mouseCursor.classList.add('cursor-grow');
});

sendBtn.addEventListener("mouseleave", () => {
    mouseCursor.classList.remove('cursor-grow');
});