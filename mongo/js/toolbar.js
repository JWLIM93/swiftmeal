var toolbar = mdc.toolbar.MDCToolbar.attachTo(
    document.querySelector('.mdc-toolbar')
);
toolbar.fixedAdjustElement = document.querySelector(
    '.mdc-toolbar-fixed-adjust'
);

let menu = new mdc.menu.MDCSimpleMenu(
    document.querySelector('.mdc-simple-menu')
);

// Profile menu - Individual menu selection listenr
document
    .querySelector('#menu-edit-profile-button')
    .addEventListener('click', () => {
        window.location = 'customer-edit-profile.php';
    });

document
    .querySelector('#menu-show-history-button')
    .addEventListener('click', () => {
        window.location = 'customer-history.php';
    });

document
    .querySelector('#menu-change-password-button')
    .addEventListener('click', () => {
        window.location = 'customer-change-password.php';
    });

document
    .querySelector('#menu-back-home-button')
    .addEventListener('click', () => {
        window.location = 'customer-home.php';
    });

document.querySelector('#menu-logout-button').addEventListener('click', () => {
    $.ajax({
        url: 'scripts/logout.php'
    });

    window.location = 'index.php';
});

// Toolbar button selection listener
document.querySelector('#notifications-nav').addEventListener('click', () => {
    window.location = 'customer-notifications.php';
});

document.querySelector('#friends-list-nav').addEventListener('click', () => {
    window.location = 'customer-friends.php';
});

document
    .querySelector('#customer-profile')
    .addEventListener('click', () => (menu.open = !menu.open));

document.querySelector('#product-name').addEventListener('click', () => {
    window.location = 'customer-home.php';
});
