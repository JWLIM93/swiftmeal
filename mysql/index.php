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
  <link rel="stylesheet" href="css/index.css">

  <!-- GLOBAL CSS -->
  <link rel="stylesheet" href="css/common.css">

  <!-- AHEAD JAVASCRIPT -->
</head>

<body>
  <main class="mdc-theme--dark">
    <div id="map"></div>
    <div id="foreground-content" class="mdc-layout-grid mdc-layout-grid--fixed-column-width">
      <div class="mdc-layout-grid__inner">
        <!-- Left -->
        <div id="title-description" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-8 mdc-layout-grid__cell--align-middle">
          <h1>SWIFTMEAL</h1>
          <h2>Your next meal, simplified.</h2>
        </div>
        <!-- Right -->
        <div id="inputs-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--align-middle">
          <!-- Login Title -->
          <div id="login-title" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
            <h3>Authenticate</h3>
          </div>
          <!-- Email Address Text Input -->
          <form name="registerForm" onsubmit="return submitLogin()" action="scripts/post-requests.php" method="post">
            <div id="single-field-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <div class="mdc-form-field">
                <div class=" mdc-text-field" data-mdc-auto-init="MDCTextField">
                  <input required maxlength=200 name="userEmail" id="email-address-field" type="text" class=" mdc-text-field__input ">
                  <label for="email-address-field " class=" mdc-text-field__label">Email Address</label>
                </div>
              </div>
            </div>
            <!-- Email Address Help Text -->
            <div id="single-field-helptext" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <p class=" mdc-text-field-helptext mdc-text-field-helptext--persistent mdc-text-field-helptext--validation-msg" id="email-validation-msg">
                <em id="email_error_message">abcd@gmail.com</em>
              </p>
            </div>
            <!-- Password Text Input -->
            <div id="single-field-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <div class="mdc-form-field">
                <div class=" mdc-text-field" data-mdc-auto-init="MDCTextField">
                  <input required minlength=8 name='userPassword' id="password-field " type="password" class=" mdc-text-field__input">
                  <label for="password-field" class=" mdc-text-field__label">Password</label>
                </div>
              </div>
            </div>
            <!-- Password Help Text -->
            <div id="single-field-helptext " class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <p class=" mdc-text-field-helptext mdc-text-field-helptext--persistent mdc-text-field-helptext--validation-msg" id="pw-validation-msg">
                <em id='password_error_msg'>Minimum 8 characters are required for password</em>
              </p>
            </div>
            <!-- Buttons -->
            <div id="buttons-container" class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
              <a href="register.php" class="mdc-button mdc-button--accent" data-mdc-auto-init="MDCRipple">Register</a>
              <button name="login" class="mdc-button mdc-button--raised" data-mdc-auto-init="MDCRipple">Login</button>
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
  <script src="js/toolbar.js"></script>
  <script src="js/index.js"></script>
</body>

</html>