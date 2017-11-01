var toolbar = mdc.toolbar.MDCToolbar.attachTo(document.querySelector('.mdc-toolbar'));
toolbar.fixedAdjustElement = document.querySelector('.mdc-toolbar-fixed-adjust');

let menu = new mdc.menu.MDCSimpleMenu(document.querySelector('.mdc-simple-menu'));

// Dialog instantiation
mdc.dialog.MDCDialog.attachTo(document.querySelector('#invite-dialog'));

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

// Toggle buttons
mdc.iconToggle.MDCIconToggle.attachTo(document.querySelector('.mdc-icon-toggle'));

// Active Friends popup listener
var dialog = document.getElementById("active-friends-dialog");
var dialogUnderlay = document.getElementById("dialog-underlay");

document.querySelector('#active-friends').addEventListener('click', () => {
    if (dialog.style.display != "block") {
        dialog.style.display = "block";
        dialogUnderlay.style.display = "block";
    } else {
        // dialog.style.display= "none";
    }
})

document.querySelector('#dialog-close-button').addEventListener('click', () => {
    if (dialog.style.display != "block") {
        dialog.style.display = "block";
        dialogUnderlay.style.display = "block";
    } else {
        dialog.style.display = "none";
        dialogUnderlay.style.display = "none";
    }
})

// Listen for invite dialog activator
var inviteDialog = new mdc.dialog.MDCDialog(document.querySelector('#invite-dialog'));

inviteDialog.listen('MDCDialog:accept', function () {
    window.location = "/mysql/recommendation-invite.php";
})

inviteDialog.listen('MDCDialog:cancel', function () {
    console.log('canceled');
})

document.getElementById('recommended-list').addEventListener('click', () => {
    inviteDialog.show();
})

// Recommendations list click listener
// document.getElementById('recommended-list').addEventListener('click', () => {
//     document.getElementById("loading-progress").style.display = 'inline';
// })