<html>
	<head>
		<title>Halaman Laporan Tunggakan SPP</title>
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
			$timeout = 10; // Set timeout menit
			$logout_redirect_url = "../../index.php"; // Set logout URL

			$timeout = $timeout * 60; // Ubah menit ke detik
			if (isset($_SESSION['start_time'])) {
				$elapsed_time = time() - $_SESSION['start_time'];
				if ($elapsed_time >= $timeout) {
						session_destroy();
						echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
				}
		}
		$_SESSION['start_time'] = time();
		?>

		<div class="sidenav">
			<div class="fakeimg"><img src="../../images/favicon.jpg" style="width:100%;border-radius:50%;"></div>	
			<br>
			<a href="../home.php"><i class="fa fa-home"></i>&nbsp Home</a>
			<button class="dropdown-btn"><i class="fa fa-tags"> </i>&nbsp Master
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-container">
				<a href="../master/frm_siswa.php?halaman=1"><i class="fa fa-child fa-lg"></i>&nbsp Entry Siswa</a>
				<a href="../master/frm_kelas.php?halaman=1"><i class="fa fa-graduation-cap"></i>&nbspEntry Kelas</a>
				<a href="../master/frm_biaya_spp.php?halaman=1"><i class="fa fa-money"></i>&nbsp Entry Biaya SPP</a>
				<a href="#"></a>
			</div>
			<button class="dropdown-btn"><i class="fa fa-files-o"></i>&nbsp Transaksi
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-container">
				<a href="../transaksi/frm_detsiswa.php?halaman=1"><i class="	fa fa-group"></i>&nbsp Entry Siswa Kelas</a>
				<a href="../transaksi/frm_pembayaran_spp.php?halaman=1"><i class="fa fa-book"></i>&nbsp Entry Pembayaran SPP</a>
				<a href="#"><i class="fa fa-print"></i>&nbsp Cetak Bukti Pembayaran SPP</a>
				<a href="#"><i class="fa fa-print"></i>&nbsp Cetak Surat Peringatan</a>
				<a href="#"><i class="fa fa-print"></i>&nbsp Cetak Surat Panggilan</a>
				<a href="#"></a>
			</div>
			<button class="dropdown-btn"><i class="fa fa-file-text"></i>&nbsp Laporan 
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-container">
				<a href="laporan_pembayaran_spp.php"><i class="fa fa-file"></i>&nbsp Pembayaran SPP</a>
				<a href="laporan_tunggakan_spp.php"><i class="fa fa-file"></i>&nbsp Tunggakan SPP</a>
				<a href="#"><i class="fa fa-file"></i>&nbsp Surat Panggilan Orangtua</a>
			</div>
		</div>
		<div class="duduy" style="width:100%;padding:5px;background-color:; float:right; text-align:right;">
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
			<h1>&nbsp;Laporan Tunggakan SPP</h1>
			<hr>
				<div class="container">
					
						<div class="row">
							<div class="column" style="width:100%">
							<?php 
								include '../../koneksi/koneksi.php';
								include '../function/format.php'; 
								
								$query_kelas 	 = mysqli_query($connect,"SELECT ds.id_kelas, nm_kelas FROM tb_kelas k,
																																			detil_siswakelas ds
																																 WHERE k.id_kelas = ds.id_kelas
																																 GROUP BY ds.id_kelas, nm_kelas
																																 ORDER BY nm_kelas ASC");
								$query_tajaran = mysqli_query($connect,"SELECT tahun_ajaran FROM detil_siswakelas group by tahun_ajaran");
							?>
							<form method="POST" action="" >					
								<div class="row">
									<div class="col-1" style="width:15%;">
										<label>Kelas </label>
									</div>
									<div class="col-2" style="width:20%;">
										<select name='kelas' style="width:120px;" >
											<option value="">Kelas </option>
											<?php 
												while($data_kelas=mysqli_fetch_array($query_kelas)){
											?>
												<option value="<?php echo $data_kelas['id_kelas'];?>"><?php echo $data_kelas['id_kelas'].' - '.$data_kelas['nm_kelas'];?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="row">
									<div class="col-1" style="width:15%;">
										<label>Tahun Ajaran</label>
									</div>
									<div class="col-2" style="width:20%;">
										<select name='th_ajaran' style="width:120px;" >
											<option value="">Tahun Ajaran </option>
											<?php 
												while($data_tajaran=mysqli_fetch_array($query_tajaran)){
											?>
													<option value="<?php echo $data_tajaran['tahun_ajaran'];?>"><?php echo $data_tajaran['tahun_ajaran'];?></option>
											<?php 
											} 
											?>
										</select>
										<input type="submit" style="float:;" value="Cari">	
									</div>
								</div>	
							</form>
							
							<!-- TAMPIL DATA PEMBAYARAN SPP -->
							<?php 
							if(isset($_POST['kelas']) && $_POST['th_ajaran']!=''){
								$tgl_sekarang = date('Y-m-d');
								//$tgl_sekarang = date('2018-12-10');
								$lap_tunggakan = mysqli_query($connect,"SELECT p.id_siswa as siswa, nm_siswa, p.id_kelas as kelas,  bulan, jatuh_tempo, biaya_spp 
																												FROM 
																													tb_pembayaranspp p,
																													detil_siswakelas ds,
																													tb_biayaspp b,
																													tb_kelas k,
																													tb_siswa s
																												WHERE p.id_siswa = ds.id_siswa
																													AND ds.id_biayaspp = b.id_biayaspp
																													AND ds.id_siswa = s.id_siswa
																													AND ds.id_kelas = k.id_kelas
																															
																													AND jatuh_tempo < '$tgl_sekarang'
																													AND tgl_pemspp is null
																													AND k.id_kelas = '$_POST[kelas]' 
																													AND tahun_ajaran = '$_POST[th_ajaran]' 	") or die (mysqli_error($connect));
								$available = mysqli_num_rows($lap_tunggakan);
								//$id_siswa = $data_siswa['id_siswa'];
								if($available > 0 ){
								?>
								<hr>
								<center><h3></h3></center>
							</div>
							
							<div class="column" style="width:100%;margin:0px;:;background-color:;">
							<hr>
								<center><h3>Tagihan Pembayaran SPP</h3></center>
									<table class="fixed-th" style="margin-left:10px;width:98%;">
										<thead>
											<tr>
												<th><center>No</center></th>				
												<th>ID Siswa</th>
												<th>Nama Siswa</th>
												<th>ID Kelas</th>		
												<th>Bulan</th>
												<th>Jatuh Tempo</th>
												<th>Biaya SPP</th>
											</tr>
										</thead>
										<tbody>
										<?php
										// query lap pembayaran spp 
										$no = 0;
										while($data = mysqli_fetch_array($lap_tunggakan)){
											$no++;									
										?>
													<tr>
														<td><center><?php echo $no;?></center></td>
														<td><center><?php echo $data['siswa'];?></center></td>												
														<td><center><?php echo $data['nm_siswa'];?></center></td>		
														<td><center><?php echo $data['kelas']; ?></center></td>
														<td><center><?php echo $data['bulan'];?></center></td>
														<td><center><?php echo tanggal($data['jatuh_tempo']); ?></center></td>
														<td><center><?php echo rupiah($data['biaya_spp']); ?></center></td>
														</tr>
										<?php 
										}
										
										$query_total = mysqli_query($connect,"SELECT sum(biaya_spp) as total 	
																													FROM 
																															tb_pembayaranspp p,
																															detil_siswakelas ds,
																															tb_biayaspp b,
																															tb_kelas k
																													WHERE p.id_siswa = ds.id_siswa
																															AND ds.id_biayaspp = b.id_biayaspp
																															AND ds.id_kelas = k.id_kelas
																															
																															AND jatuh_tempo < '$tgl_sekarang'
																															AND tgl_pemspp is null
																															AND k.id_kelas = '$_POST[kelas]' 
																															AND tahun_ajaran ='$_POST[th_ajaran]'")
																															or die (mysqli_error($connect));
										$total = mysqli_fetch_array($query_total);
										/*echo $_POST['kelas'];
										echo "<Br> ";
										echo $_POST['th_ajaran'];*/
										?>
										
										<tr>
											<td colspan="6">Total Tunggakan</td>	
											<td><?php echo rupiah($total['total']); ?></td>
										</tr>
										<tr>
											<td colspan="7"><button style="margin-left:5%" onClick="print_d()"><i class="fa fa-print"></i> Cetak</button></td>	
										</tr>
										<tr>
											<td colspan="7" style="text-align:left;"><p style="color:red;">*Jatuh Tempo Pembayaran SPP setiap tanggal <b>10</b> setiap bulannya</p></a></td>
										</tr>
									</tbody>
								</table>
							</div>
								<?php
									}else{
											echo '<center>Tidak ada Tunggakan SPP</center>';
									}						
								}
								?>	
							
					</div>
				</div>
			</div>
		<script>
			function print_d(){
				window.open("cetak_pembayaran_spp.php?id_siswa=<?php echo $id_siswa;?>","_blank");
			}
		</script>
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