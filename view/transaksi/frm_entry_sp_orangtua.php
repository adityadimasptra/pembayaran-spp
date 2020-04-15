<html>
	<head>
		<title>Halaman Pembayaran SPP</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../../style/istyle.css">		 
	</head>
	<body>
		<?php
			include '../../koneksi/koneksi.php';
			include '../function/format.php';
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
		<a href="frm_sp_orangtua.php?halaman=1">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
		</a>
			<h1>&nbsp;Tambah Surat Panggilan Orangtua</h1>
			<hr>
				<div class="container">
					<div class="column" style="width:100%">	
						<form name="pencarian" method="get">
						
							<div class="row" style="padding-bottom:20px;">
								<div class="col-1" style="width:40%;">
									<label style="float:right;padding-right:20px;">No Surat Peringatan Tunggakan</label>
								</div>
								<div class="col-2" style="width:50%;">
									<input type="text" name="nospt" title="Gunakan 17 Digit" maxlength="17" placeholder="Masukan No SPT" style="width:50%;" required />
									<input type="submit" style="float:;" value="Cari">
								</div>
							</div>
						</form>

						<?php
							if(isset($_GET['nospt']) && $_GET['nospt']!=''){
								$no_speringatan = $_GET['nospt'];
								$query_sptunggakan = mysqli_query($connect, "SELECT 
																														no_speringatan, s.nisn as nisn, nm_siswa, k.id_kelas as id_kelas, nm_kelas, spp.no_pemspp as no_pemspp, bulan, jatuh_tempo, tahun_ajaran, keterangan
																													FROM 
																														sp_tunggakan spt,
																														tb_pembayaranspp spp,
																														detil_siswakelas ds,
																														tb_siswa s,
																														tb_kelas k
																													WHERE
																															ds.nisn = s.nisn
																													AND 	ds.id_kelas = k.id_kelas
																													AND 	ds.nisn = spp.nisn
																													AND 	ds.id_kelas = spp.id_kelas
																													AND 	spt.no_pemspp = spp.no_pemspp
																													AND		spt.no_speringatan = '$no_speringatan'") or die(mysqli_error($connect));
								$data_sptunggakan = mysqli_fetch_array($query_sptunggakan);
								$available = mysqli_num_rows($query_sptunggakan);
								$nisn = $data_sptunggakan['nisn'];
								if($available > 0 ){
							?>
							<hr>
							<center><h3>Biodata</h3></center>
							<div class="row2nd">
								<div class="col-1" style="width:50%;">
									<label for="nama_lengkap" style="float:right;padding-right:20px;">No Surat Peringatan</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label>: <?php echo $no_speringatan;  ?></label>
								</div>
							</div>
							
							<div class="row2nd">
								<div class="col-1" style="width:50%;">
									<label for="nama_lengkap" style="float:right;padding-right:118px;">Nisn</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label>: <?php echo $data_sptunggakan['nisn'] ?></label>
								</div>
							</div>
							
							<div class="row2nd">
								<div class="col-1" style="width:50%;">
									<label for="nama_lengkap" style="float:right;padding-right:69;">Nama Siswa</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label>: <?php echo $data_sptunggakan['nm_siswa'] ?></label>
								</div>
							</div>
							
							<div class="row2nd">
								<div class="col-1" style="width:50%;">
									<label for="nama_lengkap" style="float:right;padding-right:111px;">Kelas</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label>: <?php echo $data_sptunggakan['nm_kelas'] ?></label>
								</div>
							</div>
							
							<div class="row2nd" style="padding-bottom:20px;">
								<div class="col-1" style="width:50%;">
									<label for="nama_lengkap" style="float:right;padding-right:62px;">Tahun Ajaran</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label>: <?php echo $data_sptunggakan['tahun_ajaran']; ?></label>
								</div>
							</div>
							<div class="row2nd">
								<center><a href="proses/proses_entry_sp_orangtua.php?nospt=<?php echo $no_speringatan; ?>" onclick="return confirm('Ingin Membuat Surat Panggilan?')"><button>Tambah Surat Panggilan Orangtua</button></a></center>
							</div>
						</div>
					<?php 
						}else{
							echo '<center>Data Tidak Ditemukan</center>';
							}							
					}
						?>			
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