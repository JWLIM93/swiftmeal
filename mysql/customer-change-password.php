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
-
  <!-- LOCAL CSS -->
  <link rel="stylesheet" href="css/customer-change-password.css">

  <!-- GLOBAL CSS -->
  <link rel="stylesheet" href="css/common.css">
</head>

<body>
  <header class="mdc-toolbar mdc-toolbar--fixed mdc-toolbar--waterfall mdc-theme--dark">
    <div class="mdc-toolbar__row">
      <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
        <span id="product-name" class="mdc-toolbar__title">SWIFTMEAL</span>
        <span id="page-name">Change Password</span>
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
        <div id="change-password-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle mdc-elevation--z10">
          <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
              <h1 id="change-password-header">Update your password</h1>
              <p id="change-password-description">Change your password regularly to prevent unauthorised access to your account.</p>
              <div id="input-fields-super-container" class="mdc-layout-grid__inner">
                <!-- Name Input -->
                <div id="input-fields-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
                  <div id="name-input" class="mdc-textfield mdc-textfield--box" data-mdc-auto-init="MDCTextfield">
                    <input type="text" id="name-input-box" class="mdc-textfield__input">
                    <label for="name-input-box" class="mdc-textfield__label">Password</label>
                    <div class="mdc-textfield__bottom-line"></div>
                  </div>
                </div>
              </div>
              <button class="mdc-fab material-icons app-fab--absolute mdc-elevation--z13" aria-label="Check" data-mdc-auto-init="MDCRipple">
                <span class="mdc-fab__icon">
                  check
                </span>
              </button>
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
          </div>
        </div>
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
      </div>
    </div>
  </main>

  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  <script>window.mdc.autoInit();</script>
  <script src="js/customer-change-password.js"></script>
</body>

</html>