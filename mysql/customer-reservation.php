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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -
    <!-- LOCAL CSS -->
    <link rel="stylesheet" href="css/customer-reservation.css">

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
                <span id="page-name">New Reservation</span>
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
        <div id="foreground-content" class="mdc-layout-grid mdc-layout-grid--fixed-column-width">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--align-middle">
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--align-middle">
                    <div id="select-pax-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h1 id="select-pax-header">Select seats required</h1>
                            <p id="select-pax-description">Seats are subject to availability and up to a maximum of 10 persons.</p>
                            <div class="mdc-layout-grid__inner">
                                <div id="up-pax-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-5 mdc-layout-grid__cell--align-middle">
                                    <i id="up-pax" class="material-icons">keyboard_arrow_up</i>
                                </div>
                                <div id="number-of-pax-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--align-middle">

                                </div>
                                <div id="down-pax-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-5 mdc-layout-grid__cell--align-middle">
                                    <i id="down-pax" class="material-icons">keyboard_arrow_down</i>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                    <div id="select-date-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h1 id="select-date-header">Choose a reservation date</h1>
                            <p id="select-date-description">You can reserve up to 7 days in advance.</p>
                            <ul id="select-date-list" class="mdc-list">
                            </ul>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                    <div id="select-time-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h1 id="select-time-header">Choose a reservation time</h1>
                            <p id="select-time-description">Please arrive 10 minutes before the reservation time.</p>
                            <ul id="select-time-list" class="mdc-list">
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
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Floating Action Button - Invite selection -->
        <button id="to-directions-fab" class="mdc-fab material-icons app-fab--absolute" aria-label="Favorite" data-mdc-auto-init="MDCRipple">
            <span class="mdc-fab__icon">
                arrow_forward
            </span>
        </button>
        <!-- Confirmation dialog -->
        <aside id="confirm-dialog" class="mdc-dialog" role="invite-dialog" aria-labelledby="invite-dialog-label" aria-describedby="invite-dialog-description">
            <div class="mdc-dialog__surface">
                <header class="mdc-dialog__header">
                    <h2 id="confirm-dialog-label" class="mdc-dialog__header__title">
                        Confirm your reservation?
                    </h2>
                </header>
                <section id="confirm-dialog-description" class="mdc-dialog__body">
                    Swiftmeal will process your reservation on your behalf.
                </section>
                <footer class="mdc-dialog__footer">
                    <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--cancel">Cancel</button>
                    <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--accept">Proceed</button>
                </footer>
            </div>
            <div class="mdc-dialog__backdrop"></div>
        </aside>
    </main>

    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js "></script>

    <script>
        window.mdc.autoInit();
    </script>
    <script src="js/toolbar.js"></script>
    <script src="js/customer-reservation.js"></script>
</body>

</html>