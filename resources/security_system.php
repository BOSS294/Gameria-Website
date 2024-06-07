<?php
// Function to sanitize user input
function sanitize_input($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

// Function to hash passwords
function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Function to verify hashed password
function verify_password($password, $hashed_password) {
    return password_verify($password, $hashed_password);
}

// Function to prevent SQL injection
function prevent_sql_injection($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
}

// Function to generate a random token
function generate_token($length = 32) {
    return bin2hex(random_bytes($length));
}

function log_event($conn, $event_type, $event_message, $user_id = null, $additional_data = null) {
    $timestamp = date("Y-m-d H:i:s");

    // Sanitize input (if you haven't already)
    $event_type = prevent_sql_injection($conn, $event_type);
    $event_message = prevent_sql_injection($conn, $event_message);

    // Get IP address
    $ip_address = $_SERVER['REMOTE_ADDR']; 

    // Handle additional data
    if (is_array($additional_data)) {
        $additional_data = json_encode($additional_data); // Convert arrays to JSON strings
    } else {
        $additional_data = prevent_sql_injection($conn, $additional_data);
    }

    // Prepare and execute SQL statement using a prepared statement
    $sql = "INSERT INTO logger_gameria (event_type, event_message, timestamp, user_id, ip_address, additional_data) 
            VALUES (?, ?, ?, ?, ?, ?)"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $event_type, $event_message, $timestamp, $user_id, $ip_address, $additional_data);

    if ($stmt->execute()) {
        return true;
    } else {
        // Handle the error gracefully, e.g., log it to a file or return an error message
        error_log("Error logging event: " . $stmt->error);
        return false;
    }
}

function showMessage($message, $redirectUrl) {
    $quotes = [
        "Your gaming gear is on its way! Level up soon! 🎮🚀",
        "Get ready to frag! Your order is en route! 💥🚚",
        "Victory is in sight! Your loot is incoming! 🏆📦",
        "Hold tight, gamer! Your goodies are almost there! 🕹️🎁",
        "Thanks for playing with us! Your order is on its way! 🎉🚚"
        // Add more quotes here...
    ];
    

    $randomQuote = $quotes[array_rand($quotes)]; // Select a random quote

    // Echo the CSS link within the function
    echo '<link rel="stylesheet" href="loader.css">'; 

    echo '
    <div id="message-container">
        <div class="loader">
            <i class="fas fa-spinner fa-spin"></i>  </div> <p class="loading-message">' . $message . '</p>
        <p class="quote"><i class="fas fa-quote-left"></i> ' . $randomQuote . ' <i class="fas fa-quote-right"></i></p>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "' . $redirectUrl . '";
        }, 3000); 
    </script>
    ';
}

function GetUserName($conn) {
    $user_id = $_SESSION['user_id'];

    // Check database connection
    if (!$conn) {
        log_event($conn, 'Error', 'Database connection failed in GetUserName()');
        return "Guest"; // Or another default value
    }

    // Fetch username from database
    $sql = "SELECT username FROM users_gameria WHERE id = $user_id";
    $result = $conn->query($sql);
    log_event($conn, 'Database', 'User id selection: '.$user_id);

    if ($result && $result->num_rows == 1) {
        $user_details = $result->fetch_assoc();
        $username = $user_details['username'];
        return $username;
    } else {
        log_event($conn, 'Error', 'User not found during username retrieval (ID: ' . $user_id . ')');
        return "Guest";
    }
}


?>