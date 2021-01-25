<?php
// INCLUDE KONEKSI KE DATABASE
include_once("config.php");

if (isset($_POST['update'])) {

	// AMBIL ID DATA
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);

	// AMBIL NAMA FILE FOTO SEBELUMNYA
	$data = mysqli_query($mysqli, "SELECT foto FROM users WHERE id='$id'");
	$dataImage = mysqli_fetch_assoc($data);
	$oldImage = $dataImage['foto'];

	// AMBIL DATA DATA DIDALAM INPUT
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$mobile = mysqli_real_escape_string($mysqli, $_POST['mobile']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$filename = $_FILES['newImage']['name'];

	// CEK DATA TIDAK BOLEH KOSONG
	if (empty($name) || empty($mobile) || empty($email)){

		if (empty($nama)) {
			echo "<font color='red'>Kolom Nama tidak boleh kosong.</font><br/>";
		}

		if (empty($umur)) {
			echo "<font color='red'>Kolom Umur tidak boleh kosong.</font><br/>";
		}

		if (empty($email)) {
			echo "<font color='red'>Kolom Email tidak boleh kosong.</font><br/>";
		}
	} else {

		// JIKA FOTO DI GANTI
		if (!empty($filename)) {
			$filetmpname = $_FILES['newImage']['tmp_name'];
			$folder = "gambar/";

			// GAMBAR LAMA DI DELETE
			unlink($folder . $oldImage) or die("GAGAL");

			// GAMBAR BARU DI MASUKAN KE FOLDER
			move_uploaded_file($filetmpname, $folder . $filename);

			// NAMA FILE FOTO + DATA YANG DI GANTIBARU DIMASUKAN
			$result = mysqli_query($mysqli, "UPDATE users SET name='$name',mobile='$mobile',email='$email',foto='$filename' WHERE id=$id");
		}

		// MEMASUKAN DATA YANG DI UPDATE KECUALI GAMBAR
		$result = mysqli_query($mysqli, "UPDATE users SET name='$name',mobile='$mobile',email='$email' WHERE id=$id");

		// REDIRECT KE HALAMAN INDEX.PHP
		header("Location: index.php");
	}
}
?>
<?php
// AMBIL ID DARI URL
$id = $_GET['id'];

// AMBIL DATA BERDASARKAN ID
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
	$name = $res['name'];
	$mobile = $res['mobile'];
	$email = $res['email'];
	$image = $res['foto'];
}
?>
<html>

<head>
	<title>Edit Data</title>
</head>

<body>
	<center>
		<a href="index.php">Home</a>
		<br /><br />

		<form name="form1" method="post" action="edit.php" enctype="multipart/form-data">
			<table border="0">
				<tr>
					<td>Nama</td>
					<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" name="umur" value="<?php echo $email; ?>"></td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td><input type="text" name="mobile" value="<?php echo $mobile; ?>"></td>
				</tr>
				<tr>
					<td>Gambar</td>
					<td><img width="80" src="terupload/<?php echo $foto ?>"></td>
					<td><input type="file" name="newImage"></td>
				</tr>
				<tr>
					<td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
					<td><input type="submit" name="update" value="Update"></td>
				</tr>
			</table>
		</form>
	</center>
</body>

</html>
