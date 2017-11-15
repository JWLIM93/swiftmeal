<!DOCTYPE html>
<html class="mdc-typography">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SWIFTMEAL - Your Next Meal, Simplified</title>

    <!-- MAPBOX CDN -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.40.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.40.0/mapbox-gl.css' rel='stylesheet' />

    <!-- MATERIAL DESIGN COMPONENTS CDN -->
    <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">

    <!-- GOOGLE FONT - QUICKSANDS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:400,700">

    <!-- GOOGLE ICON FONT -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- LOCAL CSS -->
    <link rel="stylesheet" href="css/customer-friends.css">

    <!-- GLOBAL CSS -->
    <link rel="stylesheet" href="css/common.css">

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- AHEAD JAVASCRIPT -->
    <script src="js/friends-display.js"></script>

</head>

<body>
    <header class="mdc-toolbar mdc-toolbar--fixed mdc-toolbar--waterfall mdc-theme--dark">
        <div class="mdc-toolbar__row">
            <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
                <span id="product-name" class="mdc-toolbar__title">SWIFTMEAL</span>
                <span id="page-name">Friends</span>
            </section>
            <!-- Navigation toolbar -->
            <section class="mdc-toolbar__section mdc-toolbar__section--align-end">
                <button id="notifications-nav" class="mdc-button">Notifications</button>
                <button id="friends-list-nav" class="mdc-button">Friends</button>
                <button id="customer-profile" class="mdc-button">Profile</button>
                <div id="customer-profile-menu" class="mdc-simple-menu" tabindex="-1" data-mdc-auto-init="MDCSimpleMenu">
                    <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                        <li id="menu-edit-profile-button" class="mdc-list-item" role="menuitem" tabindex="0">Edit Profile</li>
                        <li id="menu-show-history-button" class="mdc-list-item" role="menuitem" tabindex="0">Show History</li>
                        <li id="menu-change-password-button" class="mdc-list-item" role="menuitem" tabindex="0">Change Password</li>
                        <li class="mdc-list-divider" role="separator"></li>
                        <li id="menu-back-home-button" class="mdc-list-item" role="menuitem" tabindex="0">Back to Home</li>
                        <li id="menu-logout-button" class="mdc-list-item" role="menuitem" tabindex="0">Logout</li>
                    </ul>
                </div>
            </section>
        </div>
        <div id="loading-progress" role="progressbar" class="mdc-linear-progress mdc-linear-progress--indeterminate mdc-theme--light">
            <div class="mdc-linear-progress__bar mdc-linear-progress__primary-bar">
                <span class="mdc-linear-progress__bar-inner"></span>
            </div>
            <div class="mdc-linear-progress__bar mdc-linear-progress__secondary-bar">
                <span class="mdc-linear-progress__bar-inner"></span>
            </div>
        </div>
    </header>
    <main class="mdc-toolbar-fixed-adjust mdc-theme--dark">
        <div id="overlay"></div>
        <div id="foreground-content" class="mdc-layout-grid mdc-layout-grid--fixed-column-width">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle">
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                    <div id="pending-request-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h1 id="pending-request-header">Pending Requests</h1>
                            <ul id="pending-request-list" class="mdc-list mdc-list--two-line mdc-list--avatar-list">
                            </ul>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                    <div id="friends-list-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h1 id="friends-list-header">Your Friends</h1>
                            <div class="mdc-grid-list mdc-grid-list--twoline-caption">
                                <ul id="friends-list" class="mdc-grid-list__tiles">
                                </ul>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
            </div>
        </div>
        <!-- Floating Action Button - Add Friend -->
        <button id="add-friend-fab" class="mdc-fab material-icons app-fab--absolute" aria-label="Favorite" data-mdc-auto-init="MDCRipple">
            <span class="mdc-fab__icon">
                add
            </span>
        </button>
        <!-- Popup dialog -->
        <div id="add-friend-dialog" class="mdc-layout-grid mdc-elevation--z14 md-theme--dark">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
                    <h1 id="dialog-header">Add a friend</h1>
                    <p id="dialog-description">You can easily add a friend by entering their email address.</p>
                    <div id="email-address-input" class=" mdc-text-field mdc-text-field--box" data-mdc-auto-init="MDCTextField">
                        <input type="text" id="tf-box" class=" mdc-text-field__input">
                        <label for="tf-box" class="mdc-text-field__label">Friend's Email Address</label>
                        <div class=" mdc-text-field__bottom-line"></div>
                    </div>
                    <div class="mdc-layout-grid__inner">
                        <div id="dialog-buttons-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid--align-right">
                            <button id="cancel-button" class="mdc-button" data-mdc-auto-init="MDCRipple">
                                Cancel
                            </button>
                            <button id="friend-request-button" class="mdc-button mdc-button--raised" data-mdc-auto-init="MDCRipple">
                                Request
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script>
        window.mdc.autoInit();
    </script>
    <script src="js/toolbar.js"></script>
    <script src="js/customer-friends.js"></script>
</body>

</html>