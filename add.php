<html>

<head>
	<title>Tambah Data</title>
</head>

<body>
<?php
	// INCLUDE KONEKSI KE DATABASE
	include_once("config.php");

	if (isset($_POST['Submit'])) {
		$name = mysqli_real_escape_string($mysqli, $_POST['name']);
		$mobile = mysqli_real_escape_string($mysqli, $_POST['mobile']);
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$filename = $_FILES['foto']['name'];

		// CEK DATA TIDAK BOLEH KOSONG
		if (empty($name) || empty($mobile) || empty($email) || empty($filename)) {

			if (empty($name)) {
				echo "<font color='red'>Kolom Nama tidak boleh kosong.</font><br/>";
			}

			if (empty($mobile)) {
				echo "<font color='red'>Kolom Umur tidak boleh kosong.</font><br/>";
			}

			if (empty($email)) {
				echo "<font color='red'>Kolom Email tidak boleh kosong.</font><br/>";
			}

			if (empty($filename)) {
				echo "<font color='red'>Kolom Gambar tidak boleh kosong.</font><br/>";
			}

			// KEMBALI KE HALAMAN SEBELUMNYA
			echo "<br/><a href='javascript:self.history.back();'>Kembali</a>";
		} else {
			// JIKA SEMUANYA TIDAK KOSONG
			$filetmpname = $_FILES['foto']['tmp_name'];

			// FOLDER DIMANA GAMBAR AKAN DI SIMPAN
			$folder = 'gambar/';
			// GAMBAR DI SIMPAN KE DALAM FOLDER
			move_uploaded_file($filetmpname, $folder . $filename);

			// MEMASUKAN DATA DATA + NAMA GAMBAR KE DALAM DATABASE
			$result = mysqli_query($mysqli, "INSERT INTO users(name,email,mobile,foto) VALUES('$name', '$email', '$mobile', '$filename')");

			// MENAMPILKAN PESAN BERHASIL
			echo "<font color='green'>Data Berhasil ditambahkan.";
			echo "<br/><a href='index.php'>Lihat Hasilnya</a>";
		}
	}
	?>
</body>

</html>