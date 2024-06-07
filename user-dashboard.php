<?php
session_start();
include 'resources/db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch user data based on session user ID
$userId = $_SESSION['user_id'];
$sql = "SELECT username, email, phone, balance FROM users_gameria WHERE id = $userId";
$result = $conn->query($sql);

// Check if the query was successful and the user was found
if ($result && $result->num_rows > 0) {
    $userData = $result->fetch_assoc(); // Get the user data
} else {
    // Handle the case where the user was not found (e.g., display an error)
    $userData = [
        'username' => 'Not Found',
        'email' => 'Not Found',
        'phone' => 'Not Found',
        'balance' => 'Not Found'
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B-UMS | User-Dashboard</title>

    <!-- LINKED CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/nav-footer.css">
    <link rel="stylesheet" href="css/user.css">
    <!-- LINKED JS -->
    <script src="js/connector.js" ></script>
    <script src="js/main.js" ></script>
    <!-- META TAGS & OGs -->
    <meta name="description" content="Your personalized dashboard for B-UMS, manage your account, check balance, and start playing games.">
    <meta name="keywords" content="B-UMS, user dashboard, gaming platform, account management">
  
    <meta property="og:title" content="B-UMS | User Dashboard">
    <meta property="og:description" content="Your personalized dashboard for B-UMS, manage your account, check balance, and start playing games.">
    <meta property="og:image" content="https://yourwebsite.com/images/dashboard-preview.jpg">
    <meta property="og:url" content="https://yourwebsite.com/dashboard">
    <meta property="og:type" content="website">
  

</head>
<body>
<div id="header"></div>
    <div class="user-dashboard-main-container">
    <div class="user-info-container">
        <div class="user-info-card">
            <h3>User Information</h3>
            <div class="info-capsule-container"> <div class="info-capsule">
                    <span class="material-icons">person</span>
                    <p>Username:</p> <span id="username"><?php echo $userData['username']; ?></span>
                </div>
                <div class="info-capsule">
                    <span class="material-icons">email</span>
                    <p>Email:</p> <span id="email"><?php echo $userData['email']; ?></span>
                </div>
                <div class="info-capsule">
                    <span class="material-icons">phone</span>
                    <p>Phone:</p> <span id="phone"><?php echo $userData['phone']; ?></span>
                </div>
                <div class="info-capsule">
                    <span class="material-icons">account_balance_wallet</span>
                    <p class="special21">Balance:</p> <span id="balance"><?php echo $userData['balance']; ?></span>
                </div>
            </div>
        </div>
    </div>

          
          <div class="user-rules-container">
            <h2>User Rules</h2>
            <div class="rule-card">
              <div class="header">Rule Topic</div> 

              <span class="material-icons">gavel</span>
              <p>Respect other users and maintain a friendly environment.</p>
            </div>
            <div class="rule-card">
              <div class="header">Rule Topic</div> 

              <span class="material-icons">no_accounts</span>
              <p>Avoid sharing personal information with strangers.</p>
            </div>
            <div class="rule-card">
              <div class="header">Rule Topic</div> 

              <span class="material-icons">report_problem</span>
              <p>Report any inappropriate behavior or content.</p>
            </div>
            <div class="rule-card">
              <div class="header">Rule Topic</div> 

              <span class="material-icons">verified_user</span>
              <p>Follow the platform's terms of service and guidelines.</p>
            </div>
          </div>
          
      
          <div class="user-controls-container">
            <h2>Account Actions</h2>
            <div class="control-button" onclick="changePassword()">
              <span class="material-icons">lock</span> 
              <div class="text-21">Change Password</div>
            </div>
            <div class="control-button" onclick="editDetails()">
              <span class="material-icons">edit</span> 
              <div class="text-21">Edit Details</div>
            </div>
            <div class="control-button" onclick="checkBalance()">
              <span class="material-icons">account_balance</span>
              <div class="text-21">Check Balance</div>
            </div>
            <div class="control-button" onclick="addBalance()">
              <span class="material-icons">add</span>
              <div class="text-21">Add Balance</div>
            </div>
            <div class="control-button" onclick="startGame()">
              <span class="material-icons">videogame_asset</span>
              <div class="text-21">Start Game</div>
            </div>
            <div class="control-button" onclick="startGame()">
              <span class="material-icons">updates</span>
              <div class="text-21">Games Updates</div>
            </div>
            <div class="control-button" onclick="startGame()">
              <span class="material-icons">updates</span>
              <div class="text-21">Web Updates</div>
            </div>
            <div class="control-button" onclick="startGame()">
              <span class="material-icons">report</span>
              <div class="text-21">Report</div>
            </div>
            <div class="control-button" onclick="startGame()">
              <span class="material-icons">man</span>
              <div class="text-21">Generate Ticket</div>
            </div>
            
          </div>
          
      </div>
      
<div id="footer"></div>


</body>
</html>