<html>
	<head>
		<title>Halaman Utama</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../style/istyle.css">
	</head>
	<body>
		<?php
			// menyalakan session
			session_start();
			if($_SESSION['status']!="login"){
				header("location:../index.php?pesan=belum_login");
			}
		?>
		<div class="sidenav">
			<div class="fakeimg"><img src="../images/favicon.jpg" style="width:100%;border-radius:50%;"></div>	
			<br>
			<a href="home.php"><i class="fa fa-home"></i>&nbsp; Halaman Utama</a>
			<button class="dropdown-btn"><i class="fa fa-tags"> </i>&nbsp; Master
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-container">
				<a href="master/frm_siswa.php?halaman=1"><i class="fa fa-child fa-lg"></i>&nbsp; Data Siswa</a>
				<a href="master/frm_kelas.php?halaman=1"><i class="fa fa-graduation-cap"></i>&nbsp; Data Kelas</a>
				<a href="master/frm_biaya_spp.php?halaman=1"><i class="fa fa-money"></i>&nbsp; Data Biaya SPP</a>
			</div>
			<button class="dropdown-btn"><i class="fa fa-files-o"></i>&nbsp; Transaksi
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-container">
				<a href="transaksi/frm_detsiswa.php?halaman=1"><i class="	fa fa-group"></i>&nbsp; Data Siswa Kelas</a>
				<a href="transaksi/kartu_spp.php"><i class="fa fa-address-card"></i>&nbsp; Cetak Kartu SPP</a>
				<a href="transaksi/frm_pembayaran_spp.php"><i class="fa fa-book"></i>&nbsp; Pembayaran SPP</a>
				<a href="transaksi/frm_sp_tunggakan.php?halaman=1"><i class="fa fa-print"></i>&nbsp; Surat Peringatan Tunggakan</a>
				<a href="transaksi/frm_sp_orangtua.php?halaman=1"><i class="fa fa-print"></i>&nbsp; Surat Panggilan Orangtua</a>
			</div>
			<button class="dropdown-btn"><i class="fa fa-file-text"></i>&nbsp; Laporan 
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-container">
				<a href="laporan/laporan_pembayaran_spp.php"><i class="fa fa-file"></i>&nbsp; Lap Pembayaran SPP</a>
				<a href="laporan/laporan_tunggakan_spp.php"><i class="fa fa-file"></i>&nbsp; Lap Tunggakan Pembayaran SPP</a>
				<a href="laporan/laporan_sp_orangtua.php"><i class="fa fa-file"></i>&nbsp; Lap Surat Panggilan Orangtua</a>
			</div>
		</div>
		<div class="duduy" style="width:100%;padding:5px;background-color:; float:right; text-align:right;">
			<?php echo 'ADMIN '.$_SESSION['nm_admin'].' ('.$_SESSION['id_admin'].')'; ?>
			<a class="logout" href="../logout.php" style="padding-left:px;" onclick="return confirm('Anda ingin Log Out?')">
				<button class="button-logout">Logout <i class="fa fa-power-off"></i></button>
			</a>
		</div>
		<div class="main">
			<div class="container">
				<h1>Halaman Utama</h1>
				<hr>
				<p>
				</p>
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