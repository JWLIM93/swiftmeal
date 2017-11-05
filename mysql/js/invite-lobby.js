var toolbar = mdc.toolbar.MDCToolbar.attachTo(document.querySelector(".mdc-toolbar"));
const snackbar = new mdc.snackbar.MDCSnackbar(document.querySelector(".mdc-snackbar"));
const snackbarMessageObj = {
	message: "Waiting for friends ...",
	timeout: 9999999
};
var confirmReserveDialog = new mdc.dialog.MDCDialog(document.querySelector(".mdc-dialog"));

snackbar.show(snackbarMessageObj);

// Fix toolbar to top
toolbar.fixedAdjustElement = document.querySelector(".mdc-toolbar-fixed-adjust");

// Instantiate profile expandable menu
let menu = new mdc.menu.MDCSimpleMenu(document.querySelector(".mdc-simple-menu"));

// Instantiate snackbar
mdc.snackbar.MDCSnackbar.attachTo(document.querySelector(".mdc-snackbar"));

// Instantiate confirmation dialog
mdc.dialog.MDCDialog.attachTo(document.querySelector(".mdc-dialog"));

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
confirmReserveDialog.listen("MDCDialog:accept", function() {
	window.location = "/mysql/current-location.php";
});

confirmReserveDialogdialog.listen("MDCDialog:cancel", function() {
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
