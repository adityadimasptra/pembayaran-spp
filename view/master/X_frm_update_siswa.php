<html>
	<head>
		<title>Halaman Update Siswa</title>
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
			<a href="frm_siswa.php?halaman=1">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
			</a>
			<h1>&nbspUpdate Siswa</h1>
			<hr>
			<div class="container" style="background-color:white;">
			<?php
				$nisn = $_GET['nisn'];
				$data = mysqli_query($connect,"SELECT * FROM tb_siswa WHERE nisn='$nisn'");
				while($row = mysqli_fetch_array($data)){
			?>
				<form method="post" action="proses/proses_update_siswa.php" >  
					<div style="background-color:#999999; color:white; border-radius:20px; width:400px; padding-left:20px">
							<h2><i class="fa fa-user"> &nbsp;<?php echo $row['nm_siswa']; ?></i></h2>
					</div>
						<div class="column" style="width:50%">	
												
							<div class="row">
								<div class="col-1">
									<label for="kd_pelanggan">NISN Siswa</label>
								</div>
								<div class="col-2">
									<input type="text" maxlength="10" name="nisn_siswa" value="<?php echo $row['nisn']; ?>" readonly>
								</div>
							</div>
					
							<div class="row">
								<div class="col-1">
									<label for="nama_lengkap">Nama Siswa</label>
								</div>
								<div class="col-2">
									<input type="text" name="nama_siswa" maxlength="50" title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+"  value="<?php echo $row['nm_siswa']; ?>"required>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label for="kota">Jenis Kelamin</label>
								</div>
								<div class="col-2">
									<select name="jenkel">
										<?php 
											if($row['jenis_kelamin']=='LAKI-LAKI'){
											?>
												<option value="Laki-Laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											<?php
											}else if($row['jenis_kelamin']=='PEREMPUAN'){
											?>
												<option value="Perempuan">Perempuan</option>
												<option value="Laki-Laki">Laki-Laki</option>
											<?php
											}
										?>
									</select>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label for="nama_lengkap">Tempat Lahir</label>
								</div>
								<div class="col-2">
									<input type="text" name="tempat_lahir" maxlength="30" placeholder="Masukan tempat Lahir..." value="<?php echo $row['tempat_lahir']; ?>" required>
								</div>
							</div>

							<div class="row">
								<div class="col-1">
									<label for="tgl_lahir">Tanggal Lahir</label>
								</div>
								<div class="col-2">
									<input type="date" name="tgl_lahir_siswa" value="<?php echo $row['tgl_lahir_siswa']; ?>" required>
								</div>
							</div>

							<div class="row">
								<div class="col-1">
									<label>Agama</label>
								</div>
								<div class="col-2">
									<select name="agama" required>
									<?php 
										if($row['agama']=='ISLAM'){
									?>
											<option value="Islam">Islam</option>
											<option value="Kristen">Kristen</option>
											<option value="Hindu">Hindu</option>
											<option value="Budha">Budha</option>
											<option value="Lainnya">Lainnya</option>
										<?php
										}else if($row['agama']=='KRISTEN'){
										?>
											<option value="Kristen">Kristen</option>
											<option value="Islam">Islam</option>
											<option value="Hindu">Hindu</option>
											<option value="Budha">Budha</option>
											<option value="Lainnya">Lainnya</option>
									<?php
										}else if($row['agama']=='HINDU'){
										?>
											<option value="Hindu">Hindu</option>
											<option value="Islam">Islam</option>
											<option value="Kristen">Kristen</option>
											<option value="Budha">Budha</option>
											<option value="Lainnya">Lainnya</option>
										<?php
										}else if($row['agama']=='BUDHA'){
										?>
											<option value="Budha">Budha</option>
											<option value="Islam">Islam</option>
											<option value="Kristen">Kristen</option>
											<option value="Hindu">Hindu</option>
											<option value="Lainnya">Lainnya</option>
										<?php
										}else if($row['agama']=='LAINNYA'){
											?>
											<option value="Lainnya">Lainnya</option>
											<option value="Islam">Islam</option>
											<option value="Kristen">Kristen</option>
											<option value="Hindu">Hindu</option>
											<option value="Budha">Budha</option>
											<?php
										}
									?>
									</select>
								</div>
							</div>
														
							<div class="row">
								<div class="col-1">
									<label>Alamat Siswa</label>
								</div>
								<div class="col-2">
									<textarea name="alamat_siswa" placeholder="Masukan alamat lengkap..." style="height:100px;text-transform:uppercase" maxlength="80" required><?php echo $row['alamat_siswa']; ?>
									</textarea>
								</div>
							</div>
							
							<div class="row" style="padding-bottom:20px;">
								<div class="col-1">
									<label>Telp Siswa</label>
								</div>
								<div class="col-2">
									<input type="text" name="telp_siswa" maxlength="12" pattern="^\d{12}$" title="12 Digit Nomor Telepon" value="<?php echo $row['telp_siswa']; ?>" required>
								</div>
							</div>	

						</div>   
			
						<div class="column" style="width:50%">
							
							<div class="row">
								<div class="col-1">
									<label>Nama Orangtua</label>
								</div>
								<div class="col-2">
									<input type="text" name="nama_orangtua" maxlength="50"  title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+" value="<?php echo $row['nm_orangtua']; ?>" required>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Tanggal Lahir</label>
								</div>
								<div class="col-2">
									<input type="date" name="tgl_lahir_orangtua" value="<?php echo $row['tgl_lahir_orangtua'];?>" required>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Pekerjaan</label>
								</div>
								<div class="col-2">
									<input type="text" name="pekerjaan" maxlength="20"  title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+" value="<?php echo $row['pekerjaan']; ?>" required>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Alamat Kantor</label>
								</div>
								<div class="col-2">
									<textarea name="alamat_kantor" placeholder="Masukan alamat lengkap..." style="height:100px;text-transform:uppercase" maxlength="80"   required><?php echo $row['alamat_kantor']; ?></textarea>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Penghasilan</label>
								</div>
								<div class="col-2">
									<select name="penghasilan">
									<?php 
										if($row['penghasilan']=='< 1.000.000'){
										?>
											<option value="< 1.000.000">< 1.000.000</option>
											<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
											<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
											<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
											<option value="> 7.000.000">> 7.000.000</option>
										<?php 
										}else if($row['penghasilan']=='1.000.000-3.000.000'){
										?>
											<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
											<option value="< 1.000.000">< 1.000.000</option>
											<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
											<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
											<option value="> 7.000.000">> 7.000.000</option>
										<?php
										}else if($row['penghasilan']=='3.000.000-5.000.000'){
										?>
											<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
											<option value="< 1.000.000">< 1.000.000</option>
											<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
											<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
											<option value="> 7.000.000">> 7.000.000</option>
										<?php
										}else if($row['penghasilan']=='5.000.000-7.000.000'){
										?>
											<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
											<option value="< 1.000.000">< 1.000.000</option>
											<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
											<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
											<option value="> 7.000.000">> 7.000.000</option>
										<?php
										}else if($row['penghasilan']=='> 7.000.000'){
										?>
											<option value="> 7.000.000">> 7.000.000</option>
											<option value="< 1.000.000">< 1.000.000</option>
											<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
											<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
											<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
										<?php
										}else if($row['penghasilan']==''){
										?>
											<option value="< 1.000.000">< 1.000.000</option>
											<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
											<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
											<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
											<option value="> 7.000.000">> 7.000.000</option>
										<?php
										}
									?>
									</select>
								</div>
							</div>
							
							<div class="row">
								<div class="col-1">
									<label>Alamat Orangtua</label>
								</div>
								<div class="col-2">
									<textarea name="alamat_orangtua" placeholder="Masukan alamat lengkap..." style="height:100px;" maxlength="80" required><?php echo $row['alamat_orangtua']; ?></textarea>
								</div>
							</div>

							<div class="row" style="margin-bottom:10px;padding-bottom:10px;">
								<div class="col-1">
									<label>Telp Orangtua</label>
								</div>
								<div class="col-2">
									<input type="text" name="telp_orangtua" maxlength="12" pattern="^\d{12}$" title="12 Digit Nomor Telepon" value="<?php echo $row['telp_orangtua']; ?>" required>
								</div>
							</div>	
															
							<input type="submit" style="float:right;" value="Simpan Data">
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