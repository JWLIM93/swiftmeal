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
    <link rel="stylesheet" href="css/owner-restaurant-details.css">

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
                <span id="page-name">View Restaurant</span>
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
        <div id="foreground-content" class="mdc-layout-grid mdc-layout-grid--fixed-column-width">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                    <div id="restaurant-info-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                                    <h2 id="restaurant-info-header">Now Viewing ...</h2>
                                    <h1 id="restaurant-info-sub-header">Justin's Grill & Bar</h1>
                                    <h2 id="restaurant-info-description">View your reviews and manage your reservation here.</h2>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--align-middle">
                                    <h1 id="reservations-count-header">28</h1>
                                    <h2 id="reservations-count-sub-header">Reservations</h2>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--align-middle">
                                    <h1 id="likes-count-header">178</h1>
                                    <h2 id="likes-count-sub-header">Likes</h2>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--align-middle">
                                    <h1 id="dislikes-count-header">68</h1>
                                    <h2 id="dislikes-count-sub-header">Dislikes</h2>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle">
                        </div>
                    </div>
                    <div id="reviews-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h1 id="reviews-pre-header">47</h1>
                            <h1 id="reviews-header">Reviews</h1>
                            <div id="reviews-list-group" class="mdc-list-group">
                                <ul id="reviews-list" class="mdc-list mdc-list--two-line msgs-list">
                                    <li role="separator" class="mdc-list-divider"></li>
                                    <li id="reviews-list-item" class="mdc-list-item">
                                        <span class="mdc-list-item__text">
                                            Ali Connors
                                            <span class="mdc-list-item__text__secondary">Lunch this afternoon? I was...</span>
                                        </span>

                                        <span class="mdc-list-item__end-detail">
                                            <time datetime="2014-01-28T04:36:00.000Z">10 June 2017, 4:36 pm</time>
                                        </span>
                                    </li>
                                    <li role="separator" class="mdc-list-divider"></li>
                                    <li id="reviews-list-item" class="mdc-list-item">
                                        <span class="mdc-list-item__text">
                                            Ali Connors
                                            <span class="mdc-list-item__text__secondary">Lunch this afternoon? I was...</span>
                                        </span>

                                        <span class="mdc-list-item__end-detail">
                                            <time datetime="2014-01-28T04:36:00.000Z">10 June 2017, 4:36 pm</time>
                                        </span>
                                    </li>
                                    <li role="separator" class="mdc-list-divider"></li>
                                    <li id="reviews-list-item" class="mdc-list-item">
                                        <span class="mdc-list-item__text">
                                            Ali Connors
                                            <span class="mdc-list-item__text__secondary">Lunch this afternoon? I was...</span>
                                        </span>

                                        <span class="mdc-list-item__end-detail">
                                            <time datetime="2014-01-28T04:36:00.000Z">10 June 2017, 4:36 pm</time>
                                        </span>
                                    </li>
                                    <li role="separator" class="mdc-list-divider"></li>
                                    <li id="reviews-list-item" class="mdc-list-item">
                                        <span class="mdc-list-item__text">
                                            Ali Connors
                                            <span class="mdc-list-item__text__secondary">Lunch this afternoon? I was...</span>
                                        </span>

                                        <span class="mdc-list-item__end-detail">
                                            <time datetime="2014-01-28T04:36:00.000Z">10 June 2017, 4:36 pm</time>
                                        </span>
                                    </li>
                                    <li role="separator" class="mdc-list-divider"></li>
                                    <li id="reviews-list-item" class="mdc-list-item">
                                        <span class="mdc-list-item__text">
                                            Ali Connors
                                            <span class="mdc-list-item__text__secondary">Lunch this afternoon? I was...</span>
                                        </span>

                                        <span class="mdc-list-item__end-detail">
                                            <time datetime="2014-01-28T04:36:00.000Z">10 June 2017, 4:36 pm</time>
                                        </span>
                                    </li>
                                    <li role="separator" class="mdc-list-divider"></li>
                                    <li id="reviews-list-item" class="mdc-list-item">
                                        <span class="mdc-list-item__text">
                                            Ali Connors
                                            <span class="mdc-list-item__text__secondary">Lunch this afternoon? I was...</span>
                                        </span>

                                        <span class="mdc-list-item__end-detail">
                                            <time datetime="2014-01-28T04:36:00.000Z">10 June 2017, 4:36 pm</time>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                    <div id="reservations-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h1 id="reservations-header">Reservations</h1>
                            <div id="reservations-list-group" class="mdc-list-group">
                                <ul id="reservations-list" class="mdc-list mdc-list--two-line msgs-list">
                                    <li role="separator" class="mdc-list-divider"></li>
                                    <li id="reservations-list-item" class="mdc-list-item">
                                        <span class="mdc-list-item__text">
                                            Justin Fong
                                            <span class="mdc-list-item__text__secondary">30 Persons</span>
                                        </span>

                                        <span class="mdc-list-item__end-detail">
                                            <time datetime="2014-01-28T04:36:00.000Z">10 June 2017, 4:36 pm</time>
                                            <span id="fulfil-reject-reservation-container">
                                                <a href="#" id="reject-reservation" class="material-icons" aria-label="Reject Reservation" title="Reject Reservation">
                                                    block
                                                </a>
                                                <span>
                                                    <a href="#" id="fulfil-reservation" class="material-icons" aria-label="Fulfil Reservation" title="Fulfil Reservation">
                                                        check
                                                    </a>
                                                </span>
                                            </span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-top">
                    <i id="delete-restaurant-button" class="material-icons mdc-elevation--z10">delete</i>
                </div>
            </div>
        </div>
        <div id="dialog-underlay" class="mdc-elevation--z14"></div>
    </main>

    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <script>
        window.mdc.autoInit();
    </script>
    <script src="js/map.js"></script>
    <script src="js/toolbar-owner.js"></script>
    <script src="js/owner-restaurant-details.js"></script>
</body>

</html>