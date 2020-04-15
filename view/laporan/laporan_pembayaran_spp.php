<html>
	<head>
		<title>Halaman Laporan Pembayaran SPP</title>
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
			<h1>&nbsp;Laporan Pembayaran SPP</h1>
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
							$lap_pembayaranspp = mysqli_query($connect,"SELECT * 	FROM 
																														tb_pembayaranspp ds,
																														tb_biayaspp b,
																														tb_siswa s
																														WHERE
																														ds.id_biayaspp = b.id_biayaspp
																														AND ds.nisn = s.nisn
																														AND tgl_pemspp between '$dari_periode' AND '$hingga_periode'
																														ORDER BY tgl_pemspp desc");
							$available = mysqli_num_rows($lap_pembayaranspp);
							//$nisn = $data_siswa['nisn'];
							if($available > 0 ){
								$query_total = mysqli_query($connect,"SELECT sum(biaya_spp) as total 	FROM 
																												tb_pembayaranspp ds,
																												tb_biayaspp b
																												WHERE
																												ds.id_biayaspp = b.id_biayaspp
																												AND tgl_pemspp between '$dari_periode' AND '$hingga_periode'");
								$total = mysqli_fetch_array($query_total);
						?>
						<div class="column" style="width:100%;">
							<hr>
							<center><h3>Laporan Pembayaran SPP</h3></center>
							<div class="row2nd" style="padding-bottom:20px;">
								<div class="col-1" style="width:50%;">
									<label style="float:right;padding-right:45px;">Periode</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label>: <?php echo tanggal($dari_periode).' - '.tanggal($hingga_periode);  ?></label>
								</div>
							</div>
							<div class="row2nd" style="padding-bottom:20px;">
								<div class="col-1" style="width:50%;">
									<label style="float:right;padding-right:60px;">Total</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label style="">: <?php echo rupiah($total['total']); ?>,-</label>
								</div>
							</div>
							<div class="row2nd" style="padding-bottom:20px;">
								<div class="col-1" style="width:100%;">
									<center><button style="margin-left:" onClick="print_d()"><i class="fa fa-print"></i> Cetak</button></center>
								</div>
							</div>
						</div>
						<div class="column" style="width:100%;">
						<hr>
							<center><h3>Laporan Pembayaran SPP</h3></center>
								<table class="fixed-th" style="margin-left:10px;width:98%;">
									<thead>
										<tr>
											<th><center>NO</center></th>
											<th>NSIN</th>											
											<th>Nama Siswa</th>
											<th>No Pembayaran SPP</th>
											<th>Tanggal Bayar</th>		
											<th>Biaya SPP</th>
										</tr>
									</thead>
									<tbody>
									<?php
									// query lap pembayaran spp 
									$no = 0;
									while($data = mysqli_fetch_array($lap_pembayaranspp)){
										$no++;									
									?>
												<tr>
													<td><center><?php echo $no;?></center></td>
													<td><center><?php echo $data['nisn'];?></center></td>
													<td><center><?php echo $data['nm_siswa'];?></center></td>
													<td><center><?php echo $data['no_pemspp'];?></center></td>												
													<td><center><?php echo tanggal($data['tgl_pemspp']); ?></center></td>
													<td><center><?php echo rupiah($data['biaya_spp']);?></center></td>
													</tr>
									<?php 
									}
									?>
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
				window.open("cetak_laporan_pembayaran_spp.php?dari_periode=<?php echo $dari_periode;?>&hingga_periode=<?php echo $hingga_periode; ?>","_blank");
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