<html>
	<head>
		<title>Halaman Siswa Kelas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../../style/istyle.css">
	</head>
	<body>
		<?php
			include  '../../koneksi/koneksi.php';
			include '../function/paginasi.php';
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
			<a href="../home.php">
					<button class="button-kembali" style="float:left;">
						<i class="fa fa-arrow-circle-left"></i> Kembali
					</button>
			</a>
			<h1>&nbsp;Data Siswa Kelas</h1>
			<hr>
			
			<!-- cari siswa -->
			<div style="margin-left:400px">
				<form action="#" method="post">
					<?php					
						$batas = 5;
						$posisi = cariPosisi($batas);
						
						$nomor = 1;
						if($_SERVER['REQUEST_METHOD'] == "POST"){
							$cari_kelas = trim(mysqli_real_escape_string($connect, $_POST['kelas']));
							$cari_tajaran = trim(mysqli_real_escape_string($connect, $_POST['th_ajaran']));
							$status = trim(mysqli_real_escape_string($connect, $_POST['status']));
							if($cari_kelas != ''){
								$sql = "SELECT s.nisn, s.nm_siswa, k.id_kelas, k.nm_kelas, s.jenis_kelamin, b.id_biayaspp, ds.tahun_ajaran, status
												FROM 	detil_siswakelas ds, 
															tb_siswa s, 
															tb_kelas k, 
															tb_biayaspp b
												WHERE k.id_kelas = ds.id_kelas
												AND s.nisn = ds.nisn
												AND b.id_biayaspp = ds.id_biayaspp
												AND k.nm_kelas ='$cari_kelas'
												AND ds.tahun_ajaran ='$cari_tajaran'
												AND status ='$status'";
								$query = $sql;
								$queryjml = $sql;
							}else{	
								$query = "SELECT s.nisn, s.nm_siswa, k.id_kelas, k.nm_kelas, s.jenis_kelamin, b.id_biayaspp, ds.tahun_ajaran, status
													FROM	detil_siswakelas ds,
																tb_siswa s,
																tb_kelas k,
																tb_biayaspp b
													WHERE	ds.nisn = s.nisn
													AND 	ds.id_biayaspp = b.id_biayaspp
													AND		ds.id_kelas = k.id_kelas													
													LIMIT $posisi, $batas";
								$queryjml = "SELECT s.nisn, s.nm_siswa, k.id_kelas, k.nm_kelas, s.jenis_kelamin, b.id_biayaspp, ds.tahun_ajaran, status
												FROM	detil_siswakelas ds,
															tb_siswa s,
															tb_kelas k,
															tb_biayaspp b
												WHERE	ds.nisn = s.nisn
												AND 	ds.id_biayaspp = b.id_biayaspp
												AND		ds.id_kelas = k.id_kelas";
								$nomor = $posisi + 1;
							}
						}else{
							$query = "SELECT s.nisn, s.nm_siswa, k.id_kelas, k.nm_kelas, s.jenis_kelamin, b.id_biayaspp, ds.tahun_ajaran, status
												FROM	detil_siswakelas ds,
															tb_siswa s,
															tb_kelas k,
															tb_biayaspp b
												WHERE	ds.nisn = s.nisn
												AND 	ds.id_biayaspp = b.id_biayaspp
												AND		ds.id_kelas = k.id_kelas
												LIMIT $posisi, $batas";
							$queryjml = "SELECT s.nisn, s.nm_siswa, k.id_kelas, k.nm_kelas, s.jenis_kelamin, b.id_biayaspp, ds.tahun_ajaran, status
											FROM	detil_siswakelas ds,
														tb_siswa s,
														tb_kelas k,
														tb_biayaspp b
											WHERE	ds.nisn = s.nisn
											AND 	ds.id_biayaspp = b.id_biayaspp
											AND		ds.id_kelas = k.id_kelas";
							$nomor = $posisi + 1;
						}
						$sql_detsiswa = mysqli_query($connect, $query) or die (mysqli_error($connect));
						
						$query_kelas 	 = mysqli_query($connect,"SELECT nm_kelas FROM tb_kelas k,
																																	detil_siswakelas ds
																															WHERE k.id_kelas = ds.id_kelas
																															GROUP BY nm_kelas
																															order by nm_kelas ASC");
						$query_tajaran = mysqli_query($connect,"SELECT tahun_ajaran FROM detil_siswakelas group by tahun_ajaran") or die(mysqli_error($connect)); 
					?>
						<label>Kelas :</label>
						<select name='kelas' style="width:100px;" required>
							<option value="">Kelas </option>
							<?php 
								while($data_kelas=mysqli_fetch_array($query_kelas)){
							?>
								<option value="<?php echo $data_kelas['nm_kelas'];?>"><?php echo $data_kelas['nm_kelas'];?></option>
							<?php } ?>
						</select>
				
						<label style="margin-left:5px;">Tahun Ajaran :</label>
						<select name='th_ajaran' style="width:120px;" required>
							<option value="">Tahun Ajaran </option>
							<?php 
								while($data=mysqli_fetch_array($query_tajaran)){
							?>
									<option value="<?php echo $data['tahun_ajaran'];?>"><?php echo $data['tahun_ajaran'];?></option>
							<?php 
							} 
							?>
						</select>
						
						<label style="margin-left:5px;">Status :</label>
						<select name='status' style="width:120px;" required>
							<option value="AKTIF">AKTIF</option>
							<option value="KELUAR">KELUAR</option>
						</select>
						<a href=""><input type="submit" value="cari" style="margin-left:5px; "></a>
				</form>
			</div>
					<?php
					if(!empty($_POST['kelas']) && $_POST['th_ajaran'] && $_POST['status']){
						?>
							<div class="column" style='width:100%;'>
								<div class="row" style="background-color:white;padding-top:0;">
									<div class="col-1" style='width:50%;'>
										<label style="float:right;padding-right:47px;">Nama Kelas</label>
									</div>
									<div class="col-2" style='width:50%;'>
										<label>: <b><?php echo $_POST['kelas']; ?></b></label>
									</div>
								</div>
					
								<div class="row" style="background-color:white;padding-top:0;">
									<div class="col-1" style='width:50%;'>
										<label style="float:right;padding-right:37px;">Tahun Ajaran </label>
									</div>
									<div class="col-2" style='width:50%;'>
										<label>: <b><?php echo $_POST['th_ajaran']; ?></b></label>
									</div>
								</div>	
								
								<div class="row" style="background-color:white;padding-top:0;">
									<div class="col-1" style='width:50%;'>
										<label style="float:right;padding-right:80px;">Status </label>
									</div>
									<div class="col-2" style='width:50%;'>
										<label>: <b><?php echo $_POST['status']; ?></b></label>
									</div>
								</div>	
							</div>
						<?php
					}
					?>
					<a href="frm_entry_detsiswa.php"><button class="button-link" style="margin-left:80px;margin-bottom:5px;"><i class="fa fa-plus-square"></i> Tambah Siswa Kelas</button></a>
					
					<table class="fixed-th" style="margin-left:100px;width:80%;">
						<thead>
							<tr>
								<th>NO</th>
								<th>NISN</th>
								<th>ID Kelas</th>
								<th>ID Biaya</th>
								<th>Tahun Ajaran</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$available = mysqli_num_rows($sql_detsiswa);
							if($available > 0){
								while($data=mysqli_fetch_array($sql_detsiswa)){
								?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td><?php echo $data['nisn']; ?></td>
										<td><?php echo $data['id_kelas']; ?></td>
										<td><?php echo $data['id_biayaspp']; ?></td>
										<td><?php echo $data['tahun_ajaran']; ?></td>
										<td><?php echo $data['status']; ?></td>
										<td>											
											<a href="frm_update_detsiswa.php?nisn=<?php echo $data['nisn']; ?>&th_ajaran=<?php echo $data['tahun_ajaran'];?>&kelas=<?php echo $data['id_kelas']; ?>&biaya=<?php echo $data['id_biayaspp']; ?>"><button class="button-abu"><i class="fa fa-pencil fa-lg"></i></button></a>
											<a href="proses/proses_delete_detsiswa.php?nisn=<?php echo $data['nisn']; ?>&th_ajaran=<?php echo $data['tahun_ajaran'];?>" onclick="return confirm('Menghapus Siswa Kelas berarti juga menghapus Histori Pembayaran siswa tersebut, anda yakin ?')"><button class="button-merah"><i class="fa fa-trash fa-lg"></i></button></a>
										</td>
									</tr>
							<?php
								}
							}else{
								echo "<tr><td colspan='8'> Data tidak ditemukan! </td></tr>";
							}
							?>
						</tbody>
					</table>
						<?php
							if(!empty($_POST['kelas']) && !empty($_POST['th_ajaran'])){				
								$jml= mysqli_num_rows(mysqli_query($connect, $queryjml));
								echo "<p style='padding-left:10%;'>Data Pencarian : $jml</p>";
							}else{
								$jml = mysqli_num_rows(mysqli_query($connect, $queryjml));
								echo "<p style='padding-left:10%;'>Jumlah Pencarian : $jml</p>";
								?>
								<div class='paginasi-bar'>
								<div class="paginasi">
									<?php
											// paginasi
											$jml_halaman = jmlHalaman($jml,$batas);
											$link = linkHal(@$_GET['halaman'],$jml_halaman);
											echo $link;					
									?>
								</div>
							<?php 
							}
							?>
				</div>
				</br>
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