var toolbar = mdc.toolbar.MDCToolbar.attachTo(document.querySelector(".mdc-toolbar"));

// Fix toolbar to top
toolbar.fixedAdjustElement = document.querySelector(".mdc-toolbar-fixed-adjust");

// Instantiate profile expandable menu
let menu = new mdc.menu.MDCSimpleMenu(document.querySelector(".mdc-simple-menu"));

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
document.querySelector("#done-fab").addEventListener("click", () => {
	window.location = "/mysql/customer-home.php";
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

// Dynamic Tabs
var dynamicTabBar = (window.dynamicTabBar = new mdc.tabs.MDCTabBar(document.querySelector("#dynamic-tab-bar")));
var dots = document.querySelector(".dots");
var panels = document.querySelector(".panels");

dynamicTabBar.tabs.forEach(function(tab) {
	tab.preventDefaultOnClick = true;
});

function updateDot(index) {
	var activeDot = dots.querySelector(".dot.active");
	if (activeDot) {
		activeDot.classList.remove("active");
	}
	var newActiveDot = dots.querySelector(".dot:nth-child(" + (index + 1) + ")");
	if (newActiveDot) {
		newActiveDot.classList.add("active");
	}
}

function updatePanel(index) {
	var activePanel = panels.querySelector(".panel.active");
	if (activePanel) {
		activePanel.classList.remove("active");
	}
	var newActivePanel = panels.querySelector(".panel:nth-child(" + (index + 1) + ")");
	if (newActivePanel) {
		newActivePanel.classList.add("active");
	}
}

dynamicTabBar.listen("MDCTabBar:change", function({ detail: tabs }) {
	var nthChildIndex = tabs.activeTabIndex;

	updatePanel(nthChildIndex);
	updateDot(nthChildIndex);
});

dots.addEventListener("click", function(evt) {
	if (!evt.target.classList.contains("dot")) {
		return;
	}

	evt.preventDefault();

	var dotIndex = [].slice.call(dots.querySelectorAll(".dot")).indexOf(evt.target);

	if (dotIndex >= 0) {
		dynamicTabBar.activeTabIndex = dotIndex;
	}

	updatePanel(dotIndex);
	updateDot(dotIndex);
});
