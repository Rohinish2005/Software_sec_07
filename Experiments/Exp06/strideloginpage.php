<?php

// Database connection
$conn = new mysqli("127.0.0.1","root","","test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Login logic
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch hashed password from database
    $query = "SELECT password FROM login WHERE username='$username'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        $stored_hash = $row['password'];

        // Verify password
        if(password_verify($password,$stored_hash)){

            $message = "<p class='message success'>Login Successful</p>";

        }else{

            $message = "<p class='message error'>Wrong Password</p>";

        }

    }else{

        $message = "<p class='message error'>User Not Found</p>";

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

    <?php echo $message; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>