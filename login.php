<?php
include_once('koneksi.php');

if ( isset($_POST["masuk"]) ) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
	if(mysqli_num_rows($result) === 1){
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"])){
		header("Location: index.php");
		exit;
		}
	}

	$eror = true;
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Halaman Login</h1>
	<?php if( isset($eror)) : ?>
		<p>salah</p>
	<?php endif; ?>
<ul>
	<form action="index.php" method="post">
		<li>
			<label for="username">Username</label>
			<input type="text' name="Username" id="Username">
		</li>
		<li>
			<label for="password">Password</label>
			<input type="password" name="Password" id="Password">
		</li>
		<li>
			<button type=submit" name="submit">Masuk</button>
		</li>
	</form>
</ul>
</body>
</html>