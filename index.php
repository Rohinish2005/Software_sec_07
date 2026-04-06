<?php
declare(strict_types=1);

// Secure session configuration (before session_start)
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_secure', '1'); // enable only with HTTPS
ini_set('session.use_strict_mode', '1');

session_start();
require_once("connect.php");

// ----------------------
// CONFIG
// ----------------------
define('MAX_ATTEMPTS', 5);
define('LOCK_TIME', 300); // 5 minutes

// ----------------------
// RATE LIMITING
// ----------------------
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

// Lockout logic
if ($_SESSION['attempts'] >= MAX_ATTEMPTS) {
    if (time() - $_SESSION['last_attempt_time'] < LOCK_TIME) {
        die("<h3>Too many attempts. Try again later.</h3>");
    } else {
        $_SESSION['attempts'] = 0; // reset after lock period
    }
}

// ----------------------
// HANDLE LOGIN
// ----------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Secure input handling
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'];

    // Validation
    if (empty($username) || empty($password)) {
        echo "<h3>Invalid input</h3>";
        exit();
    }

    if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        echo "<h3>Invalid username format</h3>";
        exit();
    }

    try {
        // ----------------------
        // DATABASE QUERY
        // ----------------------
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        
        if (!$stmt) {
            throw new Exception("Prepare failed");
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        // ----------------------
        // AUTHENTICATION
        // ----------------------
        if ($user && password_verify($password, $user['password'])) {

            // Reset attempts
            $_SESSION['attempts'] = 0;

            // Secure session
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            echo "<h2>Login Successful</h2>";

        } else {

            $_SESSION['attempts']++;
            $_SESSION['last_attempt_time'] = time();

            echo "<h3>Invalid credentials</h3>";

            // ----------------------
            // SAFE LOGGING (NO PASSWORD!)
            // ----------------------
            $attack_type = "FAILED_LOGIN";

            $log_stmt = $conn->prepare(
                "INSERT INTO attack_logs (ip_address, username, attack_type) VALUES (?, ?, ?)"
            );

            if ($log_stmt) {
                $log_stmt->bind_param("sss", $ip, $username, $attack_type);
                $log_stmt->execute();
            }
        }

    } catch (Exception $e) {
        // Generic error message (no internal info leak)
        error_log("Login error: " . $e->getMessage());
        echo "<h3>Something went wrong. Try again later.</h3>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Secure Login</title>
</head>
<body>

<h2>Login Form</h2>

<form method="POST" autocomplete="off">
    Username: 
    <input type="text" name="username" required pattern="[a-zA-Z0-9_]{3,20}">
    <br><br>

    Password: 
    <input type="password" name="password" required minlength="8">
    <br><br>

    <input type="submit" value="Login">
</form>

</body>
</html>
