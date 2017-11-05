// Get required components for interaction
var toolbar = mdc.toolbar.MDCToolbar.attachTo(document.querySelector(".mdc-toolbar"));
var activeFriendDialog = document.getElementById("active-friends-dialog");
var dialogUnderlay = document.getElementById("dialog-underlay");
var inviteDialog = new mdc.dialog.MDCDialog(document.querySelector("#invite-dialog"));
var recommendations = document.getElementsByClassName("mdc-list-item");
var recommendationMarkers = document.getElementsByClassName("marker");
var recommendationFocusDialog = document.getElementById("recommendation-focus-dialog");
var recommendationDialogProceedButton = document.getElementById("recommendation-focus-dialog-proceed-button");
var loadingBar = document.getElementById("loading-progress");
var recommendButton = document.getElementById("request-recommendations");
var recommendedList = document.getElementById("recommended-list");

// Fix toolbar to top
toolbar.fixedAdjustElement = document.querySelector(".mdc-toolbar-fixed-adjust");

// Instantiate profile expandable menu
let menu = new mdc.menu.MDCSimpleMenu(document.querySelector(".mdc-simple-menu"));

// Dialog instantiation
mdc.dialog.MDCDialog.attachTo(document.querySelector("#invite-dialog"));

// Toggle button instantiation
mdc.iconToggle.MDCIconToggle.attachTo(document.querySelector(".mdc-icon-toggle"));

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

// Recommend button listener
recommendButton.addEventListener("click", () => {
	loadingBar.style.display = "block";
	recommendedList.style.display = "block";
	recommendButton.style.display = "none";

	// Populate markers with actual coordinates
	populateMarkers();
});

// Active Friends popup listener
document.querySelector("#active-friends").addEventListener("click", () => {
	if (activeFriendDialog.style.display != "block") {
		activeFriendDialog.style.display = "block";
		dialogUnderlay.style.display = "block";
	} else {
		// dialog.style.display= "none";
	}
});

document.querySelector("#dialog-close-button").addEventListener("click", () => {
	if (activeFriendDialog.style.display != "block") {
		activeFriendDialog.style.display = "block";
		dialogUnderlay.style.display = "block";
	} else {
		activeFriendDialog.style.display = "none";
		dialogUnderlay.style.display = "none";
	}
});

// Recommendation Focus dialog listener
document.querySelector("#recommendation-focus-dialog-close-button").addEventListener("click", () => {
	if (recommendationFocusDialog.style.display != "block") {
		recommendationFocusDialog.style.display = "block";
		dialogUnderlay.style.display = "block";
	} else {
		recommendationFocusDialog.style.display = "none";
		dialogUnderlay.style.display = "none";
	}
});

recommendationDialogProceedButton.addEventListener("click", () => {
	recommendationFocusDialog.style.display = "none";
	// dialogUnderlay.style.display = "none";
	inviteDialog.show();
});

// Listen for invite dialog activator
inviteDialog.listen("MDCDialog:accept", function() {
	loadingBar.style.display = "block";
	dialogUnderlay.style.display = "none";
	window.location = "/mysql/recommendation-invite.php";
});

inviteDialog.listen("MDCDialog:cancel", function() {
	dialogUnderlay.style.display = "none";
});

// Listen for dialog underlay layer click, dimiss all pop-ups
dialogUnderlay.addEventListener("click", () => {
	// Clear active friends dialog
	activeFriendDialog.style.display = "none";

	// Clear recommendation focus dialog
	recommendationFocusDialog.style.display = "none";

	dialogUnderlay.style.display = "none";
});

// Listen if user selects any recommendations from the list
document.getElementById("recommended-list").addEventListener("click", () => {
	// Get which item in the list is clicked and activate the corresponding marker
	// For testing only activate one, change when merge
	var markerToFocus = recommendationMarkers[0];

	// After which, set focus on the marker corresponds to the list item.
	markerToFocus.style.borderColor = "var(--mdc-theme-primary)";
	markerToFocus.style.borderStyle = "solid";
	markerToFocus.style.borderWidth = "2.5px";

	// Fly map deeper to the marker
	markerToMapFocus(103.86033, 1.283951);
});
