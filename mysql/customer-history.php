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
    <link rel="stylesheet" href="css/customer-history.css">

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
                <span id="page-name">Your History</span>
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
                    <div id="past-recommendations-container" class="mdc-layout-grid__inner mdc-elevation--z10">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h1 id="past-recommendations-header">Past Recommendations</h1>
                            <ul id="past-recommendations-list" class="mdc-list mdc-list--two-line mdc-list--avatar-list">
                                <li class="mdc-list-item">
                                    <img class="mdc-list-item__start-detail grey-bg" src="/src/ic_restaurant_white_24px.svg" width="56" height="56" alt="restaurant">
                                    <span class="mdc-list-item__text">
                                        Justin's Grill & Bar
                                        <span class="mdc-list-item__text__secondary">Visited on 31 December 2017, 3:45PM</span>
                                    </span>
                                    <a href="#" id="add-review-button" class="material-icons mdc-list-item__end-detail" aria-label="Add Review" title="Add Review">mode_comment</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
            </div>
        </div>
        <div id="dialog-underlay" class="mdc-elevation--z14"></div>
        <!-- Add/show reviews dialog -->
        <div id="reviews-dialog" class="mdc-layout-grid mdc-elevation--z16 md-theme--dark">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
                    <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
                            <h1 id="dialog-header">Reviews</h1>
                            <p id="dialog-description">Justin's Grill & Bar</p>
                            <p id="dialog-sub-description">12 Shenton Way, Singapore 456789</p>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--align-middle mdc-layout-grid--align-right">
                            <a id="reviews-dialog-close-button" href="#" class="material-icons" aria-label="Close dialog" title="Close dialog">
                                close
                            </a>
                        </div>
                    </div>
                    <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-8 mdc-layout-grid__cell--align-middle">
                            <div class="mdc-text-field mdc-text-field--textarea">
                                <textarea id="add-review-textarea" class="mdc-text-field__input" rows="4" cols="200"></textarea>
                                <label for="add-review-textarea" class="mdc-text-field__label">Add your review</label>
                            </div>
                            <div class="mdc-layout-grid__inner">
                                <div id="confirm-review-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle mdc-layout-grid--align-right">
                                    <i id="confirm-review-button" class="material-icons mdc-button__icon">check</i>
                                </div>
                            </div>
                        </div>
                        <div id="like-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--align-middle"
                            data-mdc-auto-init="MDCRipple">
                            <i id="recommendation-like" class="material-icons">favorite</i>
                            189
                        </div>
                        <div id="dislike-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--align-middle"
                            data-mdc-auto-init="MDCRipple">
                            <i id="recommendation-dislike" class="material-icons">favorite_border</i>
                            20
                        </div>
                    </div>
                    <!-- Reviews Listing -->
                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
                        <div id="reviews-list-group" class="mdc-list-group">
                            <h3 id="reviews-list-group-subheader" class="mdc-list-group__subheader">Reviews (47)</h3>
                            <ul id="reviews-list" class="mdc-list mdc-list--two-line msgs-list">
                                <li role="separator" class="mdc-list-divider"></li>
                                <li id="reviews-list-item" class="mdc-list-item">
                                    <span class="mdc-list-item__text">
                                        Ali Connors
                                        <span class="mdc-list-item__text__secondary">Lunch this afternoon? I was...</span>
                                    </span>

                                    <span class="mdc-list-item__end-detail">
                                        <time datetime="2014-01-28T04:36:00.000Z">10 June 2017, 4:36 pm</time>
                                        <span id="up-down-vote-container">
                                            <a href="#" id="down-vote" class="material-icons" aria-label="Down Vote Review" title="Down Vote Review">
                                                thumb_down
                                            </a>
                                            <span>
                                                <a href="#" id="up-vote" class="material-icons" aria-label="Up Vote Review" title="Up Vote Review">
                                                    thumb_up
                                                </a>
                                            </span>
                                        </span>
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
                                        <span id="up-down-vote-container">
                                            <a href="#" id="down-vote" class="material-icons" aria-label="Down Vote Review" title="Down Vote Review">
                                                thumb_down
                                            </a>
                                            <span>
                                                <a href="#" id="up-vote" class="material-icons" aria-label="Up Vote Review" title="Up Vote Review">
                                                    thumb_up
                                                </a>
                                            </span>
                                        </span>
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
                                        <span id="up-down-vote-container">
                                            <a href="#" id="down-vote" class="material-icons" aria-label="Down Vote Review" title="Down Vote Review">
                                                thumb_down
                                            </a>
                                            <span>
                                                <a href="#" id="up-vote" class="material-icons" aria-label="Up Vote Review" title="Up Vote Review">
                                                    thumb_up
                                                </a>
                                            </span>
                                        </span>
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
                                        <span id="up-down-vote-container">
                                            <a href="#" id="down-vote" class="material-icons" aria-label="Down Vote Review" title="Down Vote Review">
                                                thumb_down
                                            </a>
                                            <span>
                                                <a href="#" id="up-vote" class="material-icons" aria-label="Up Vote Review" title="Up Vote Review">
                                                    thumb_up
                                                </a>
                                            </span>
                                        </span>
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
                                        <span id="up-down-vote-container">
                                            <a href="#" id="down-vote" class="material-icons" aria-label="Down Vote Review" title="Down Vote Review">
                                                thumb_down
                                            </a>
                                            <span>
                                                <a href="#" id="up-vote" class="material-icons" aria-label="Up Vote Review" title="Up Vote Review">
                                                    thumb_up
                                                </a>
                                            </span>
                                        </span>
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
                                        <span id="up-down-vote-container">
                                            <a href="#" id="down-vote" class="material-icons" aria-label="Down Vote Review" title="Down Vote Review">
                                                thumb_down
                                            </a>
                                            <span>
                                                <a href="#" id="up-vote" class="material-icons" aria-label="Up Vote Review" title="Up Vote Review">
                                                    thumb_up
                                                </a>
                                            </span>
                                        </span>
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
                                        <span id="up-down-vote-container">
                                            <a href="#" id="down-vote" class="material-icons" aria-label="Down Vote Review" title="Down Vote Review">
                                                thumb_down
                                            </a>
                                            <span>
                                                <a href="#" id="up-vote" class="material-icons" aria-label="Up Vote Review" title="Up Vote Review">
                                                    thumb_up
                                                </a>
                                            </span>
                                        </span>
                                    </span>
                                </li>
                            </ul>
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
    <script src="js/customer-history.js"></script>
</body>

</html>