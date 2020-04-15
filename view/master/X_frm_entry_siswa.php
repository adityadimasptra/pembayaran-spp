<html>
	<head>
	<title>Halaman Entry Siswa</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../style/istyle.css">
	<script ></script>
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
			/*$sekarang = date("ym");
			$carikode = mysqli_query($connect, "SELECT MAX(id_siswa) as lastkode FROM tb_siswa WHERE id_siswa LIKE '$sekarang%'") or die (mysql_error());
			// menjadikannya array
			$datakode = mysqli_fetch_array($carikode);
			$lastkode = $datakode['lastkode'];
			$nilaikode = substr($lastkode, 4, 6);
			$nextkode = $nilaikode + 1;
			$auto_idsiswa = $sekarang.sprintf('%06s',$nextkode);
			*/
		?>
		<div class="main">
			<a href="frm_siswa.php?halaman=1">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
			</a>
			<h1>&nbsp;Entry Siswa</h1>
			<hr>
			<div class="container" style="background-color:;">
				<form method="post" action="proses/proses_entry_siswa.php" >
<!-- ---------------------------------------------------------------------FORM SISWA------------------------------------------------- -->					
						<div class="column" style="width:50%">	
										
							<div class="row">
								<div class="col-1">
									<label for="kd_pelanggan">NISN Siswa</label>
								</div>
								<div class="col-2">
									<input type="text" maxlength="10" name="nisn_siswa" title="Gunakan Angka 12 Digit" pattern="^\d{10}$" required>
								</div>
							</div>
					
							<div class="row">
								<div class="col-1">
									<label for="nama_lengkap">Nama Siswa</label>
								</div>
								<div class="col-2">
									<input type="text" name="nama_siswa" maxlength="50" title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+" required>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label for="kota">Jenis Kelamin</label>
								</div>
								<div class="col-2">
									<select name="jenkel">
										<option value="">--Pilih--</option>
										<option value="Laki-Laki">Laki-Laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label for="nama_lengkap">Tempat Lahir</label>
								</div>
								<div class="col-2">
									<input type="text" name="tempat_lahir" maxlength="30"  placeholder="Masukan tempat Lahir..." required>
								</div>
							</div>

							<div class="row">
								<div class="col-1">
									<label for="tgl_lahir">Tanggal Lahir</label>
								</div>
								<div class="col-2">
									<input type="date" name="tgl_lahir_siswa" required>
								</div>
							</div>

							<div class="row">
								<div class="col-1">
									<label>Agama</label>
								</div>
								<div class="col-2">
									<select name="agama" required>
										<option value="">--Pilih--</option>
										<option value="Islam">Islam</option>
										<option value="Kristen">Kristen</option>
										<option value="Hindu">Hindu</option>
										<option value="Budha">Budha</option>
										<option value="Lainnya">Lainnya</option>
									</select>
								</div>
							</div>
													
							<div class="row">
								<div class="col-1">
									<label>Alamat</label>
								</div>
								<div class="col-2">
									<textarea name="alamat_siswa" placeholder="Masukan alamat lengkap..." style="height:100px;	" maxlength="80"  title="Gunakan Alamat yang Benar" required></textarea>
								</div>
							</div>
							
							<div class="row" style="padding-bottom:10px;">
								<div class="col-1">
									<label>No Telp</label>
								</div>
								<div class="col-2">
									<input type="text" name="telp_siswa" maxlength="12" title="12 Digit Nomor Telepon" pattern="^\d{12}$" required>
								</div>
							</div>	

						</div>   
<!-- ---------------------------------------------------------------------FORM orangtua------------------------------------------------- -->			
						<div class="column" style="width:50%">
							
							<div class="row">
								<div class="col-1">
									<label>Nama Orangtua</label>
								</div>
								<div class="col-2">
									<input type="text" name="nama_orangtua" maxlength="50"  title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+" required>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Tanggal Lahir</label>
								</div>
								<div class="col-2">
									<input type="date" name="tgl_lahir_orangtua" required>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">	
									<label>Pekerjaan</label>
								</div>
								<div class="col-2">
									<input type="text" name="pekerjaan" maxlength="20"  title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+" required>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Alamat Kantor</label>
								</div>
								<div class="col-2">
									<textarea name="alamat_kantor" placeholder="Masukan alamat lengkap..." style="height:100px;" maxlength="80"  title="Gunakan Alamat yang Benar" required></textarea>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Penghasilan</label>
								</div>
								<div class="col-2">
									<select name="penghasilan">
										<option value="">--Pilih--</option>
										<option value="< 1.000.000">< 1.000.000</option>
										<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
										<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
										<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
										<option value="> 7.000.000">> 7.000.000</option>
									</select>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Alamat</label>
								</div>
								<div class="col-2">
									<textarea name="alamat_orangtua" placeholder="Masukan alamat lengkap..." style="height:100px;" maxlength="80"  title="Gunakan Alamat yang Benar" required></textarea>
								</div>
							</div>

							<div class="row" style="padding-bottom:10px;margin-bottom:10px;">
								<div class="col-1">
									<label>No Telp</label>
								</div>
								<div class="col-2">
									<input type="text" name="telp_orangtua" maxlength="12" title="12 Digit Nomor Telepon" pattern="^\d{12}$" required>
								</div>
							</div>	
															
							<input type="submit" style="float:right;" value="Simpan Data">
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