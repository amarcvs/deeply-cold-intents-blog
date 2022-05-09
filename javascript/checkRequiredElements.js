const searchform  = document.querySelector('.requiredInput');

searchform.addEventListener('invalid', function (event) {
    if (event.target.validity.valueMissing) {
        event.target.setCustomValidity('Do not leave blank!');
    }
})

searchform.addEventListener('change', function (event) {
    event.target.setCustomValidity('');
})