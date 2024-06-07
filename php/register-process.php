<?php
include '../resources/db_connection.php'; // Include your database connection file
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $errors = [];

  $username = sanitize_input($_POST["reg-username"]);
  $password = $_POST["reg-password"];
  $confirmPassword = $_POST["reg-confirm-password"];
  $email = sanitize_input($_POST["reg-email"]);
  $phone = sanitize_input($_POST["reg-phone"]);
  $country = sanitize_input($_POST["reg-country"]);
  $state = sanitize_input($_POST["reg-state"]);
  $pinCode = sanitize_input($_POST["reg-pin-code"]);


  // Validation
  if (empty($username) || !preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
    $errors["username"] = "Invalid username. Only letters, numbers, and underscores are allowed.";
  }

  if (strlen($password) < 8) {
    $errors["password"] = "Password must be at least 8 characters long.";
  }

  if ($password !== $confirmPassword) {
    $errors["confirmPassword"] = "Passwords do not match.";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Invalid email format.";
  }

  if (!preg_match("/^\d{10}$/", $phone)) {
    $errors["phone"] = "Invalid phone number. Please enter 10 digits.";
  }

  // If no errors, proceed
  if (empty($errors)) {
    
    $hashedPassword = hash_password($password);

    // Database Interaction
    $sql = "INSERT INTO users_gameria (username, password, email, phone, country, state, pin_code) VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        $errors["db"] = "Error preparing statement: " . $conn->error;
    } else {
        $stmt->bind_param("sssssss", $username, $hashedPassword, $email, $phone, $country, $state, $pinCode);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id; // Get the inserted user's ID
            $_SESSION['user_id'] = $user_id; 
            log_event($conn, 'User Registration', 'New user registered successfully.', $user_id, [
                'username' => $username,
                'email' => $email,
                'phone' => $phone
            ]);
            showMessage("Registration successful! Welcome, " . GetUserName($conn), "../user-dashboard.php"); // Use GetUserName() here
        } else {
            $errors["db"] = "Error registering user: " . $stmt->error;
        }

        $stmt->close();
    }
  }

  // If there are errors, return them to the frontend (using AJAX or session variables)
  // Example with AJAX:
  if (!empty($errors)) {
    echo json_encode($errors);
  }
}
?>
