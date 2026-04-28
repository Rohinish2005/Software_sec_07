<?php
$conn = new mysqli("127.0.0.1","root","","test");

if ($conn->connect_error) {
    die("connection failed:" . mysqli_connect_error());
}

$msg = "";

if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$stmt = mysqli_prepare($conn,"SELECT * FROM login WHERE username = ? AND password = ?");

	mysqli_stmt_bind_param($stmt, "ss" , $username , $password);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

	if(mysqli_num_rows($result)>0) {
		$msg = "<p class='message success'>Login Successful</p>";
	}
	else {
		$msg = "<p class='message error'>Login Failed</p>";
	}
} 
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>
* {
    box-sizing: border-box;  /* 🔥 FIX for button issue */
}

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
    width: 320px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Heading */
h2 {
    text-align: center;
    margin-bottom: 15px;
}

/* Inputs */
input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Button */
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

/* Hover effect (extra polish) */
button:hover {
    background: #1c6ed5;
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
    <h2>Login</h2>

    <?php echo $msg; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>