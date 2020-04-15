<html>
	<head>
		<title>Halaman Update Biaya SPP</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../../style/istyle.css">
	</head>
	<body>
		<?php
			// menghubungkan koneksi database
			include '../../koneksi/koneksi.php';
			// menyalakan session
			session_start();
			if($_SESSION['status']!="login"){
				header("location:../../index.php?pesan=belum_login");
			}
			include '../sidenav.php';
		?>
		<div class="duduy" style="width:100%;padding:5px;background-color:; float:right; text-align:right;">
			<label><?php echo 'ADMIN '.$_SESSION['nm_admin'].' ('.$_SESSION['id_admin'].')'; ?></label>
			<a class="logout" href="../../logout.php" style="padding-left:px;" onclick="return confirm('Anda ingin Log Out?')">
				<button class="button-logout">Logout <i class="fa fa-power-off"></i></button>
			</a>
		</div>
		<div class="main">
			<a href="frm_biaya_spp.php?halaman=1">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
			</a>
			<h1>&nbsp Update Biaya SPP</h1>
			<hr>
			<div class="container">
			<?php
				$id = $_GET['id'];
				$data = mysqli_query($connect,"SELECT * FROM tb_biayaspp WHERE id_biayaspp='$id'");
				while($row = mysqli_fetch_array($data)){
			?>
				<form method="post" action="proses/proses_update_biaya_spp.php" >  
					<div class="column">
						<div class="row" style="padding-right:20px;">
							<div class="col-1" style="width:30%;">
								<label for="kd_pelanggan">ID Biaya</label>
							</div>
							<div class="col-2">
								<input type="text" maxlength="10" name="id_biaya" value="<?php echo $row['id_biayaspp']; ?>" readonly>
							</div>
						</div>
							
						<div class="row" style="padding-right:20px;">
							<div class="col-1" style="width:30%;">
								<label for="nama_lengkap">Tahun Ajaran</label>
							</div>
							<div class="col-2">
								<input type="text" maxlength="9" name="th_ajaran"  value="<?php echo $row['angkatan']; ?>" readonly>
							</div>
						</div>

						<div class="row" style="padding-right:20px;">
							<div class="col-1" style="width:30%;">
								<label for="kd_pelanggan">Biaya</label>
							</div>
							<div class="col-2">
								<input type="text" maxlength="12" name="biaya" pattern="[0-9]+" title="Maximal 12 Digit Angka" value="<?php echo $row['biaya_spp']; ?>" required>
							</div>
						</div>
						
						<div class="row" <div class="row" style="padding-right:20px; padding-bottom:20px;">
							<input type="submit" style="float:right;" value="Update Siswa">
						</div>
					</div>   
				</form>
				<?php } ?>
				</div>
			</div>
		</div>
		<script>
			/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
			var dropdown = document.getElementsByClassName("dropdown-btn");
			var i;
			
			for (i = 0; i < dropdown.length; i++) {
				dropdown[i].addEventListener("click", function() {
					this.classList.toggle("active");
					var dropdownContent = this.nextElementSibling;
					if (dropdownContent.style.display === "block") {
						dropdownContent.style.display = "none";
					} else {
						dropdownContent.style.display = "block";
					}
				});
			}
		</script>
	</body>
</html> 