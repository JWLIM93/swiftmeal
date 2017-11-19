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

  <!-- AHEAD JAVASCRIPT -->
  <script src="js/friends-display.js"></script>
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
          <form name="registerationForm" action="scripts/post-requests.php" method="post" id="Register" onsubmit="return submitRegister()">
            <div id="single-field-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <div class="mdc-form-field">
                <div class="mdc-text-field" data-mdc-auto-init="MDCTextField">
                  <input required maxlength=200 name="usersName" id="name-field" type="text" class="mdc-text-field__input">
                  <label for="name-field" class="mdc-text-field__label ">Name</label>
                </div>
              </div>
            </div>
            <!-- Name Help Text -->
            <div id="single-field-helptext " class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <p class="mdc-text-field-helptext mdc-text-field-helptext--persistent mdc-text-field-helptext--validation-msg" id="name-validation-msg">
                <em id="name_error_msg">Alex Tan</em>
              </p>
            </div>
            <!-- Email Address Text Input -->
            <div id="single-field-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <div class="mdc-form-field">
                <div class="mdc-text-field" data-mdc-auto-init="MDCTextField">
                  <input required maxlength=200 name="userEmail" id="email-address-field" type="text" class="mdc-text-field__input">
                  <label for="email-address-field" class="mdc-text-field__label">Email Address</label>
                </div>
              </div>
            </div>
            <!-- Email Address Help Text -->
            <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <p class="mdc-text-field-helptext mdc-text-field-helptext--persistent mdc-text-field-helptext--validation-msg" id="email-validation-msg ">
                <em id="email_error_msg ">abcd@gmail.com</em>
              </p>
            </div>
            <!-- Password Text Input -->
            <div id="single-field-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <div class="mdc-form-field">
                <div class="mdc-text-field" data-mdc-auto-init="MDCTextField">
                  <input required minlength=8 name="userPassword" id="password-field" type="password" class="mdc-text-field__input">
                  <label for="password-field" class="mdc-text-field__label">Password</label>
                </div>
              </div>
            </div>
            <!-- Password Help Text -->
            <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <p class="mdc-text-field-helptext mdc-text-field-helptext--persistent mdc-text-field-helptext--validation-msg" id="pw-validation-msg">
                <em id="password_error_msg">8 characters are required for password</em>
              </p>
            </div>
            <!-- Password Text Input -->
            <div id="single-field-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <div class="mdc-form-field">
                <div class="mdc-text-field " data-mdc-auto-init="MDCTextField">
                  <input required minlength=8 name="retypePassword" id="password-field" type="password" class="mdc-text-field__input">
                  <label for="password-field" class="mdc-text-field__label">Confirm Password</label>
                </div>
              </div>
            </div>
            <!-- Password Help Text -->
            <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <p class="mdc-text-field-helptext mdc-text-field-helptext--persistent mdc-text-field-helptext--validation-msg" id="pw-validation-msg">
                <em id="confirm_password_error_msg">8 characters are required for password</em>
              </p>
            </div>
            <!-- Contact Text Input -->
            <div id="single-field-container " class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <div class="mdc-form-field ">
                <div class="mdc-text-field " data-mdc-auto-init="MDCTextField">
                  <input required maxlength=200 name="userPhone" id="contact-field" type="text" class="mdc-text-field__input ">
                  <label for="contact-field" class="mdc-text-field__label ">Contact No.</label>
                </div>
              </div>
            </div>
            <!-- Contact Help Text -->
            <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <p class="mdc-text-field-helptext mdc-text-field-helptext--persistent mdc-text-field-helptext--validation-msg" id="contact-validation-msg">
                <em id="phone_error_msg ">91234567</em>
              </p>
            </div>
            <!-- Role Selection -->
            <div id="role-selector" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <select class="mdc-select" name="typeOfUser">
                <option id="selection-header" value="" selected>Select a Role</option>
                <option id="customer" value="Customer">Customer</option>
                <option id="restaurant-owner" value="Restaurant Owner">Restaurant Owner</option>
              </select>
            </div>
            <!-- Buttons -->
            <div id="buttons-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <a href="index.php" class="mdc-button mdc-button--accent" data-mdc-auto-init="MDCRipple">Back</a>
              <button name="register" class="mdc-button mdc-button--raised" data-mdc-auto-init="MDCRipple">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  <script>
    window.mdc.autoInit();
  </script>
  <script src="js/map.js"></script>
  <script src="js/register.js"></script>
</body>

</html>