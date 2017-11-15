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
    <link rel="stylesheet" href="css/place-direction.css">

    <!-- GLOBAL CSS -->
    <link rel="stylesheet" href="css/common.css">

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- AHEAD JAVASCRIPT -->
</head>

<body>
    <header class="mdc-toolbar mdc-toolbar--fixed mdc-toolbar--waterfall mdc-theme--dark">
        <div class="mdc-toolbar__row">
            <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
                <span id="product-name" class="mdc-toolbar__title">SWIFTMEAL</span>
                <span id="page-name">Directions</span>
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
    <main class="mdc-toolbar-fixed-adjust">
        <div id="foreground-content" class="mdc-layout-grid mdc-layout-grid--fixed-column-width">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                <div id="place-direction-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                    <div id="reservation-info" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <div id="reservation-info-inner" class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
                                    <p id="reservation-id-header">Reservation</p>
                                    <h1 id="reservation-id">#5578210</h1>
                                    <p id="reservation-date-created">10 November 2017, 12:35PM</p>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
                                    <hr>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                                    <h2 id="restaurant-name">Justin's Grill & Bar</h2>
                                    <p id="pax">Table for 20</p>
                                    <p id="datetime">21 November 2017, 6:00PM</p>
                                </div>
                                <div id="navigation-drive-choice" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle">
                                    <i id="car-icon" class="material-icons">directions_car</i>
                                    <p class="icon-text">Drive</p>
                                </div>
                                <div id="navigation-transit-choice" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle">
                                    <i id="transit-icon" class="material-icons">directions_transit</i>
                                    <p class="icon-text">Transit</p>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
            </div>
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                <div id="driving-direction-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                    <div id="direction-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h3 id="direction-type">Driving Directions</h3>
                            <div id="from-address">
                                <i class="material-icons for-directions-icon">place</i>
                                <span class="for-directions-address">21 East Coast Park, Singapore 137768</span>
                            </div>
                            <div id="to-address">
                                <i class="material-icons for-directions-icon">directions</i>
                                <span class="for-directions-address">12 Shenton Way, Singapore 453368</span>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
            </div>
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                <div id="transit-direction-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                    <div id="direction-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h3 id="direction-type">Transit Directions</h3>
                            <div id="from-address">
                                <i class="material-icons for-directions-icon">place</i>
                                <span class="for-directions-address">21 East Coast Park, Singapore 137768</span>
                            </div>
                            <div id="to-address">
                                <i class="material-icons for-directions-icon">directions</i>
                                <span class="for-directions-address">12 Shenton Way, Singapore 453368</span>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
            </div>
            <!-- Floating Action Button -->
            <button id="done-fab" class="mdc-fab material-icons app-fab--absolute mdc-theme--dark" aria-label="Favorite" data-mdc-auto-init="MDCRipple">
                <span class="mdc-fab__icon">
                    check
                </span>
            </button>
    </main>

    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script>
        window.mdc.autoInit();
    </script>
    <script src="js/toolbar.js"></script>
    <script src="js/place-direction.js"></script>
</body>

</html>