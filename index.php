date_default_timezone_set(“Asia/Jakarta”);
<?php
	//Create database connection using config file 
   include_once("config.php");

	//Fetch all users data from database
	$result= mysqli_query($mysqli, "select * from users ORDER By id DESC");
?>
<html>
<head>
	<title>HomePage</title>
</head>
<body>
	<?php
		if( isset($_POST['cari'])){
			$searchKey = $_POST['cari'];
			$sql = "SELECT * FROM users WHERE name LIKE '%$searchKey%' OR mobile LIKE '%searchKey%'";
		}else
			$sql = "SELECT * FROM users";
			$result = mysqli_query($mysqli, $sql);
		?>
	<form action="" method="POST">
		<input type="text" name="cari" placeholder="cari nama">
		<input type="submit" name="tekan" placeholder="go">

	</form>
	<a href="add.html">add new user</a><br/><br/>
	<table width="90%" border=5>
		<tr>
			<th>name</th>
			<th>mobile</th>
			<th>email</th>
			<th style="width: 200px" height="50px">foto</th>
			<th>tindakan</th>
		</tr>
<?php
	while($user_data=mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>" . $user_data['name']."</td>";
		echo "<td>" . $user_data['mobile']."</td>";
		echo "<td>" . $user_data['email']."</td>";
		echo "<td><img width='80' src='gambar/" . $user_data['foto'] . "'</td>";
		echo "<td><a href='edit.php?id=$user_data[id]'>Edit</a> | <a href='delete.php?id=$user_data[id]'>Delete</a></td></tr>";
	}
?>
</table>
</body>
</html>