/* functions for form client-side checks, creating users and login */
const signupform  = document.querySelector("#signupform");
const loginform   = document.querySelector("#loginform");
const contactform = document.querySelector("#contactform");
const errorPar    = document.querySelector("#errorMessage");

function checkSignupForm(){
    const email     = signupform.email;
    const username  = signupform.username;
    const password  = signupform.password;
    const password2 = signupform.passwordRepeated;
	
    let pattern, message;

    message = "There are empty fields! Fill in the fields marked with *";
    if(email.value.trim() == "" || username.value.trim() == "" || password.value.trim() == "" || password2.value.trim() == "") {
        printError(email, message);
        return false;
    }

    clearMessage(email);

    pattern = /^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	message = "Please enter a valid email!";
	if(!validaPatternChars(email.value, pattern)) {
        printError(email, message);
	 	return false;
	}

    clearMessage(email);

	pattern = /^([a-zA-Z0-9\_\-])+$/;
	message = `The username field can contain:
    <ul>
        <li>unaccented letters</li>
        <li>numbers- symbols _ e -</li>
    </ul>`;

	if(!validaPatternChars(username.value, pattern)) {
		printError(username, message);
	 	return false;
	}

    clearMessage(username);

	pattern = /(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
	message = `Please enter a valid password! It must have:
    <ul>
        <li>more than 8 characters</li>
        <li>numbers- symbols _ e -</li>
        <li>at least one uppercase character</li>
        <li>at least one number</li>
        <li>at least one special character among <strong>!@#$%^&*</strong>.</li>
    </ul>`;
    
    if(!validaPatternChars(password.value, pattern)) {
        printError(password, message);
	 	return false;
	}

    clearMessage(username);
    
    message = "The confirmation password does not match!";
	if(password.value != passwordR.value){
        printError(password, message);
		return false;
	}

    clearMessage(password);

	return false;

}

function checkLoginForm() {
    const username  = loginform.username;
    const password  = loginform.password;
    let message;

    message = "There are empty fields! Fill in username and password.";
    if(username.value.trim() == "" || password.value.trim() == "") {
        printError(username, message);
        return false;
    }

    clearMessage(username);

	return true;
}

function checkContactForm() {
    const email  = contactform.email;
    const name  = contactform.name;
    const text  = contactform.body;
    let message;

    message = "There are empty fields! Fill in email, name and message field.";
    if(email.value.trim() == "" || name.value.trim() == "" || text.value.trim() == "") {
        printError(name, message);
        return false;
    }

    clearMessage(email);

    pattern = /^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	message = "Please enter a valid email!";
	if(!validaPatternChars(email.value, pattern)) {
        printError(email, message);
	 	return false;
	}

    clearMessage(email);

	return true;
}

function validaPatternChars(fieldvalue, pattern){
	if (!pattern.test(fieldvalue)) return false;
	else return true; 
}

function printError(field, message){
    field.focus();
    field.style.borderColor = "red";
    errorPar.innerHTML = message;
    return;
}

function clearMessage(field) {
    field.style.borderColor = "initial";
    errorPar.innerHTML = "";
    return;
}