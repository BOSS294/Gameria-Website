<?php
include 'db_connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Sanitize input
    $loginInput = sanitize_input($_POST["login-username"]); // Could be username or email
    $password = $_POST["login-password"];

    // Validation
    if (empty($loginInput) || empty($password)) {
        $errors["login"] = "Please enter both username/email and password.";
    }

    // If no errors, check credentials
    if (empty($errors)) {

        // Prepare the SQL statement (using a placeholder for the input)
        $stmt = $conn->prepare("SELECT id, username, password FROM users_gameria WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $loginInput, $loginInput); // Bind the parameter twice (for username and email checks)

        // Execute the query
        $stmt->execute();
        
        // Get the results
        $result = $stmt->get_result();
        
        // Check if a user was found
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // Verify the password
            if (verify_password($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id']; // Store user ID in session
                log_event($conn, 'Login', 'User logged in successfully.', $user['id']);
                showMessage("Logged in successfully redirecting to dashboard...","../user-dashboard.php");
                exit();
            } else {
                // Incorrect password
                $errors["login"] = "Incorrect username/email or password.";
                log_event($conn, 'Login Failed', 'Incorrect password attempt for user: ' . $loginInput);
            }
        } else {
            // User not found
            $errors["login"] = "Incorrect username/email or password.";
            log_event($conn, 'Login Failed', 'User not found: ' . $loginInput);
        }

        $stmt->close(); // Close the statement
    }
    
    // If there are errors, return them to the frontend (using AJAX or session variables)
    // Example with AJAX:
    if (!empty($errors)) {
        echo json_encode($errors);
    }
}
