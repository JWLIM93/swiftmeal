<?php
include 'scripts/customer.php';
session_start();
$customer = $_SESSION['Obj'];
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
        <link rel="stylesheet" href="css/invite-lobby.css">

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
                    <span id="page-name">Invitation Lobby</span>
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
                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle">
                    </div>
                    <div id="invitation-lobby-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle mdc-elevation--z10">
                        <div class="mdc-layout-grid__inner">
                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                                <h1 id="invitation-lobby-header"></h1>
                                <p id="invitation-lobby-description"></p>
                                <span id="accepted-count-container">
                                    <i id="group-icon" class="material-icons">group</i>

                                </span>
                                <div id="lobby-list-group" class="mdc-list-group">
                                    <ul id="lobby-list" class="mdc-list mdc-list--avatar-list">
                                    </ul>
                                </div>
                            </div>
                            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Snackbar Indicator -->
            <div class="mdc-snackbar" aria-live="assertive" aria-atomic="true" aria-hidden="true">
                <div class="mdc-snackbar__text"></div>
                <div class="mdc-snackbar__action-wrapper">
                    <button type="button" class="mdc-snackbar__action-button"></button>
                </div>
            </div>
            <!-- Floating Action Button - Invite selection -->
            <button id="confirm-reservation-fab" class="mdc-fab material-icons app-fab--absolute mdc-theme--dark" aria-label="Favorite"
                data-mdc-auto-init="MDCRipple">
                <span class="mdc-fab__icon">
                    arrow_forward
                </span>
            </button>
            <!-- Confirmation Dialog -->
            <aside id="confirm-reserve-dialog" class="mdc-dialog mdc-theme--dark" role="alertdialog" aria-labelledby="confirm-reserve-dialog-label"
                aria-describedby="confirm-reserve-dialog-description">
                <div class="mdc-dialog__surface">
                    <header class="mdc-dialog__header">
                        <h2 id="confirm-reserve-dialog-label" class="mdc-dialog__header__title">
                            Select a reservation timing
                        </h2>
                    </header>
                    <section id="confirm-reserve-dialog-list-description" class="mdc-dialog__body mdc-dialog__body--scrollable">
                        <ul class="mdc-list time-selection-list">
                            <li id="00:00:00" class="mdc-list-item time-selection">00:00</li>
                            <li id="01:00:00" class="mdc-list-item time-selection">01:00</li>
                            <li id="02:00:00" class="mdc-list-item time-selection">02:00</li>
                            <li id="03:00:00" class="mdc-list-item time-selection">03:00</li>
                            <li id="04:00:00" class="mdc-list-item time-selection">04:00</li>
                            <li id="05:00:00" class="mdc-list-item time-selection">05:00</li>
                            <li id="06:00:00" class="mdc-list-item time-selection">06:00</li>
                            <li id="07:00:00" class="mdc-list-item time-selection">07:00</li>
                            <li id="08:00:00" class="mdc-list-item time-selection">08:00</li>
                            <li id="09:00:00" class="mdc-list-item time-selection">09:00</li>
                            <li id="10:00:00" class="mdc-list-item time-selection">10:00</li>
                            <li id="11:00:00" class="mdc-list-item time-selection">11:00</li>
                            <li id="12:00:00" class="mdc-list-item time-selection">12:00</li>
                            <li id="13:00:00" class="mdc-list-item time-selection">13:00</li>
                            <li id="14:00:00" class="mdc-list-item time-selection">14:00</li>
                            <li id="15:00:00" class="mdc-list-item time-selection">15:00</li>
                            <li id="16:00:00" class="mdc-list-item time-selection">16:00</li>
                            <li id="17:00:00" class="mdc-list-item time-selection">17:00</li>
                            <li id="18:00:00" class="mdc-list-item time-selection">18:00</li>
                            <li id="19:00:00" class="mdc-list-item time-selection">19:00</li>
                            <li id="20:00:00" class="mdc-list-item time-selection">20:00</li>
                            <li id="21:00:00" class="mdc-list-item time-selection">21:00</li>
                            <li id="22:00:00" class="mdc-list-item time-selection">22:00</li>
                            <li id="23:00:00" class="mdc-list-item time-selection">23:00</li>
                        </ul>
                    </section>
                    <section id="confirm-reserve-dialog-description" class="mdc-dialog__body">
                        Click 'Next' to select a date for your reservation
                    </section>
                    <footer class="mdc-dialog__footer">
                        <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--cancel">Cancel</button>
                        <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--accept">Next</button>
                    </footer>
                </div>
                <div class="mdc-dialog__backdrop"></div>
            </aside>
            <!-- Choose Date Dialog -->
            <aside id="choose-date-dialog" class="mdc-dialog mdc-theme--dark" role="alertdialog" aria-labelledby="choose-date-dialog-label"
                aria-describedby="choose-date-dialog-description">
                <div class="mdc-dialog__surface">
                    <header class="mdc-dialog__header">
                        <h2 id="choose-date-dialog-label" class="mdc-dialog__header__title">
                            Select a reservation date
                        </h2>
                    </header>
                    <section id="choose-date-dialog-list-description" class="mdc-dialog__body mdc-dialog__body--scrollable">
                        <ul id="date-selection-list" class="mdc-list time-selection-list">
                        </ul>
                    </section>
                    <section id="choose-date-dialog-description" class="mdc-dialog__body">
                        Swiftmeal will attempt to reserve the amount of seats required for this group on the chosen date and time.
                    </section>
                    <footer class="mdc-dialog__footer">
                        <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--cancel">Cancel</button>
                        <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--accept">Proceed</button>
                    </footer>
                </div>
                <div class="mdc-dialog__backdrop"></div>
            </aside>
        </main>

        <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
        <script>
            window.mdc.autoInit();
        </script>
        <script src="js/toolbar.js"></script>
        <script src="js/invite-lobby.js"></script>
    </body>

    </html>