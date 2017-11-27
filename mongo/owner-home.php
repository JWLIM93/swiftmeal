<?php
include 'scripts/owner.php';
session_start();
$owner = $_SESSION['Obj'];
?>

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
    <link rel="stylesheet" href="css/owner-home.css">

    <!-- GLOBAL CSS -->
    <link rel="stylesheet" href="css/common.css">

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- AHEAD JAVASCRIPT -->
    <script src="js/owner-display.js"></script>
</head>

<body>
    <header class="mdc-toolbar mdc-toolbar--fixed mdc-toolbar--waterfall mdc-theme--dark">
        <div class="mdc-toolbar__row">
            <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
                <span id="product-name" class="mdc-toolbar__title">SWIFTMEAL</span>
                <span id="page-name">Home</span>
            </section>
            <!-- Navigation toolbar -->
            <section class="mdc-toolbar__section mdc-toolbar__section--align-end">
                <button id="owner-profile" class="mdc-button">Profile</button>
                <div id="owner-profile-menu" class="mdc-simple-menu" tabindex="-1" data-mdc-auto-init="MDCSimpleMenu">
                    <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                        <li id="menu-edit-profile-button" class="mdc-list-item" role="menuitem" tabindex="0">Edit Profile</li>
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
        <!-- <div id="map"></div> -->
        <div id="foreground-content" class="mdc-layout-grid mdc-layout-grid--fixed-column-width">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                    <div id="owner-info-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                                    <h2 id="owner-info-header">Welcome,</h2>
                                    <h1 id="owner-info-sub-header"><?php echo $owner->getFullName(); ?></h1>
                                    <h2 id="owner-info-description">Manage all of your restaurants right here.</h2>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--align-middle">
                                    <h1 id="restaurant-count-header"></h1>
                                    <h2 id="restaurant-count-sub-header">Restaurants</h2>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                    <div id="add-restaurant-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
                                    <h1 id="add-restaurant-header">Add Restaurant</h1>
                                    <h2 id="add-restaurant-sub-header">Fill up all neccessary information to add a new restaurant.</h2>
                                    <div id="inputs-container" class="mdc-layout-grid__inner">
                                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                                            <div class="mdc-text-field mdc-text-field--box">
                                                <input required type="text" id="restaurant-name" class="mdc-text-field__input" oninput="showConfirmDialog(this)">
                                                <label for="restaurant-name" class="mdc-text-field__label">Restaurant Name</label>
                                                <div class="mdc-text-field__bottom-line"></div>
                                            </div>
                                        </div>
                                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                                            <div class="mdc-text-field mdc-text-field--box">
                                                <input required type="text" id="restaurant-area" class="mdc-text-field__input" oninput="showConfirmDialog(this)">
                                                <label for="restaurant-area" class="mdc-text-field__label">Area</label>
                                                <div class="mdc-text-field__bottom-line"></div>
                                            </div>
                                        </div>
                                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                                            <div class="mdc-text-field mdc-text-field--box">
                                                <input type="text" id="restaurant-block" class="mdc-text-field__input" oninput="showConfirmDialog(this)">
                                                <label for="restaurant-block" class="mdc-text-field__label">Block</label>
                                                <div class="mdc-text-field__bottom-line"></div>
                                            </div>
                                        </div>
                                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                                            <div class="mdc-text-field mdc-text-field--box">
                                                <input type="text" id="restaurant-building" class="mdc-text-field__input" oninput="showConfirmDialog(this)">
                                                <label for="restaurant-building" class="mdc-text-field__label">Building</label>
                                                <div class="mdc-text-field__bottom-line"></div>
                                            </div>
                                        </div>
                                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                                            <div class="mdc-text-field mdc-text-field--box">
                                                <input type="text" id="restaurant-floor" class="mdc-text-field__input" oninput="showConfirmDialog(this)">
                                                <label for="restaurant-floor" class="mdc-text-field__label">Floor</label>
                                                <div class="mdc-text-field__bottom-line"></div>
                                            </div>
                                        </div>
                                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                                            <div class="mdc-text-field mdc-text-field--box">
                                                <input type="text" id="restaurant-street" class="mdc-text-field__input" oninput="showConfirmDialog(this)">
                                                <label for="restaurant-street" class="mdc-text-field__label">Street</label>
                                                <div class="mdc-text-field__bottom-line"></div>
                                            </div>
                                        </div>
                                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                                            <div class="mdc-text-field mdc-text-field--box">
                                                <input type="text" id="restaurant-unit" class="mdc-text-field__input" oninput="showConfirmDialog(this)">
                                                <label for="restaurant-unit" class="mdc-text-field__label">Unit</label>
                                                <div class="mdc-text-field__bottom-line"></div>
                                            </div>
                                        </div>
                                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                                            <div class="mdc-text-field mdc-text-field--box">
                                                <input required type="text" id="postal-code" class="mdc-text-field__input" oninput="showConfirmDialog(this)">
                                                <label for="postal-code" class="mdc-text-field__label">Postal Code</label>
                                                <div class="mdc-text-field__bottom-line"></div>
                                            </div>
                                        </div>
                                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                                            <div class="mdc-text-field mdc-text-field--box">
                                                <input required type="text" id="restaurant-lat" class="mdc-text-field__input" oninput="showConfirmDialog(this)">
                                                <label for="restaurant-lat" class="mdc-text-field__label">Geographical Latitude</label>
                                                <div class="mdc-text-field__bottom-line"></div>
                                            </div>
                                        </div>
                                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                                            <div class="mdc-text-field mdc-text-field--box">
                                                <input required type="text" id="restaurant-lng" class="mdc-text-field__input" oninput="showConfirmDialog(this)">
                                                <label for="restaurant-lng" class="mdc-text-field__label">Geographical Longitude</label>
                                                <div class="mdc-text-field__bottom-line"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                    <div id="confirm-add-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-11 mdc-layout-grid__cell--align-middle">
                                    <h1 id="confirm-header">Confirm and add your restaurant.</h1>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle">
                                    <i id="confirm-add-button" class="material-icons">check</i>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                    <div id="restaurants-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
                                    <h2 id="restaurants-header">View Restaurants</h2>
                                    <!-- <h2 id="restaurants-sub-header">You are currently managing 0 restaurants.</h2> -->
                                    <ul id="restaurants-list" class="mdc-list mdc-list--two-line mdc-list--avatar-list">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
            </div>
        </div>
        <div id="dialog-underlay" class="mdc-elevation--z14"></div>
        <!-- Floating Action Button - Invite selection -->
        <button id="new-restaurant-fab" class="mdc-fab material-icons app-fab--absolute" aria-label="New-Restaurant" data-mdc-auto-init="MDCRipple">
            <span class="mdc-fab__icon">
                add
            </span>
        </button>
    </main>

    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script>
        window.mdc.autoInit();
    </script>
    <script src="js/map.js"></script>
    <script src="js/toolbar-owner.js"></script>
    <script src="js/owner-home.js"></script>
</body>

</html>