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
    <link rel="stylesheet" href="css/recommendation-invite.css">

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
                <span id="page-name">Invite</span>
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
        <div id="foreground-content" class="mdc-layout-grid mdc-layout-grid--fixed-column-width">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle">
                </div>
                <div id="friends-invite-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle mdc-elevation--z10">
                    <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h1 id="friends-invite-header">Select Friends</h1>
                            <p id="friends-invite-description">You can only invite friends that are currently online.</p>
                            <!-- If no/1 friend use singular "friend", else use plural "friends" -->
                            <div id="selection-count-header">No friend selected</div>
                            <div id="friends-list-container" class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                                    <div class="mdc-form-field">
                                        <div class="mdc-checkbox">
                                            <input type="checkbox" id="friend-1-checkbox" class="mdc-checkbox__native-control" />
                                            <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark__path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                            </div>
                                        </div>

                                        <label for="friend-1-checkbox">justin fong</label>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                                    <div class="mdc-form-field">
                                        <div class="mdc-checkbox">
                                            <input type="checkbox" id="friend-2-checkbox" class="mdc-checkbox__native-control" />
                                            <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark__path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                            </div>
                                        </div>

                                        <label for="friend-2-checkbox">lim jun wei</label>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                                    <div class="mdc-form-field">
                                        <div class="mdc-checkbox">
                                            <input type="checkbox" id="friend-3-checkbox" class="mdc-checkbox__native-control" />
                                            <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark__path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                            </div>
                                        </div>

                                        <label for="friend-3-checkbox">Ng Cai Feng</label>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                                    <div class="mdc-form-field">
                                        <div class="mdc-checkbox">
                                            <input type="checkbox" id="friend-1-checkbox" class="mdc-checkbox__native-control" />
                                            <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark__path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                            </div>
                                        </div>

                                        <label for="friend-1-checkbox">Justin Fong</label>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                                    <div class="mdc-form-field">
                                        <div class="mdc-checkbox">
                                            <input type="checkbox" id="friend-2-checkbox" class="mdc-checkbox__native-control" />
                                            <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark__path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                            </div>
                                        </div>

                                        <label for="friend-2-checkbox">Lim Jun Wei</label>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                                    <div class="mdc-form-field">
                                        <div class="mdc-checkbox">
                                            <input type="checkbox" id="friend-3-checkbox" class="mdc-checkbox__native-control" />
                                            <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark__path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                            </div>
                                        </div>

                                        <label for="friend-3-checkbox">Ng Cai Feng</label>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                                    <div class="mdc-form-field">
                                        <div class="mdc-checkbox">
                                            <input type="checkbox" id="friend-1-checkbox" class="mdc-checkbox__native-control" />
                                            <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark__path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                            </div>
                                        </div>

                                        <label for="friend-1-checkbox">Justin Fong</label>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                                    <div class="mdc-form-field">
                                        <div class="mdc-checkbox">
                                            <input type="checkbox" id="friend-2-checkbox" class="mdc-checkbox__native-control" />
                                            <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark__path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                            </div>
                                        </div>

                                        <label for="friend-2-checkbox">Lim Jun Wei</label>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                                    <div class="mdc-form-field">
                                        <div class="mdc-checkbox">
                                            <input type="checkbox" id="friend-3-checkbox" class="mdc-checkbox__native-control" />
                                            <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark__path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                            </div>
                                        </div>

                                        <label for="friend-3-checkbox">Ng Cai Feng</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Floating Action Button - Invite selection -->
        <button id="to-lobby-fab" class="mdc-fab material-icons app-fab--absolute" aria-label="Favorite" data-mdc-auto-init="MDCRipple">
            <span class="mdc-fab__icon">
                arrow_forward
            </span>
        </button>
    </main>

    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script>
        window.mdc.autoInit();
    </script>
    <script src="js/toolbar.js"></script>
    <script src="js/recommendation-invite.js"></script>
</body>

</html>