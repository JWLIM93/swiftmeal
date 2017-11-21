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
  <link rel="stylesheet" href="css/owner-edit-profile.css">

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
        <span id="page-name">Edit Profile</span>
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
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle">
        </div>
        <div id="edit-profile-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle mdc-elevation--z10">
          <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-middle"></div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-10 mdc-layout-grid__cell--align-middle">
              <h1 id="edit-profile-header">
                name
              </h1>
              <p id="edit-profile-divider">Personal Information</p>
              <form action="scripts/post-requests.php" name="editProfile" method="post" onsubmit="return submitEdit()">
                <p id="edit-profile-description">Customise your personal information to allow the community to easily recognise you.</p>
                <div id="input-fields-super-container" class="mdc-layout-grid__inner">
                  <!-- Name Input -->
                  <div id="input-fields-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                    <div id="name-input" class="mdc-text-field mdc-text-field--box" data-mdc-auto-init="MDCTextField">
                      <input type="text" id="name-input-box" class="mdc-text-field__input" name="FullName">
                      <label for="name-input-box" class="mdc-text-field__label">Name</label>
                      <div class="mdc-text-field__bottom-line"></div>
                    </div>
                    <!-- Name Input Helptext -->
                    <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                      <p class="mdc-text-field-helptext mdc-text-field-helptext--persistent mdc-text-field-helptext--validation-msg" id="name-validation-msg">
                        name
                      </p>
                    </div>
                  </div>
                  <!-- Email Address Input -->
                  <div id="input-fields-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                    <div id="email-address-input" class="mdc-text-field mdc-text-field--box" data-mdc-auto-init="MDCTextField">
                      <input type="text" id="email-address-input-box" class="mdc-text-field__input" name="Email">
                      <label for="email-address-input-box" class="mdc-text-field__label">Email Address</label>
                      <div class="mdc-text-field__bottom-line"></div>
                    </div>
                    <!-- Email Address Input Helptext -->
                    <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                      <p class="mdc-text-field-helptext mdc-text-field-helptext--persistent mdc-text-field-helptext--validation-msg" id="email-address-validation-msg">
                        email
                      </p>
                    </div>
                  </div>
                  <!-- Mobile Input -->
                  <div id="input-fields-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle">
                    <div id="mobile-input" class="mdc-text-field mdc-text-field--box" data-mdc-auto-init="MDCTextField">
                      <input type="text" id="mobile-input-box" class="mdc-text-field__input" name="Phone_number">
                      <label for="mobile-input-box" class="mdc-text-field__label">Mobile Number</label>
                      <div class="mdc-text-field__bottom-line"></div>
                    </div>
                    <!-- Mobile Input Helptext -->
                    <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                      <p class="mdc-text-field-helptext mdc-text-field-helptext--persistent mdc-text-field-helptext--validation-msg" id="mobile-validation-msg">
                        number
                      </p>
                    </div>
                  </div>
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--align-middle"></div>
                </div>
                <button class="mdc-fab material-icons app-fab--absolute mdc-elevation--z13" aria-label="Check" data-mdc-auto-init="MDCRipple"
                  name="edit">
                  <span class="mdc-fab__icon">
                    check
                  </span>
                </button>
              </form>
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
              Profile update failed
            </h2>
          </header>
          <section id="update-failure-dialog-description" class="mdc-dialog__body">
            We are unable to update your profile. Please ensure that your fields are valid and check your internet connection.
          </section>
          <footer class="mdc-dialog__footer">
            <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--cancel">Back to home</button>
            <button type="button" class="mdc-button mdc-dialog__footer__button mdc-dialog__footer__button--accept mdc-dialog__action">Try again</button>
          </footer>
        </div>
        <div class="mdc-dialog__backdrop"></div>
      </aside>
  </main>

  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  <script>
    window.mdc.autoInit();
  </script>
  <script src="js/toolbar-owner.js"></script>
  <script src="js/owner-edit-profile.js"></script>
</body>

</html>