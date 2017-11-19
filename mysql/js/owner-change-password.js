// Listen for update failure dialog activator
var updateFailureDialog = new mdc.dialog.MDCDialog(
    document.querySelector('#update-failure-dialog')
);

updateFailureDialog.listen('MDCDialog:accept', function() {
    window.location = '/mysql/customer-home.php';
});

updateFailureDialog.listen('MDCDialog:cancel', function() {
    window.location = '/mysql/customer-change-password.php';
});

document.getElementById('update-password-fab').addEventListener('click', () => {
    updateFailureDialog.show();
});
