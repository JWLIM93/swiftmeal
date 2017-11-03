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

  <!-- LOCAL CSS -->
  <link rel="stylesheet" href="css/register.css">

  <!-- GLOBAL CSS -->
  <link rel="stylesheet" href="css/common.css">
</head>

<body>
  <main class="mdc-theme--dark">
    <div id="map"></div>
    <div id="foreground-content" class="mdc-layout-grid mdc-layout-grid--fixed-column-width">
      <div class="mdc-layout-grid__inner">
        <!-- Left -->
        <div id="title-description" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-8 mdc-layout-grid__cell--align-middle">
          <h1>HUNGRY?</h1>
          <h2>Let us decide for you.</h2>
        </div>
        <!-- Right -->
        <div id="inputs-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--align-middle">
          <!-- Login Title -->
          <div id="login-title" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <h3>Registration</h3>
          </div>
          <!-- Name Text Input -->
          <div id="single-field-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <div class="mdc-form-field">
              <div class="mdc-textfield" data-mdc-auto-init="MDCTextfield">
                <input required maxlength=200 id="name-field" type="text" class="mdc-textfield__input">
                <label for="name-field" class="mdc-textfield__label">Name</label>
              </div>
            </div>
          </div>
          <!-- Name Help Text -->
          <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <p class="mdc-textfield-helptext mdc-textfield-helptext--persistent mdc-textfield-helptext--validation-msg" id="name-validation-msg">
              <em>Alex Tan</em>
            </p>
          </div>
          <!-- Email Address Text Input -->
          <div id="single-field-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <div class="mdc-form-field">
              <div class="mdc-textfield" data-mdc-auto-init="MDCTextfield">
                <input required maxlength=200 id="email-address-field" type="text" class="mdc-textfield__input">
                <label for="email-address-field" class="mdc-textfield__label">Email Address</label>
              </div>
            </div>
          </div>
          <!-- Email Address Help Text -->
          <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <p class="mdc-textfield-helptext mdc-textfield-helptext--persistent mdc-textfield-helptext--validation-msg" id="email-validation-msg">
              <em>abcd@gmail.com</em>
            </p>
          </div>
          <!-- Password Text Input -->
          <div id="single-field-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <div class="mdc-form-field">
              <div class="mdc-textfield" data-mdc-auto-init="MDCTextfield">
                <input required minlength=8 id="password-field" type="password" class="mdc-textfield__input">
                <label for="password-field" class="mdc-textfield__label">Password</label>
              </div>
            </div>
          </div>
          <!-- Password Help Text -->
          <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <p class="mdc-textfield-helptext mdc-textfield-helptext--persistent mdc-textfield-helptext--validation-msg" id="pw-validation-msg">
              <em>8 characters are required for password</em>
            </p>
          </div>
          <!-- Contact Text Input -->
          <div id="single-field-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <div class="mdc-form-field">
              <div class="mdc-textfield" data-mdc-auto-init="MDCTextfield">
                <input required maxlength=200 id="contact-field" type="text" class="mdc-textfield__input">
                <label for="contact-field" class="mdc-textfield__label">Contact No.</label>
              </div>
            </div>
          </div>
          <!-- Contact Help Text -->
          <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <p class="mdc-textfield-helptext mdc-textfield-helptext--persistent mdc-textfield-helptext--validation-msg" id="contact-validation-msg">
              <em>91234567</em>
            </p>
          </div>
          <!-- Role Selection -->
          <div id="role-selector" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <div class="mdc-select" role="listbox" tabindex="0" data-mdc-auto-init="MDCSelect">
              <span class="mdc-select__selected-text">Role</span>
              <div class="mdc-simple-menu mdc-select__menu" data-mdc-auto-init="MDCRipple">
                <ul class="mdc-list mdc-simple-menu__items">
                  <li class="mdc-list-item" role="option" id="selection-header" aria-disabled="true">
                    Select a role
                  </li>
                  <li class="mdc-list-item" role="option" id="customer" tabindex="0">
                    Customer
                  </li>
                  <li class="mdc-list-item" role="option" id="restaurant-owner" tabindex="1">
                    Restaurant Owner
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- Buttons -->
          <div id="buttons-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <a href="index.php" class="mdc-button mdc-button--accent" data-mdc-auto-init="MDCRipple">Back</a>
            <button class="mdc-button mdc-button--raised" data-mdc-auto-init="MDCRipple">Register</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  <script>window.mdc.autoInit();</script>
  <script src="js/map.js"></script>
  <script src="js/register.js"></script>
</body>

</html>