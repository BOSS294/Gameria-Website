<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B-UMS | Login-Registeration</title>

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

<div class="container" id="login-container">
    <h2>Login</h2>
    <form id="login-form" action="php/login-process.php" method="POST">
        <div class="form-group">
            <label for="login-username">Username or E-Mail</label>
            <input type="text" id="login-username" name="login-username" required>
        </div>
        <div class="form-group password-toggle">
            <label for="login-password">Password</label>
            <input type="password" id="login-password" name="login-password" required>
            <i class="material-icons">visibility</i>
        </div>
        <button type="submit" class="btn-logreg">Login Now</button>
    </form>
    <p><a href="#">Forgot password?</a></p>
    <p class="login-link">Already have an account? <a href="register.php">Register Now</a></p>
</div>
<div id="footer"></div>
</body>
</html>