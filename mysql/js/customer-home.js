var toolbar = mdc.toolbar.MDCToolbar.attachTo(document.querySelector('.mdc-toolbar'));
toolbar.fixedAdjustElement = document.querySelector('.mdc-toolbar-fixed-adjust');

let menu = new mdc.menu.MDCSimpleMenu(document.querySelector('.mdc-simple-menu'));

// Profile menu - Individual menu selection listenr
document.querySelector('#menu-edit-profile-button').addEventListener('click', () => {
    alert(`Edit Profile Clicked!`);
})

document.querySelector('#menu-show-history-button').addEventListener('click', () => {
    alert(`Show History Clicked!`);
})

document.querySelector('#menu-change-password-button').addEventListener('click', () => {
    alert(`Change Password Clicked!`);
})

document.querySelector('#menu-logout-button').addEventListener('click', () => {
    window.location = "/mysql/index.html";
})

// Toolbar button selection listener
document.querySelector('#notifications-nav').addEventListener('click', () => {
    
})

document.querySelector('#friends-list-nav').addEventListener('click', () => {

})

document.querySelector('#customer-profile').addEventListener('click', () => menu.open = !menu.open);

// Toggle buttons
mdc.iconToggle.MDCIconToggle.attachTo(document.querySelector('.mdc-icon-toggle'));