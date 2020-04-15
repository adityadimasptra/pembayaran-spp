<html>
	<head>
		<title>Halaman Laporan Surat Panggilan Orangtua</title>
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
			<a href="../home.php">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
			</a>
			<h1>&nbsp;Laporan Surat Panggilan Orangtua</h1>
			<hr>
			<div class="container">
						<div class="column" style="width:100%">
							<form method="POST" action="" >					
								<div class="row2nd" style="padding-right:20px;">
									<div class="col-1"style="width:40%;">
										<label style="float:right; padding-right:38px;">Dari Periode</label>
									</div>
									<div class="col-2" style="width:50%;">				
										<input type="date" name="dari_periode" style="width:50%;" required>
									</div>
								</div>

								<div class="row2nd" style="padding-right:20px;">
									<div class="col-1" style="width:40%;">
										<label style="float:right; padding-right:20px;">Hingga periode</label>
									</div>
									<div class="col-2" style="width:50%;">				
										<input type="date" name="hingga_periode" style="width:50%;" required>
										<input type="submit" style="" value="Cari">	
									</div>
								</div>
							</form>
						</div>
					
						<!-- TAMPIL DATA PEMBAYARAN SPP -->
						<?php 						
							if(isset($_POST['dari_periode']) && $_POST['hingga_periode']!=''){
								//deklarasi variable
								$dari_periode = $_POST['dari_periode'];
								$hingga_periode = $_POST['hingga_periode'];
								$lap_sporangtua = mysqli_query($connect,"SELECT nm_siswa, nm_orangtua, alamat_siswa, spo.no_speringatan, spo.no_spanggilan, tgl_spanggilan FROM 
																																		sp_orangtua spo,
																																		sp_tunggakan spt,
																																		tb_pembayaranspp sp,
																																		detil_siswakelas ds,
																																		tb_siswa s
																																	WHERE
																																		spo.no_speringatan = spt.no_speringatan
																																	AND
																																		spt.no_pemspp = sp.no_pemspp
																																	AND
																																		sp.nisn = ds.nisn
																																	AND
																																		ds.nisn = s.nisn
																																	AND
																																		tgl_spanggilan between '$dari_periode' AND '$hingga_periode'
																																	GROUP BY nm_siswa, nm_orangtua, alamat_siswa, spo.no_speringatan, spo.no_spanggilan, tgl_spanggilan desc ") or die(mysqli_error($connect));
								$available = mysqli_num_rows($lap_sporangtua);
								//$nisn = $data_siswa['nisn'];
								if($available > 0 ){
							?>
						<div class="column" style="width:100%;margin:0px;:;background-color:;">
							<hr>
							<center><h3></h3></center>
							<div class="row" style="padding-bottom:20px;">
								<div class="col-1" style="width:50%;">
									<label for="nama_lengkap" style="float:;padding-right:px;">Periode</label>	<label>: <?php echo tanggal($dari_periode).' - '. tanggal($hingga_periode);  ?></label>
								</div>
							</div>
						</div>
						<div class="column" style="width:100%;margin:0px;:;background-color:;">
						<hr>
							<center><h3>Laporan Surat Panggilan Orangtua</h3></center>
								<table class="fixed-th" style="margin-left:10px;width:98%;">
									<thead>
										<tr>
											<th><center>NO</center></th>				
											<th>Nama Siswa</th>
											<th>Nama Orangtua</th>
											<th>Alamat</th>
											<th>No SPO</th>
											<th>No SPT</th>
											<th>Tanggal SPO</th>		
										</tr>
									</thead>
									<tbody>
									<?php
									// query lap pembayaran spp 
									$no = 0;
									while($data = mysqli_fetch_array($lap_sporangtua)){
										$no++;									
									?>
												<tr>
													<td><center><?php echo $no;?></center></td>
													<td><center><?php echo $data['nm_siswa'];?></center></td>
													<td><center><?php echo $data['nm_orangtua'];?></center></td>
													<td><center><?php echo $data['alamat_siswa'];?></center></td>
													<td><center><?php echo $data['no_spanggilan'];?></center></td>												
													<td><center><?php echo $data['no_speringatan']; ?></center></td>
													<td><center><?php echo tanggal($data['tgl_spanggilan']);?></center></td>
												</tr>
									<?php 
									}
									?>
									<tr>
										<td colspan="6">Total Surat Panggilan Orangtua</td>
										<td><?php echo $available;?></td>
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
										echo '<center>Data Tidak Ditemukan</center>';
								}						
							}
							?>	
			</div>
		</div>
		<script>
			function print_d(){
				window.open("cetak_laporan_sp_orangtua.php?dari_periode=<?php echo $dari_periode;?>&hingga_periode=<?php echo $hingga_periode; ?>","_blank");
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