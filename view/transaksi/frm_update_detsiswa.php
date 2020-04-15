<html>
	<head>
		<title>Halaman Ubah Siswa Kelas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../../style/istyle.css">
	</head>
	<body>
		<?php
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
			<a href="frm_detsiswa.php?halaman=1">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
			</a>
			<h1>&nbsp; Ubah Siswa Kelas</h1>
			<hr>
			<div class="container" style="background-color:white;">
			<?php
				$nisn = $_GET['nisn'];
				$tahun_ajaran = $_GET['th_ajaran'];
				$id_kelas	= $_GET['kelas'];
				$id_biayaspp = $_GET['biaya'];
				$query_kelas = mysqli_query($connect,"SELECT * FROM tb_kelas ORDER BY nm_kelas ASC");
				$query_biaya = mysqli_query($connect,"SELECT * FROM tb_biayaspp ORDER BY biaya_spp ASC");
				$query_detsiswa = mysqli_query($connect,"SELECT * 
																								FROM 
																									detil_siswakelas ds, tb_siswa s, tb_kelas k, tb_biayaspp b 
																								WHERE 
																									ds.nisn = s.nisn
																								AND ds.id_kelas = k.id_kelas
																								AND ds.id_biayaspp = b.id_biayaspp
																								AND	ds.nisn='$nisn'
																								AND tahun_ajaran='$tahun_ajaran'
																								AND ds.id_kelas ='$id_kelas'
																								AND ds.id_biayaspp ='$id_biayaspp'");
				while($row = mysqli_fetch_array($query_detsiswa)){
			?>
				<form method="POST" action="proses/proses_update_detsiswa.php" >
					<div style="background-color:#999999; color:white; border-radius:20px; width:400px; padding-left:20px">
							<h2><i class="fa fa-user"> &nbsp;<?php echo $row['nm_siswa']; ?></i></h2>
					</div>
						<div class="column" style="width:50%">	
												
							<div class="row">
								<div class="col-1">
									<label>NISN Siswa</label>
								</div>
								<div class="col-2">
									<input type="text" maxlength="10" name="nisn" value="<?php echo $row['nisn']; ?>" readonly>
								</div>
							</div>
					
							<div class="row">
								<div class="col-1">
									<label>Nama Siswa</label>
								</div>
								<div class="col-2">
									<input type="text" name="nama_siswa" maxlength="50" value="<?php echo $row['nm_siswa']; ?>" readonly>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Kelas</label>
								</div>
								<div class="col-2">
									<?php //$nm_kelas = mysqli_fetch_array(mysqli_query($connect,"SELECT nm_kelas FROM tb_kelas WHERE id_kelas ='$id_kelas'")); ?>
									<input type="text" name="kelas" value="<?php echo $id_kelas; ?>" readonly>
								</div>
							</div>

							<div class="row">
								<div class="col-1">
									<label>Biaya SPP</label>
								</div>
								<div class="col-2">
									<?php //$nm_angkatan = mysqli_fetch_array(mysqli_query($connect,"SELECT angkatan FROM tb_biayaspp WHERE id_biayaspp ='$id_biayaspp'")); ?>
									<input type="text" name="id_biayaspp" value="<?php echo $id_biayaspp; ?>" readonly>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Tahun Ajaran</label>
								</div>
								<div class="col-2">
									<input type="text" name="th_ajaran" value="<?php echo $tahun_ajaran; ?>" readonly>
									
								</div>
											
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Status</label>
								</div>
								<div class="col-2">
									<select name="status" required>
										<?php if($row['status']=='AKTIF'){?>
											<option value="AKTIF">AKTIF</option>
											<option value="KELUAR">KELUAR</option>
										<?php	}else if($row['status']=='KELUAR'){?>
											<option value="KELUAR">KELUAR</option>
											<option value="AKTIF">AKTIF</option>
										<?php } ?>
									</select>
								</div>
								<input type="submit" style="float:right;" value="Ubah Data">
							</div>
											
							
						</div>   
					</form>
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