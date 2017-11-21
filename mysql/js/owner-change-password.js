// Listen for update failure dialog activator
var updateFailureDialog = new mdc.dialog.MDCDialog(
    document.querySelector('#update-failure-dialog')
);

updateFailureDialog.listen('MDCDialog:accept', function() {
    window.location = '/mysql/owner-home.php';
});

updateFailureDialog.listen('MDCDialog:cancel', function() {
    window.location = '/mysql/owner-change-password.php';
});

document.getElementById('update-password-fab').addEventListener('click', () => {
    var userPassword = document.getElementById('current-password-input-box')
        .value;
    var userNewPassword = document.getElementById('new-password-input-box')
        .value;
    var userConfirmNewPassword = document.getElementById(
        'confirm-new-password-box'
    ).value;

    if (
        userPassword == '' &&
        userNewPassword == '' &&
        userConfirmNewPassword == ''
    ) {
        //Telling the user to fill up the textfield
        if (userPassword == '') {
            var element = document.getElementById('current_password_error_msg');
            element.innerHTML = 'Please fill in your current password!';
            //document.changePasswordForm.userPassword.focus();
        }
        if (userNewPassword == '') {
            var element = document.getElementById('new_password_error_msg');
            element.innerHTML = 'Please fill in your new password!';
            //document.changePasswordForm.userNewPassword.focus();
        }
        if (userConfirmNewPassword == '') {
            var element = document.getElementById('confirm_password_error_msg');
            element.innerHTML = 'Please fill in your confirm new password!';
            //document.changePasswordForm.userConfirmNewPassword.focus();
        }
    } else if (userNewPassword.length < 8) {
        //New Password must be longer than 8 Digit
        var element = document.getElementById('new_password_error_msg');
        element.innerHTML =
            'Minimum 8 characters are required for the new password!';
        //document.changePasswordForm.userPassword.focus();
    } else if (userNewPassword != userConfirmNewPassword) {
        //New Password & Confirm new PW must be the same
        var element = document.getElementById('new_password_error_msg');
        element.innerHTML =
            'Please verify that new password & confirm password is the same';
        var element = document.getElementById('confirm_password_error_msg');
        element.innerHTML =
            'Please verify that new password & confirm password is the same';
        //document.changePasswordForm.retypePassword.focus();
    } else {
        $.ajax({
            url:
                'scripts/profile-operations.php?OLDPW=' +
                document.getElementById('current-password-input-box').value +
                '&PW=' +
                document.getElementById('confirm-new-password-box').value,
            data: { action: 'changepw' },
            type: 'post',
            success: function(output) {
                console.log(output);
                if (output == 'succeed') {
                    window.location = '/mysql/owner-home.php';
                } else {
                    updateFailureDialog.show();
                }
            }
        });
    }
});

function submitRegister() {
    var userPassword =
        document.forms['changePasswordForm']['userPassword'].value;
    var userNewPassword =
        document.forms['changePasswordForm']['userNewPassword'].value;
    var userConfirmNewPassword =
        document.forms['changePasswordForm']['userConfirmNewPassword'].value;

    if (
        userPassword == '' &&
        userNewPassword == '' &&
        userConfirmNewPassword == ''
    ) {
        //Telling the user to fill up the textfield
        if (userPassword == '') {
            var element = document.getElementById('current_password_error_msg');
            element.innerHTML = 'Please fill in your current password!';
            //document.changePasswordForm.userPassword.focus();
        }
        if (userNewPassword == '') {
            var element = document.getElementById('new_password_error_msg');
            element.innerHTML = 'Please fill in your new password!';
            //document.changePasswordForm.userNewPassword.focus();
        }
        if (userConfirmNewPassword == '') {
            var element = document.getElementById('confirm_password_error_msg');
            element.innerHTML = 'Please fill in your confirm new password!';
            //document.changePasswordForm.userConfirmNewPassword.focus();
        }
        return false;
    } else if (userNewPassword.length < 8) {
        //New Password must be longer than 8 Digit
        var element = document.getElementById('new_password_error_msg');
        element.innerHTML =
            'Minimum 8 characters are required for the new password!';
        //document.changePasswordForm.userPassword.focus();
        return false;
    } else if (userNewPassword != userConfirmNewPassword) {
        //New Password & Confirm new PW must be the same
        var element = document.getElementById('new_password_error_msg');
        element.innerHTML =
            'Please verify that new password & confirm password is the same';
        var element = document.getElementById('confirm_password_error_msg');
        element.innerHTML =
            'Please verify that new password & confirm password is the same';
        //document.changePasswordForm.retypePassword.focus();
        return false;
    }
    document.getElementById('hidden').value = x;
    return true;
}
