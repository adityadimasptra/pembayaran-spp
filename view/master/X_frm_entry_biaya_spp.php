<html>
	<head>
		<title>Halaman Entry Biaya SPP</title>
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
			$carikode = mysqli_query($connect, "SELECT MAX(id_biayaspp) FROM tb_biayaspp") or die (mysql_error());
			// menjadikannya array
			$datakode = mysqli_fetch_array($carikode);
			
				// jika $datakode
			if ($datakode) {
				$nilaikode = substr($datakode[0], 1);
				// menjadikan $nilaikode ( int )
				$kode = (int) $nilaikode;
				// setiap $kode di tambah 1
				$kode = $kode + 1;
				$kode_otomatis = "B".str_pad($kode, 4, "0", STR_PAD_LEFT);
			} else {
				$kode_otomatis = "B0001";
			}
		?>
		<div class="main">
		<a href="frm_biaya_spp.php?halaman=1">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
		</a>
				<h1>&nbsp;Entry Biaya SPP</h1>
				<hr>
				<div class="container">
					<form method="post" action="proses/proses_entry_biaya_spp.php" >  
						<div class="column">
							<div class="row" style="padding-right:20px;">
								<div class="col-1" style="width:30%;">
									<label>ID Biaya SPP</label>
								</div>
								<div class="col-2">
									<input type="text" maxlength="5" name="id_biayaspp" value="<?php echo "$kode_otomatis"; ?>" readonly>
								</div>
							</div>
					
							<div class="row" style="padding-right:20px;">
								<div class="col-1" style="width:30%;">
									<label>Angkatan</label>
								</div>
								<div class="col-2">
									<select name="angkatan" required>
										<option value="">Pilih Angkatan</option>
										<?php
										$thn_skr = date('Y');
										$batas = 3;
										$x = $thn_skr - $batas;
										while($x <= $thn_skr + $batas){
											$angkatan = $x;	
											$c = mysqli_query($connect,"SELECT * FROM tb_biayaspp WHERE angkatan='$angkatan'");
											$d = mysqli_num_rows($c);
											if($d > 0){
											}else{
												?>
													<option value="<?php echo $angkatan; ?>"><?php echo $angkatan; ?></option>
												<?php
											}
											$x++;
										}
										?>           
									</select>						
								</div>
							</div>
							<?php 
							?>
							<div class="row" style="padding-right:20px;">
								<div class="col-1" style="width:30%;">
									<label for="nama_lengkap">Biaya SPP</label>
								</div>
								<div class="col-2">
									<input type="text" maxlength="12" name="biaya_spp" title=""  required>
								</div>
							</div>
							<div class="row" style="padding-right:20px;padding-bottom:20px;">
								<input type="submit" value="Simpan Data" style="float:right;">
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
