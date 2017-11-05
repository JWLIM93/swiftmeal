function submitLogin() {
	var email = document.forms["registerForm"]["userEmail"].value;
	var password = document.forms["registerForm"]["userPassword"].value;
	//var emailRe = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");

	if (email == "" && password == "") {
		//alert("Please Enter All fields");

		document.getElementById("password_error_msg").innerHTML = "Please fill in your password!";
		document.getElementById("email_error_message").innerHTML = "Please enter a proper email!";
		document.registerForm.userEmail.focus();

		return false;
	} else if (password == "") {
		document.getElementById("password_error_msg").innerHTML = "Please fill in your password!";
		document.registerForm.userPassword.focus();
		return false;
	} else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
		document.getElementById("email_error_message").innerHTML = "Please enter a proper email!";
		document.registerForm.userEmail.focus();
		return false;
	} else if (password.length < 8) {
		document.getElementById("password_error_msg").innerHTML =
			"Password length suppose to be more then 8 characters!";
		document.registerForm.userPassword.focus();
		return false;
	}
	return true;
}
