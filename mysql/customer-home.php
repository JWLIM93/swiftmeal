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
  <link rel="stylesheet" href="css/customer-home.css">

  <!-- GLOBAL CSS -->
  <link rel="stylesheet" href="css/common.css">

  <!-- JQUERY -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- AHEAD JAVASCRIPT -->
  <script src="js/friends-display.js"></script>
  <script src="js/customer-review.js"></script>
  
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
    <div id="map"></div>
    <div id="foreground-content" class="mdc-layout-grid mdc-layout-grid--fixed-column-width">
      <div id="area-selection-content" class="mdc-layout-grid__inner">
        <div id="recommendations-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-top">
          <div id="recommendations-header" class="mdc-elevation--z10">
            <h3 id="welcome">Welcome, <?php echo $customer->getFullName()?>!</h3>
            <h3 id="welcome-sub-heading">Start your food exploration here ...</h3>
          </div>
          <div id="recommendations" class="mdc-layout-grid__inner">
            <!-- Area Selection -->
            <div id="area-selector" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
            <?php require_once 'scripts/area-generator.php';?>
            </div>
            <!-- Toggle Button -->
            <div id="trending-recommendations" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2 mdc-layout-grid__cell--align-middle">
              <i id="trending-button" class="mdc-icon-toggle material-icons" role="button" aria-pressed="false" aria-label="Recommend trending places" tabindex="0"
                data-mdc-auto-init="MDCIconToggle" data-toggle-on='{"label": "Trending recommendations enabled", "content": "trending_up", "cssClass": "activated-accent"}'
                data-toggle-off='{"label": "Trending recommendations disabled", "content": "trending_up"}'>
                trending_up
              </i>
            </div>
          </div>
          <div id="recommended-list" class="mdc-elevation--z10">
            <!-- List of recommendations (5) -->
            <ul id="restaurant" class="mdc-list mdc-list--two-line">
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
            <ul id="active-friends-list" class="mdc-grid-list__tiles">
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
              <h1 id="reviews-dialog-header">Justin's Grill & Bar</h1>
              <p id="reviews-dialog-description">18 Shenton Way, Singapore 126667</p>
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
            <h3 id="reviews-list-group-subheader" class="mdc-list-group__subheader"></h3>
            <ul id="reviews-list" class="mdc-list mdc-list--two-line msgs-list">
              
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
  <script src="js/toolbar.js"></script>
  <script src="/library/ellipsis.min.js"></script>
  <script src="js/customer-home.js"></script>
</body>

</html>