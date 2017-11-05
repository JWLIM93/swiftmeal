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
  <link rel="stylesheet" href="css/customer-home.css">

  <!-- GLOBAL CSS -->
  <link rel="stylesheet" href="css/common.css">
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
    <div id="map"></div>
    <div id="foreground-content" class="mdc-layout-grid mdc-layout-grid--fixed-column-width">
      <div id="area-selection-content" class="mdc-layout-grid__inner">
        <div id="recommendations-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-top">
          <div id="recommendations-header" class="mdc-elevation--z10">
            <h3 id="welcome">Welcome, Justin!</h3>
            <h3 id="welcome-sub-heading">Start your food exploration here ...</h3>
          </div>
          <div id="recommendations" class="mdc-layout-grid__inner">
            <!-- Area Selection -->
            <div id="area-selector" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
              <select class="mdc-select" data-mdc-auto-init="MDCRipple">
                <option value="" selected>Select an area</option>
                <optgroup label="Areas">
                  <option value="shenton-way">Shenton Way</option>
                  <option value="raffles-place">Raffles Place</option>
                  <option value="outram-park">Outram Park</option>
                  <option value="bedok">Bedok</option>
                </optgroup>
              </select>
            </div>
            <!-- Toggle Button -->
            <div id="trending-recommendations" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--align-middle">
              <i class="mdc-icon-toggle material-icons" role="button" aria-pressed="false" aria-label="Recommend trending places" tabindex="0"
                data-mdc-auto-init="MDCIconToggle" data-toggle-on='{"label": "Trending recommendations enabled", "content": "trending_up", "cssClass": "activated-accent"}'
                data-toggle-off='{"label": "Trending recommendations disabled", "content": "trending_up"}'>
                trending_up
              </i>
            </div>
          </div>
          <div id="recommended-list" class="mdc-elevation--z10">
            <!-- List of recommendations (5) -->
            <ul class="mdc-list mdc-list--two-line">
              <li id="recommended-place-1" class="mdc-list-item" data-mdc-auto-init="MDCRipple">
                <i class="mdc-list-item__start-detail material-icons" aria-hidden="true">restaurant</i>
                <span class="mdc-list-item__text">
                  Swensen's fvfgfgfgfgfg grhghg g gb sfd fgs fg fg dfgf g
                  <span class="mdc-list-item__text__secondary">16 Shenton Way, Singapore 123445 bgbgf gf gf h h fg fg g g dgr g ggr</span>
                </span>
              </li>
              <li id="recommended-place-2" class="mdc-list-item" data-mdc-auto-init="MDCRipple">
                <i class="mdc-list-item__start-detail material-icons" aria-hidden="true">restaurant</i>
                <span class="mdc-list-item__text">
                  Justin's Grill & Bar
                  <span class="mdc-list-item__text__secondary">18 Shenton Way, Singapore 126667</span>
                </span>
              </li>
              <li id="recommended-place-3" class="mdc-list-item" data-mdc-auto-init="MDCRipple">
                <i class="mdc-list-item__start-detail material-icons" aria-hidden="true">restaurant</i>
                <span class="mdc-list-item__text">
                  Swensen's
                  <span class="mdc-list-item__text__secondary">16 Shenton Way, Singapore 123445</span>
                </span>
              </li>
              <li id="recommended-place-4" class="mdc-list-item" data-mdc-auto-init="MDCRipple">
                <i class="mdc-list-item__start-detail material-icons" aria-hidden="true">restaurant</i>
                <span class="mdc-list-item__text">
                  Justin's Grill & Bar
                  <span class="mdc-list-item__text__secondary">18 Shenton Way, Singapore 126667</span>
                </span>
              </li>
              <li id="recommended-place-5" class="mdc-list-item" data-mdc-auto-init="MDCRipple">
                <i class="mdc-list-item__start-detail material-icons" aria-hidden="true">restaurant</i>
                <span class="mdc-list-item__text">
                  Justin's Grill & Bar
                  <span class="mdc-list-item__text__secondary">18 Shenton Way, Singapore 126667</span>
                </span>
              </li>
            </ul>
          </div>
          <div id="recommendations-footer" class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-8 mdc-layout-grid__cell--align-middle mdc-layout-grid--align-left">
              <button id="active-friends" class="mdc-button mdc-button--accent" data-mdc-auto-init="MDCRipple">
                No Online Friends
              </button>
            </div>
            <div id="request-recommendations" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3 mdc-layout-grid__cell--align-middle mdc-layout-grid--align-right">
              <button class="mdc-button mdc-button--raised">
                Recommend
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="dialog-underlay" class="mdc-elevation--z14"></div>
    <!-- Popup dialog -->
    <div id="active-friends-dialog" class="mdc-layout-grid mdc-elevation--z16 md-theme--dark">
      <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
          <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-11 mdc-layout-grid__cell--align-middle">
              <h1 id="dialog-header">No Online Friends</h1>
              <p id="dialog-description">List of friends that are currently online.</p>
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle mdc-layout-grid--align-right">
              <a id="dialog-close-button" href="#" class="material-icons" aria-label="Close dialog" title="Close dialog">
                close
              </a>
            </div>
          </div>
        </div>
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
          <div id="active-friends-grid-list" class="mdc-grid-list mdc-grid-list--twoline-caption">
            <ul class="mdc-grid-list__tiles">
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
      </div>
    </div>
    <!-- Single recommendation focus and reviews dialog -->
    <div id="recommendation-focus-dialog" class="mdc-layout-grid mdc-elevation--z16 md-theme--dark">
      <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
          <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
              <h1 id="dialog-header">Justin's Grill & Bar</h1>
              <p id="dialog-description">18 Shenton Way, Singapore 126667</p>
              <span id="likes-dislikes-container">
                <i id="recommendation-like" class="material-icons">favorite</i>
                189
                <i id="recommendation-dislike" class="material-icons">favorite_border</i>
                20
              </span>
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--align-middle mdc-layout-grid--align-right">
              <a id="recommendation-focus-dialog-close-button" href="#" class="material-icons" aria-label="Close dialog" title="Close dialog">
                close
              </a>
              <a id="recommendation-focus-dialog-proceed-button" href="#" class="material-icons" aria-label="Select and proceed with recommendation"
                title="Select and proceed with recommendation">
                arrow_forward
              </a>
            </div>
          </div>
        </div>
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
          <!-- Reviews section -->
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
    <!-- Invite dialog -->
    <aside id="invite-dialog" class="mdc-dialog" role="invite-dialog" aria-labelledby="invite-dialog-label" aria-describedby="invite-dialog-description">
      <div class="mdc-dialog__surface">
        <header class="mdc-dialog__header">
          <h2 id="invite-dialog-label" class="mdc-dialog__header__title">
            Invite friends for this recommendation?
          </h2>
        </header>
        <section id="invite-dialog-description" class="mdc-dialog__body">
          You can invite friends that are online to join you for this selected recommendation, alternatively you can proceed without
          any invitations.
        </section>
        <footer class="mdc-dialog__footer">
          <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--cancel">No, proceed</button>
          <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--accept">Yes, invite friends</button>
        </footer>
      </div>
      <div class="mdc-dialog__backdrop"></div>
    </aside>
  </main>

  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  <script>
    window.mdc.autoInit();
  </script>
  <script src="js/map.js"></script>
  <script src="/library/ellipsis.min.js"></script>
  <script src="js/customer-home.js"></script>
</body>

</html>