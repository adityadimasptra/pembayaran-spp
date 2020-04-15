<html>
	<head>
		<title>Cetak Kartu SPP</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../style/istyle.css">
	</head>
	<body>
	<?php 
			include '../../koneksi/koneksi.php';
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
			<h1>&nbsp;Cetak Kartu SPP</h1>
			<hr>
			
			<!-- cari siswa -->
				<?php								
					$nomor = 1;
					$thn_depan		= date('Y')+1;
					$tajaran = date('Y').'/'.$thn_depan;
					if($_SERVER['REQUEST_METHOD'] == "POST"){
						$cari_siswa = trim(mysqli_real_escape_string($connect, $_POST['cari']));
						if($cari_siswa != ''){
							$sql = "SELECT s.nisn, s.nm_siswa, k.id_kelas, k.nm_kelas, s.jenis_kelamin, b.id_biayaspp, ds.tahun_ajaran, status
											FROM 	detil_siswakelas ds, 
														tb_siswa s, 
														tb_kelas k, 
														tb_biayaspp b
											WHERE k.id_kelas = ds.id_kelas
											AND s.nisn = ds.nisn
											AND b.id_biayaspp = ds.id_biayaspp
											AND s.nm_siswa LIKE '%$cari_siswa%'
											AND tahun_ajaran = '$tajaran'
											AND status ='AKTIF'
											ORDER BY tahun_ajaran desc";
							$query = $sql;
							
						}else{
							$sql = "SELECT s.nisn, s.nm_siswa, k.id_kelas, k.nm_kelas, s.jenis_kelamin, b.id_biayaspp, ds.tahun_ajaran, status
											FROM 	detil_siswakelas ds, 
														tb_siswa s, 
														tb_kelas k, 
														tb_biayaspp b
											WHERE k.id_kelas = ds.id_kelas
											AND s.nisn = ds.nisn
											AND b.id_biayaspp = ds.id_biayaspp
											AND tahun_ajaran = '$tajaran'
											AND status ='AKTIF'
											ORDER BY tahun_ajaran desc";
							$query = $sql;
						}						
					}else{
						$sql = "SELECT s.nisn, s.nm_siswa, k.id_kelas, k.nm_kelas, s.jenis_kelamin, b.id_biayaspp, ds.tahun_ajaran, status
											FROM 	detil_siswakelas ds, 
														tb_siswa s, 
														tb_kelas k, 
														tb_biayaspp b
											WHERE k.id_kelas = ds.id_kelas
											AND s.nisn = ds.nisn
											AND b.id_biayaspp = ds.id_biayaspp
											AND tahun_ajaran = '$tajaran'
											AND status ='AKTIF'
											ORDER BY tahun_ajaran desc";
							$query = $sql;
					}
					$sql_detsiswa = mysqli_query($connect, $query) or die (mysqli_error($connect));					
				?>
				<form action="" method="post">
				<div style="padding-left:400px;">
					<div class="col-1" style="width:30%">
						<center><input type="text" name="cari" placeholder="Cari Siswa..."></center>
					</div>
					<div class="col-2" style="width:70%">
						<a href="#"><input type="submit" value="Cari" style="margin-left:5px; "></a>
					</div>
				</div>
				</form>
				<div style="margin-top:70px;">
				<table class="fixed-th" style="margin-left:100px;margin-top:10px;width:80%;">
					<thead>
						<tr>
							<th>NO</th>
							<th>NISN</th>
							<th>Nama Siswa</th>
							<th>Kelas</th>
							<th>Tahun Ajaran</th>
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
												<td><?php echo $data['nm_siswa']; ?></td>
												<td><?php echo $data['nm_kelas']; ?></td>
												<td><?php echo $data['tahun_ajaran']; ?></td>
												<td>											
													<a href="cetak_kartu_spp.php?nisn=<?php echo $data['nisn']; ?>&th_ajaran=<?php echo $data['tahun_ajaran'];?>&kelas=<?php echo $data['nm_kelas']; ?>" target="_BLANK"><button class="button-abu"><i class="fa fa-print fa-lg"></i></button></a>
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
								if(!empty($_POST['cari'])){?>
											<h4><center>Hasil Pencarian : <i><?php echo $_POST['cari']; ?></i></center></h4>
							<?php }?>							
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
