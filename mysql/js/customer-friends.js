var toolbar = mdc.toolbar.MDCToolbar.attachTo(document.querySelector('.mdc-toolbar'));
toolbar.fixedAdjustElement = document.querySelector('.mdc-toolbar-fixed-adjust');

let menu = new mdc.menu.MDCSimpleMenu(document.querySelector('.mdc-simple-menu'));

// Profile menu - Individual menu selection listenr
document.querySelector('#menu-edit-profile-button').addEventListener('click', () => {
    window.location = "/mysql/customer-edit-profile.html";
})

document.querySelector('#menu-show-history-button').addEventListener('click', () => {
    alert(`Show History Clicked!`);
})

document.querySelector('#menu-change-password-button').addEventListener('click', () => {
    alert(`Change Password Clicked!`);
})

document.querySelector('#menu-back-home-button').addEventListener('click', () => {
    window.location = "/mysql/customer-home.html";
})

document.querySelector('#menu-logout-button').addEventListener('click', () => {
    window.location = "/mysql/index.html";
})

// Toolbar button selection listener
document.querySelector('#notifications-nav').addEventListener('click', () => {
    
})

document.querySelector('#friends-list-nav').addEventListener('click', () => {
    window.location = "/mysql/customer-friends.html";
})

document.querySelector('#customer-profile').addEventListener('click', () => menu.open = !menu.open);

// Toggle buttons
mdc.iconToggle.MDCIconToggle.attachTo(document.querySelector('.mdc-icon-toggle'));

// Recommendations list click listener
// document.getElementById('recommended-list').addEventListener('click', () => {
//     document.getElementById("loading-progress").style.display = 'inline';
// })