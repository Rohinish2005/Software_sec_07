<?php
$conn = new mysqli("127.0.0.1","root","","test");

if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}

$msg = "";

if(isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result)>0){
        $msg = "<p class='message success'>Login Successful</p>";
    }
    else{
        $msg = "<p class='message error'>Login Failed</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Secure Login</title>

<style>
body {
    font-family: Arial;
    background: #eef2f7;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Card */
.container {
    background: white;
    padding: 25px;
    width: 300px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

/* Heading */
h2 {
    text-align: center;
}

/* Inputs */
input {
    width: 100%;
    padding: 8px;
    margin: 8px 0;
}

/* Button */
button {
    width: 100%;
    padding: 10px;
    background: #2d89ef;
    color: white;
    border: none;
    border-radius: 4px;
}

/* Messages */
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
    <h2>Secure Login</h2>

    <?php echo $msg; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>