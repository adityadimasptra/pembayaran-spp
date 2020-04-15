<html>
	<head>
		<title>Halaman Lihat Siswa</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../../style/istyle.css">
	</head>
	<body>
		<?php
			// menyalakan session
			session_start();
			if($_SESSION['status']!="login"){
				header("location:../../index.php?pesan=belum_login");
			}
		?>

		<div class="sidenav">
			<div class="fakeimg"><img src="../../images/favicon.jpg" style="width:100%;border-radius:50%;"></div>
			<br>
			<a href="../home.php"><i class="fa fa-home"></i>&nbsp Home</a>
			<button class="dropdown-btn"><i class="fa fa-tags"> </i>&nbsp Master
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-container">
				<a href="frm_siswa.php?halaman=1"><i class="fa fa-child fa-lg"></i>&nbsp Entry Siswa</a>
				<a href="frm_kelas.php?halaman=1"><i class="fa fa-graduation-cap"></i>&nbspEntry Kelas</a>
				<a href="frm_biaya_spp.php?halaman=1"><i class="fa fa-money"></i>&nbsp Entry Biaya SPP</a>
				<a href="#"></a>
			</div>
			<button class="dropdown-btn"><i class="fa fa-files-o"></i>&nbsp Transaksi
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-container">
				<a href="../transaksi/frm_detsiswa.php?halaman=1"><i class="	fa fa-group"></i>&nbsp Entry Siswa Kelas</a>
				<a href="../transaksi/frm_pembayaran_spp.php"><i class="fa fa-book"></i>&nbsp Entry Pembayaran SPP</a>
				<a href="#"><i class="fa fa-print"></i>&nbsp Cetak Bukti Pembayaran SPP</a>
				<a href="#"><i class="fa fa-print"></i>&nbsp Cetak Surat Peringatan</a>
				<a href="#"><i class="fa fa-print"></i>&nbsp Cetak Surat Panggilan</a>
				<a href="#"></a>
			</div>
			<button class="dropdown-btn"><i class="fa fa-file-text"></i>&nbsp Laporan 
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-container">
				<a href="../laporan/laporan_pembayaran_spp.php"><i class="fa fa-file"></i>&nbsp Pembayaran SPP</a>
				<a href="../laporan/laporan_tunggakan_spp.php"><i class="fa fa-file"></i>&nbsp Tunggakan SPP</a>
				<a href="#"><i class="fa fa-file"></i>&nbsp Surat Panggilan Orangtua</a>
			</div>
		</div>
		<div class="duduy" style="width:100%;padding:5px;background-color:; float:right; text-align:right;">
			<a class="logout" href="../../logout.php" style="padding-left:px;" onclick="return confirm('Anda ingin Log Out?')">
				<button class="button-logout">Logout <i class="fa fa-power-off"></i></button>
			</a>
		</div>
		<div class="main">
			<a href="frm_siswa.php?halaman=1">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
			</a>
				<h1>&nbspLihat Siswa</h1>
				<hr>
				<div class="container" style="background-color:white;">
				<?php
					include '../../koneksi/koneksi.php';
					include '../function/format.php';
					$nisn = $_GET['nisn'];
					$data = mysqli_query($connect,"SELECT * FROM tb_siswa WHERE nisn='$nisn'");
					while($row = mysqli_fetch_array($data)){
				?>
						<div class="row"> 
						
						<!-- COLUMN DATA SISWA -->
						<div style="background-color:#999999; color:white; border-radius:20px; width:400px; padding-left:20px">
							<h2><i class="fa fa-user"> &nbsp;<?php echo $row['nm_siswa']; ?></i></h2>
						</div>
						
							<div class="column" style="width:40%;background-color:;">
												
								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">NISN Siswa</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo $row['nisn']; ?></label>
									</div>
								</div>
						
								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">Nama Siswa</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo $row['nm_siswa']; ?></label>
									</div>
								</div>

								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">Jenis Kelamin</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo $row['jenis_kelamin']; ?></label>
									</div>
								</div>
										
								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">Tempat Lahir</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo $row['tempat_lahir']; ?></label>
									</div>
								</div>

								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">Tanggal Lahir</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo tanggal($row['tgl_lahir_siswa']); ?> (<?php echo usia($row['tgl_lahir_siswa']).' thn'; ?>)</label>
									</div>
								</div>

								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">Agama</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo $row['agama']; ?></label>
									</div>
								</div>
																			
								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">Alamat Siswa</label>
									</div>
									<div class="col-2" >
										<label class="lihat">: <?php echo $row['alamat_siswa']; ?></label>
									</div>
								</div>
								
								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">No. Telp Siswa</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo $row['telp_siswa']; ?></label>
									</div>
								</div>
								
							</div>
							
							<!-- COLUMN DATA ORANG TUA -->
							<div class="column" style="width:40%;background-color:;">
							
								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">Nama orangtua</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo $row['nm_orangtua']; ?></label>
									</div>
								</div>
					
								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">Tgl Lahir orangtua</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo tanggal($row['tgl_lahir_orangtua']); ?> (<?php echo usia($row['tgl_lahir_orangtua']).' thn'; ?>)</label>
									</div>
								</div>
						
								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">Pekerjaan</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo $row['pekerjaan']; ?></label>
									</div>
								</div>

								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">Alamat Kantor</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo $row['alamat_kantor']; ?></label>
									</div>
								</div>
										
								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">Penghasilan</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo $row['penghasilan']; ?></label>
									</div>
								</div>

								<div class="row">
									<div class="col-1" style="width:30%">
										<label class="lihat">No. Telp orangtua</label>
									</div>
									<div class="col-2">
										<label class="lihat">: <?php echo $row['telp_orangtua']; ?></label>
									</div>
								</div>
								<br>
								<center><a href="frm_update_siswa.php?id=<?php echo $row['id_siswa']; ?> " > <button class="button-abu">Update</button></a></center>
							</div>
						</div>					
					<?php } ?>
					
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