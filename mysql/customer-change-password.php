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
  <link rel="stylesheet" href="css/customer-change-password.css">

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
                <!-- Current Password Input -->
                <div id="input-fields-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
                  <div id="current-password-input" class=" mdc-text-field mdc-text-field--box" data-mdc-auto-init="MDCTextField">
                    <input type="password" id="current-password-input-box" class=" mdc-text-field__input">
                    <label for="current-password-input-box" class=" mdc-text-field__label">Current Password</label>
                    <div class=" mdc-text-field__bottom-line"></div>
                  </div>
                </div>
                <!-- New Password Input -->
                <div id="input-fields-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
                  <div id="new-password-input" class=" mdc-text-field mdc-text-field--box" data-mdc-auto-init="MDCTextField">
                    <input type="password" id="new-password-input-box" class=" mdc-text-field__input">
                    <label for="name-input-box" class=" mdc-text-field__label">New Password</label>
                    <div class=" mdc-text-field__bottom-line"></div>
                  </div>
                </div>
                <!-- Confirm New Password Input -->
                <div id="input-fields-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--align-middle">
                  <div id="confirm-new-password-input" class=" mdc-text-field mdc-text-field--box" data-mdc-auto-init="MDCTextField">
                    <input type="text " id="confirm-new-password-box" class=" mdc-text-field__input">
                    <label for="confirm-new-password-input-box" class=" mdc-text-field__label ">Confirm New Password</label>
                    <div class=" mdc-text-field__bottom-line">
                    </div>
                  </div>
                </div>
                <!-- Floating Actiobn Button to submit request -->
                <button id="update-password-fab" class="mdc-fab material-icons app-fab--absolute mdc-elevation--z13" aria-label="Check" data-mdc-auto-init="MDCRipple">
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
      <aside id="update-failure-dialog" class="mdc-dialog" role="alertdialog" aria-labelledby="update-failure-dialog-label" aria-describedby="update-failure-dialog-description">
        <div class="mdc-dialog__surface">
          <header class="mdc-dialog__header">
            <h2 id="update-failure-dialog-label" class="mdc-dialog__header__title">
              Password update failed
            </h2>
          </header>
          <section id="update-failure-dialog-description" class="mdc-dialog__body">
            We are unable to update your password. Please check if you have entered your current password correctly and your new password
            twice.
          </section>
          <footer class="mdc-dialog__footer">
            <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--cancel">Back to home</button>
            <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--accept mdc-dialog__action">Try again</button>
          </footer>
        </div>
        <div class="mdc-dialog__backdrop "></div>
      </aside>
  </main>

  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js "></script>
  <script>
    window.mdc.autoInit();
  </script>
  <script src="js/toolbar.js"></script>
  <script src="js/customer-change-password.js "></script>
</body>

</html>