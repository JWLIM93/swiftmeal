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
        <div id="loading-progress" role="progressbar" class="mdc-linear-progress mdc-linear-progress--indeterminate mdc-linear-progress--accent">
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
                                <li class="mdc-list-item">
                                    <img class="mdc-list-item__start-detail grey-bg" src="/src/ic_person_white_24px.svg" width="56" height="56" alt="avatar">
                                    <span class="mdc-list-item__text">
                                        Lim Jun Wei
                                        <span class="mdc-list-item__text__secondary">Added you on 12/06/2017</span>
                                    </span>
                                    <span id="request-span" class="mdc-list-item__end-detail">
                                        <a href="#" class="material-icons" aria-label="Accept request" title="Accept request">
                                            check
                                        </a>
                                        <span>
                                            <a href="#" class="material-icons" aria-label="Decline request" title="Decline request">
                                                close
                                            </a>
                                        </span>
                                    </span>
                                </li>
                                <li class="mdc-list-item">
                                    <img class="mdc-list-item__start-detail grey-bg" src="/src/ic_person_white_24px.svg" width="56" height="56" alt="avatar">
                                    <span class="mdc-list-item__text">
                                        Lee Kok Leong
                                        <span class="mdc-list-item__text__secondary">Added you on 09/06/2017</span>
                                    </span>
                                    <span id="request-span" class="mdc-list-item__end-detail">
                                        <a href="#" class="material-icons" aria-label="Accept request" title="Accept request">
                                            check
                                        </a>
                                        <span>
                                            <a href="#" class="material-icons" aria-label="Decline request" title="Decline request">
                                                close
                                            </a>
                                        </span>
                                    </span>
                                </li>
                                <li class="mdc-list-item">
                                    <img class="mdc-list-item__start-detail grey-bg" src="/src/ic_person_white_24px.svg" width="56" height="56" alt="avatar">
                                    <span class="mdc-list-item__text">
                                        Ng Cai Feng
                                        <span class="mdc-list-item__text__secondary">Added you on 04/06/2017</span>
                                    </span>
                                    <span id="request-span" class="mdc-list-item__end-detail">
                                        <a href="#" class="material-icons" aria-label="Accept request" title="Accept request">
                                            check
                                        </a>
                                        <span>
                                            <a href="#" class="material-icons" aria-label="Decline request" title="Decline request">
                                                close
                                            </a>
                                        </span>
                                    </span>
                                </li>
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
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Jeremy Lim</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Lim Bun Wei</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Lim Bun Wei</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Lim Bun Wei</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Lim Bun Wei</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Lim Bun Wei</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Lim Bun Wei</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Lim Bun Wei</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Lim Bun Wei</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Lim Bun Wei</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Lim Bun Wei</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
                                    <li class="mdc-grid-tile">
                                        <div class="mdc-grid-tile__primary">
                                            <img class="mdc-grid-tile__primary-content" src="/src/ic_person_white_24px.svg" />
                                        </div>
                                        <span class="mdc-grid-tile__secondary">
                                            <span class="mdc-grid-tile__title">Lim Bun Wei</span>
                                            <span class="mdc-grid-tile__support-text">Since 29/12/2016</span>
                                        </span>
                                    </li>
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
                    <div id="email-address-input" class="mdc-textfield mdc-textfield--box" data-mdc-auto-init="MDCTextfield">
                        <input type="text" id="tf-box" class="mdc-textfield__input">
                        <label for="tf-box" class="mdc-textfield__label">Friend's Email Address</label>
                        <div class="mdc-textfield__bottom-line"></div>
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
    <script>window.mdc.autoInit();</script>
    <script src="js/customer-friends.js"></script>
</body>

</html>