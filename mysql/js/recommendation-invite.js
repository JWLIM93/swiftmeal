var toolbar = mdc.toolbar.MDCToolbar.attachTo(document.querySelector(".mdc-toolbar"));
toolbar.fixedAdjustElement = document.querySelector(".mdc-toolbar-fixed-adjust");

let menu = new mdc.menu.MDCSimpleMenu(document.querySelector(".mdc-simple-menu"));

// Instantiate checkbox list
mdc.checkbox.MDCCheckbox.attachTo(document.querySelector(".mdc-checkbox"));

// Profile menu - Individual menu selection listenr
document.querySelector("#menu-edit-profile-button").addEventListener("click", () => {
	window.location = "/mysql/customer-edit-profile.php";
});

document.querySelector("#menu-show-history-button").addEventListener("click", () => {
	window.location = "/mysql/customer-history.php";
});

document.querySelector("#menu-change-password-button").addEventListener("click", () => {
	window.location = "/mysql/customer-change-password.php";
});

document.querySelector("#menu-back-home-button").addEventListener("click", () => {
	window.location = "/mysql/customer-home.php";
});

document.querySelector("#menu-logout-button").addEventListener("click", () => {
	window.location = "/mysql/index.php";
});

// Toolbar button selection listener
document.querySelector("#notifications-nav").addEventListener("click", () => {
	window.location = "/mysql/customer-notifications.php";
});

document.querySelector("#friends-list-nav").addEventListener("click", () => {
	window.location = "/mysql/customer-friends.php";
});

document.querySelector("#customer-profile").addEventListener("click", () => (menu.open = !menu.open));

// Click listener for FAB
document.querySelector("#add-friend-fab").addEventListener("click", () => {
	window.location = "/mysql/invite-lobby.php";
});

// Animate floating action button
window.onscroll = function() {
	hideFAB();
};

function hideFAB() {
	if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
		document.getElementById("add-friend-fab").classList.add("mdc-fab--exited");
	} else {
		document.getElementById("add-friend-fab").classList.remove("mdc-fab--exited");
	}
}
