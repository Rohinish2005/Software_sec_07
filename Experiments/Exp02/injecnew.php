<?php
$conn = new mysqli("127.0.0.1","root","","test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM login 
              WHERE Username='$username' 
              AND Password='$password'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result)>0) {
        echo "<h3 style='color:green'>Login successful</h3>";
        echo "<p>Welcome $username</p>";   
    } else {
        echo "<h3 style='color:red'>Login failed</h3>";
    }
}
?>

<h2>Login Page </h2>
<form method="post">
User Name: <input type="text" name="username"><br><br>
Password: <input type="password" name="password"><br><br>
<input type="submit" name="login" value="Login">
</form>