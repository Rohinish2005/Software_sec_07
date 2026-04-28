<?php
session_start();

$conn = new mysqli("127.0.0.1","root","","test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

if(empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if(isset($_POST['login'])) {

    if(!isset($_POST['csrf_token']) || 
       !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("CSRF attack detected!");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn,"SELECT password FROM login WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s" , $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)) {

        if(password_verify($password, $row['password'])) {

            $_SESSION['user'] = $username;
            $msg = "<p class='message success'>Login Successful</p>";

        } else {
            $msg = "<p class='message error'>Invalid Password</p>";
        }

    } else {
        $msg = "<p class='message error'>User not found</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>
* {
    box-sizing: border-box; 
}

body {
    font-family: Arial;
    background: #eef2f7;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: white;
    padding: 25px;
    width: 320px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 15px;
}

input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background: #2d89ef;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 5px;
}

button:hover {
    background: #1c6ed5;
}

.message {
    text-align: center;
    font-weight: bold;
    margin-bottom: 10px;
}

.success { color: green; }
.error { color: red; }
</style>

</head>

<body>

<div class="container">
    <h2>Login</h2>

    <?php echo $msg; ?>

    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>