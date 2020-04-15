<html>
	<head>
		<title>Halaman Tambah Siswa Kelas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../../style/istyle.css">
	</head>
	<body>
	<?php
		include  '../../koneksi/koneksi.php';
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
			<h1>&nbsp;Tambah Siswa Kelas</h1>
			<hr>
			<div class="container">
				<form method="post" action="proses/proses_entry_detsiswa.php" >
				<?php
					$query_kelas 	 = mysqli_query($connect,"SELECT * FROM tb_kelas ORDER BY nm_kelas ASC");
					$query_angkatan = mysqli_query($connect,"SELECT * FROM tb_biayaspp ORDER BY id_biayaspp ASC");
				?>
						<div class="column">					
							<div class="row" style="padding-right:20px;">
								<div class="col-1" style="width:30%;">
									<label>Kelas</label>
								</div>
								<div class="col-2" style="width:70%;">
									<select name='kelas' style="width:100px;" required>
										<option value="">Kelas </option>
										<?php 
											while($data=mysqli_fetch_array($query_kelas)){
										?>
											<option value="<?php echo $data['id_kelas'];?>"><?php echo $data['nm_kelas'];?></option>
										<?php } ?>
									</select>
									
								</div>
							</div>
							
							<div class="row" style="padding-right:20px;">
								<div class="col-1" style="width:30%;">
									<label>Tahun Ajaran</label>
								</div>
								<div class="col-2" style="width:70%;">
									<select name="th_ajaran" required>
										<option value="">Pilih Tahun Ajaran</option>
										<?php
										$thn_skr = date('Y');
										$x = $thn_skr - 2;
										$th_sblm = $x - 1;
										while($x <= $thn_skr + 4){
											$tajaran = $th_sblm.'/'.$x;	
												?>
													<option value="<?php echo $tajaran; ?>"><?php echo $tajaran; ?></option>
												<?php
											$x++;
											$th_sblm++;
										}
										?>           
									</select>			
								</div>
							</div>
							
							<div class="row" style="padding-right:20px;">
								<div class="col-1" style="width:30%;">
									<label>Angkatan</label>
								</div>
								<div class="col-2" style="width:70%;">
									<select name="id_biayaspp" required>
										<option value="">Pilih Angkatan</option>
										<?php
											while($data=mysqli_fetch_array($query_angkatan)){
												$data['angkatan'];
											?>
												<option value="<?php echo $data['id_biayaspp']; ?>"><?php echo $data['id_biayaspp'].' | '.$data['angkatan']; ?></option>
											<?php	
											}
										?>           
									</select>			
								</div>
							</div>
					
							<div class="row" style="padding-right:20px;">
								<div class="col-1" style="width:30%;">
									<label>NISN</label>
								</div>
								<div class="col-2" style="width:70%;">
									<input type="text" name="nisn" maxlength="12" placeholder="Masukan NISN" title="Gunakan Angka" pattern="[0-9]+" required>
								</div>
								
							</div>
							<div class="row" style="padding-bottom:20px;padding-right:20px;">
								<input type="submit" style="float:right;" value="Simpan Data">
							</div>
						</div>	
				</form>
			</div>
			<p>Catatan:</p>
			<p style="color:red;">&nbsp;&nbsp;&nbsp;*Tagihan Pembayaran SPP akan di buat Ketika Menginput Data Siswa Kelas, Terimakasih.</p>			
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