<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B-UMS | Registeration</title>

    <!-- LINKED CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/nav-footer.css">
    <link rel="stylesheet" href="css/log-reg.css">
    <!-- LINKED JS -->
    <script src="js/connector.js" ></script>
    <script src="js/main.js" ></script>
    <!-- META TAGS & OGs -->


</head>
<body>
<div id="header"></div>

<div class="container" id="register-container">
  <h2>Register</h2>
  <form id="register-form" action="php/register-process.php" method="POST"> 
    <div class="form-group">
      <label for="reg-username">Username</label>
      <input type="text" id="reg-username" name="reg-username" required>
    </div>

    <div class="form-group password-toggle">
      <label for="reg-password">Password</label>
      <input type="password" id="reg-password" name="reg-password" required>
      <i class="material-icons">visibility</i>
    </div>
    
    <div class="form-group password-toggle">
      <label for="reg-confirm-password">Confirm Password</label>
      <input type="password" id="reg-confirm-password" name="reg-confirm-password" required>
      <i class="material-icons">visibility</i>
    </div>

    <div class="form-group">
      <label for="reg-email">E-Mail</label>
      <input type="email" id="reg-email" name="reg-email" required>
    </div>

    <div class="form-group">
      <label for="reg-phone">Phone Number</label>
      <input type="tel" id="reg-phone" name="reg-phone" required>
    </div>

    <div class="form-group">
      <label for="reg-country">Country</label>
      <input type="text" id="reg-country" name="reg-country" required>
    </div>

    <div class="form-group">
      <label for="reg-state">State</label>
      <input type="text" id="reg-state" name="reg-state" required>
    </div>

    <div class="form-group">
      <label for="reg-pin-code">Pin Code</label>
      <input type="text" id="reg-pin-code" name="reg-pin-code" required>
    </div>

    <div class="form-group">
      <label for="reg-city">City</label>
      <input type="text" id="reg-city" name="reg-city" readonly>
    </div>

    <div class="form-group">
      <label for="reg-district">District</label>
      <input type="text" id="reg-district" name="reg-district" readonly>
    </div>

    <button type="submit" class="btn-logreg">Register Now</button>
  </form>
  <p class="login-link">Already have an account? <a href="login.php" >Login Now</a></p>
</div>

<div id="footer"></div>
</body>
</html>