var toolbar = mdc.toolbar.MDCToolbar.attachTo(document.querySelector('.mdc-toolbar'));
toolbar.fixedAdjustElement = document.querySelector('.mdc-toolbar-fixed-adjust');

let menu = new mdc.menu.MDCSimpleMenu(document.querySelector('.mdc-simple-menu'));
mdc.dialog.MDCDialog.attachTo(document.querySelector('#update-failure-dialog'));

// Profile menu - Individual menu selection listenr
document.querySelector('#menu-edit-profile-button').addEventListener('click', () => {
    window.location = "/mysql/customer-edit-profile.php";
})

document.querySelector('#menu-show-history-button').addEventListener('click', () => {
    window.location = "/mysql/customer-history.php";
})

document.querySelector('#menu-change-password-button').addEventListener('click', () => {
    window.location = "/mysql/customer-change-password.php";
})

document.querySelector('#menu-back-home-button').addEventListener('click', () => {
    window.location = "/mysql/customer-home.php";
})

document.querySelector('#menu-logout-button').addEventListener('click', () => {
    window.location = "/mysql/index.php";
})

// Toolbar button selection listener
document.querySelector('#notifications-nav').addEventListener('click', () => {
    window.location = "/mysql/customer-notifications.php";
})

document.querySelector('#friends-list-nav').addEventListener('click', () => {
    window.location = "/mysql/customer-friends.php";
})

document.querySelector('#customer-profile').addEventListener('click', () => menu.open = !menu.open);

// Listen for update failure dialog activator
var updateFailureDialog = new mdc.dialog.MDCDialog(document.querySelector('#update-failure-dialog'));

updateFailureDialog.listen('MDCDialog:accept', function () {
    window.location = "/mysql/customer-home.php";
})

updateFailureDialog.listen('MDCDialog:cancel', function () {
    window.location = "/mysql/customer-change-password.php";
})

document.getElementById('update-password-fab').addEventListener('click', () => {
    updateFailureDialog.show();
})