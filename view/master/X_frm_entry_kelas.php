<html>
	<head>
		<title>Halaman Entry Kelas</title>
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
		<?php
		$carikode = mysqli_query($connect, "select max(id_kelas) from tb_kelas") or die (mysql_error());
			// menjadikannya array
			$datakode = mysqli_fetch_array($carikode);
			// jika $datakode
			if ($datakode) {
			 $nilaikode = substr($datakode[0], 1);
			 // menjadikan $nilaikode ( int )
			 $kode = (int) $nilaikode;
			 // setiap $kode di tambah 1
			 $kode = $kode + 1;
			 $kode_otomatis = "K".str_pad($kode, 4, "0", STR_PAD_LEFT);
			} else {
			 $kode_otomatis = "K0001";
			}
		?>
		<div class="main">
		<a href="frm_kelas.php?halaman=1">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
			</a>
				<h1>&nbsp; Entry Kelas</h1>
				<hr>
				<div class="container">
					<form method="post" action="proses/proses_entry_kelas.php" >  
						<div class="column">
				
							<div class="row">
								<div class="col-1" style="margin-right:10px;>
									<label for="kd_pelanggan">ID Kelas</label>
								</div>
								<div class="col-2">
									<input type="text" maxlength="5" name="kode_kelas" value="<?php echo "$kode_otomatis"; ?>" readonly>
								</div>
							</div>
					
							<div class="row">
								<div class="col-1" style="margin-right:10px;">
									<label for="nama_lengkap">Nama Kelas</label>
								</div>
								<div class="col-2">
									<input type="text" maxlength="10" name="nama_kelas" title="" required>
								 </div>
							 </div>
							 
							 <div class="row" style="padding-bottom:20px;">
								<input type="submit" style="float:right; margin-right:19px;" value="Simpan Data">
							 </div>
							
						</div>
					</form> 
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
