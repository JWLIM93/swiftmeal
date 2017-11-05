var x;

const select = new mdc.select.MDCSelect(document.querySelector(".mdc-select"));
select.listen("MDCSelect:change", () => {
	x = select.selectedOptions[0].textContent;
});

function submitRegister() {
	var email = document.forms["registerationForm"]["userEmail"].value;
	var password = document.forms["registerationForm"]["userPassword"].value;
	var name = document.forms["registerationForm"]["usersName"].value;
	var phone = document.forms["registerationForm"]["userPhone"].value;
	var repassword = document.forms["registerationForm"]["retypePassword"].value;
	//var emailRe = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");

	if (email == "" && password == "" && repassword == "" && phone == "" && name == "") {
		//alert("Please fill in all the fields");
		document.getElementById("password_error_msg").innerHTML = "Please fill in your password!";
		document.getElementById("email_error_msg").innerHTML = "Please enter a proper email!";
		document.getElementById("name_error_msg").innerHTML = "Please enter a name";
		document.getElementById("confirm_password_error_msg").innerHTML = "Please fill in your password";
		document.getElementById("phone_error_msg").innerHTML = "Please fill in your contact number";
		document.registerationForm.usersName.focus();
		return false;
	} else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
		document.getElementById("email_error_msg").innerHTML = "Please enter a proper email!";
		document.registerationForm.userEmail.focus();
		return false;
	} else if (password.length < 8) {
		document.getElementById("password_error_msg").innerHTML = "your password should be at least 8 character long!";
		document.registerationForm.userPassword.focus();
		return false;
	} else if (repassword.length < 8) {
		document.getElementById("confirm_password_error_msg").innerHTML =
			"your password should be at least 8 characters long!";
		document.registerationForm.retypePassword.focus();
		return false;
	} else if (password != repassword) {
		document.getElementById("confirm_password_error_msg").innerHTML = "your passwords is not the same!";
		document.registerationForm.retypePassword.focus();

		return false;
	} else if (!/^[a-zA-Z\s]*$/.test(name)) {
		document.getElementById("name_error_msg").innerHTML =
			"There should not be any symbols or numbers in your name!";
		document.registerationForm.usersName.focus();
		return false;
	} else if (!/^\d{8}$/.test(phone)) {
		document.getElementById("phone_error_msg").innerHTML = "There should not be any letters in your phone number!";
		document.registerationForm.userPhone.focus();
		return false;
	}

	document.getElementById("hidden").value = x;
	return true;
}
