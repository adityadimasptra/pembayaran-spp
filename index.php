<html>
<head>
	<title>Halaman Login</title>
	<link rel="stylesheet" type="text/css" href="style/istyle.css">
</head>
<body>

<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
			echo "<script>alert('Username atau Password salah!');</script>";
		}else if($_GET['pesan'] == "belum_login"){
			echo "<script>alert('Maaf anda harus login terlebih dahulu');</script>";
		}else if($_GET['pesan'] == "logout"){
			echo "<script>alert('Berhasil Logout');</script>";
		}
	}
?>

<br/><br/>
	<center><h2>Login</h2></center>	
	
	<div class="login"">
	<div class="fakeimg"><img src="images/favicon.jpg" style="width:100%;border-radius:50%;"></div>
	<br/>
		<form action="conf-login.php" method="post" onSubmit="">
			<div>
				<label>Username:</label>
				<input type="text" name="username" placeholder="Masukan username" />
			</div>
			<div>
				<label>Password:</label>
				<input type="password" name="password" placeholder="Masukan password"/>
			</div>			
			</br>
			<div>
				<input type="submit" value="Login" class="tombol" style="float:right;">
			</div>
		</form>
	</div>
</body>
</body>
</html>