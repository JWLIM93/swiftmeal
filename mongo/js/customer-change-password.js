// Listen for update failure dialog activator
var updateFailureDialog = new mdc.dialog.MDCDialog(
    document.querySelector('#update-failure-dialog')
);

updateFailureDialog.listen('MDCDialog:accept', function() {
    window.location = 'customer-change-password.php';
});

updateFailureDialog.listen('MDCDialog:cancel', function() {
    window.location = 'customer-home.php';
});

document.getElementById('update-password-fab').addEventListener('click', () => {
    var currentPassword = document.forms['ChangePassword']['currentPW'].value;
    var newPassword = document.forms['ChangePassword']['newPW'].value;
    var confirmNewPassword =
        document.forms['ChangePassword']['confirmNewPW'].value;
    if (currentPassword.length >= 8 && currentPassword != '') {
        if (checkCurrentPassword(currentPassword)) {
            alert('test1');
            if (
                newPassword != currentPassword &&
                newPassword == confirmNewPassword &&
                newPassword.length > 8 &&
                confirmNewPassword.length > 8 &&
                newPassword != '' &&
                confirmNewPassword != ''
            ) {
                //updateFailureDialog.show();
                updatePassword(newPassword);
                //window.location = 'customer-home.php';
            } else {
                updateFailureDialog.show();
            }
        } else {
            updateFailureDialog.show();
        }
    }
});

function updatePassword(newPW) {
    let bool = false;
    $.ajax({
        type: 'POST',
        url: 'scripts/updatePassword.php',
        async: false,
        data: 'newPW=' + newPW,
        dataType: 'json'
    }).done(function(data) {
        if (data == true) {
            bool = true;
        }
    });
    return trueOrFalse(bool);
}

function checkCurrentPassword(currentPW) {
    let bool = false;
    $.ajax({
        type: 'POST',
        url: 'scripts/checkCurrentPassword.php',
        async: true,
        data: 'currentPW=' + currentPW,
        success: function(output) {
            if (output == 'success') {
                bool = true;
            } else {
                bool = false;
            }
        }
    });
    return bool;
}
