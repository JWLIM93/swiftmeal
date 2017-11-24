// Listen for update failure dialog activator
var updateFailureDialog = new mdc.dialog.MDCDialog(
    document.querySelector('#update-failure-dialog')
);

updateFailureDialog.listen('MDCDialog:accept', function() {
   window.location = 'owner-edit-profile.php';
});

updateFailureDialog.listen('MDCDialog:cancel', function() {
	window.location = 'owner-home.php';
});

document.getElementById('edit-profile-fab').addEventListener('click', () => {
	
    var name = document.getElementById("name-input-box").value;
    var email = document.getElementById("email-address-input-box").value;
    var mobile = document.getElementById("mobile-input-box").value;
	
    if (name == '' && email == '' && mobile == '' ) {
		//Telling the user to fill up the textfield
		if(name == ''){
			var element = document.getElementById("name-validation-msg");
			element.innerHTML = "Please fill in at least one particular!";
			//document.changePasswordForm.userPassword.focus();
		}
		if(email == ''){
			var element = document.getElementById("email-address-validation-msg");
			element.innerHTML = "Please fill in at least one particular!";
			//document.changePasswordForm.userNewPassword.focus();
		}
		if(mobile == ''){
			var element = document.getElementById("mobile-validation-msg");
			element.innerHTML = "Please fill in at least one particular!";
			//document.changePasswordForm.userConfirmNewPassword.focus();
		}
    }else{
        $.ajax({
            url: 'scripts/profile-operations.php?name='+document.getElementById("name-input-box").value+'&email='+document.getElementById("email-address-input-box").value+'&mobile='+document.getElementById("mobile-input-box").value,
            data: { action: 'editProfileInformationCUST' },
            type: 'post',
            success: function(output) {
                console.log(output);
                if(output == "succeed"){
                    window.location = 'customer-home.php';
                }
                else{
                    updateFailureDialog.show();
                }
            }
        })
    }
});
