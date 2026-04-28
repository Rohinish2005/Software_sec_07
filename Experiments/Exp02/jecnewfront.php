<?php
$conn = new mysqli("127.0.0.1","root","","test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM login 
              WHERE Username='$username' 
              AND Password='$password'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $msg = "<p class='message success'>Login Successful</p>";
    } else {
        $msg = "<p class='message error'>Login Failed</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login System</title>

<style>
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
    width: 300px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
}

input {
    width: 100%;
    padding: 8px;
    margin: 8px 0;
}

button {
    width: 100%;
    padding: 10px;
    background: #2d89ef;
    color: white;
    border: none;
    border-radius: 4px;
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
    <h2>Login Page</h2>

    <?php echo $msg; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>