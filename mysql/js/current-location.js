var toolbar = mdc.toolbar.MDCToolbar.attachTo(document.querySelector(".mdc-toolbar"));

// Fix toolbar to top
toolbar.fixedAdjustElement = document.querySelector(".mdc-toolbar-fixed-adjust");

// Instantiate profile expandable menu
let menu = new mdc.menu.MDCSimpleMenu(document.querySelector(".mdc-simple-menu"));

// Instantiate textfield
mdc.textfield.MDCTextfield.attachTo(document.querySelector(".mdc-textfield"));

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

// CLick listeners for confirmation dialog
dialog.listen("MDCDialog:accept", function() {
	console.log("accepted");
});

dialog.listen("MDCDialog:cancel", function() {
	console.log("canceled");
});

// Click listener for FAB
document.querySelector("#to-reservation-fab").addEventListener("click", () => {
	dialog.show();
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
