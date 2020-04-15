<html>
	<head>
		<title>Halaman Surat Peringatan Tunggakan</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../../style/istyle.css">
	</head>
	
	<body>
		<?php
			include '../../koneksi/koneksi.php';
			include '../function/format.php'; 
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
		<a href="frm_sp_tunggakan_kelas.php">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
		</a>
			<h1>&nbsp;Tambah Surat Peringatan Tunggakan</h1>
			<hr>
				<div class="container">
					<?php 							
							$id_kelas = $_GET['kelas'];
							$nisn = $_GET['nisn'];
							$tahun_ajaran = $_GET['th_ajaran'];
							
							$query_siswa = mysqli_query($connect,"SELECT * FROM tb_siswa WHERE nisn='$nisn'");
							$data_siswa = mysqli_fetch_array($query_siswa);
							$query_kelas = mysqli_query($connect,"SELECT * FROM tb_kelas WHERE id_kelas='$id_kelas'");
							$data_kelas = mysqli_fetch_array($query_kelas);
					?>
							<div class="column" style="width:100%;margin:0px;background-color:;">
								<div class="row2nd" style="margin:none;">
									<div class="col-1" style="width:15%;">
										<label>NISN</label>
									</div>
									<div class="col-2" style="width:20%;">
										<label>: <?php echo $data_siswa['nisn']; ?></label>
									</div>
								</div>

								<div class="row2nd">
									<div class="col-1" style="width:15%;">
										<label>Nama Siswa</label>
									</div>
									<div class="col-2" style="width:20%;">
										<label>: <?php echo $data_siswa['nm_siswa'];?></label>
									</div>
								</div>
								
								<div class="row2nd">
									<div class="col-1" style="width:15%;">
										<label>Kelas Siswa</label>
									</div>
									<div class="col-2" style="width:20%;">
										<label>: <?php echo $data_kelas['nm_kelas']; ?></label>
									</div>
								</div>
								<div class="row2nd">
									<div class="col-1" style="width:15%;">
										<label>Tahun Ajaran</label>
									</div>
									<div class="col-2" style="width:20%;">
										<label>: <?php echo $tahun_ajaran; ?></label>
									</div>
								</div>
							</div>
							
							<?php 
								$tgl_sekarang = date('Y-m-d');
								//$tgl_sekarang = date('2018-12-10');
								$detil_tunggakan = mysqli_query($connect, "SELECT no_pemspp, bulan, jatuh_tempo, tahun_ajaran, biaya_spp FROM 
																													tb_pembayaranspp p,
																													detil_siswakelas ds,
																													tb_biayaspp b,
																													tb_kelas k,
																													tb_siswa s
																													WHERE
																													p.nisn = ds.nisn
																													
																													AND ds.id_biayaspp = b.id_biayaspp
																													AND ds.nisn = s.nisn
																													AND ds.id_kelas = k.id_kelas
																													
																													AND jatuh_tempo < '$tgl_sekarang'
																													AND tgl_pemspp is null
																													AND k.id_kelas = '$id_kelas'
																													AND	s.nisn = '$nisn'
																													AND tahun_ajaran = '$tahun_ajaran'
																													") or die (mysqli_error($connect)); 
								$available = mysqli_num_rows($detil_tunggakan);
								//$nisn = $data_siswa['nisn'];
								if($available > 0 ){
								?>

							
							<div class="column" style="width:100%;margin:0px;:;background-color:;">
							<hr>
								<center><h3>Tagihan Pembayaran SPP</h3></center>
									<table class="fixed-th" style="margin-left:10px;width:98%;">
										<thead>
											<tr>
												<th><center>No</center></th>				
												<th>No Pembayaran SPP</th>
												<th>Bulan</th>
												<th>Jatuh Tempo</th>		
												<th>Tahun Ajaran</th>
												<th>Biaya SPP</th>
											</tr>
										</thead>
										<tbody>
										<?php
										// query lap pembayaran spp 
										$no = 0;
										while($data = mysqli_fetch_array($detil_tunggakan)){
											$no++;									
										?>
													<tr>
														<td><center><?php echo $no;?></center></td>
														<td><center><?php echo $data['no_pemspp'];?></center></td>												
														<td><center><?php echo $data['bulan'];?></center></td>		
														<td><center><?php echo $data['jatuh_tempo']; ?></center></td>
														<td><center><?php echo $data['tahun_ajaran']; ?></center></td>
														<td><center><?php echo rupiah($data['biaya_spp']);?></center></td>
													</tr>
										<?php 
										$no_pemspp = $data['no_pemspp'];}
										
										$query_total = mysqli_query($connect,"SELECT sum(biaya_spp) as total 	
																													FROM 
																															tb_pembayaranspp p,
																															detil_siswakelas ds,
																															tb_biayaspp b,
																															tb_kelas k,
																															tb_siswa s
																													WHERE p.nisn = ds.nisn
																															AND ds.id_biayaspp = b.id_biayaspp
																															AND ds.id_kelas = k.id_kelas
																															AND ds.nisn = s.nisn
																															
																															AND jatuh_tempo < '$tgl_sekarang'
																															AND tgl_pemspp is null
																															AND s.nisn = '$nisn'
																															AND k.id_kelas = '$id_kelas' 
																															AND tahun_ajaran ='$tahun_ajaran'")
																															or die (mysqli_error($connect));
										$total = mysqli_fetch_array($query_total);
										/*echo $_POST['kelas'];
										echo "<Br> ";
										echo $_POST['th_ajaran'];*/
										?>
										
										<tr>
											<td colspan="5">Total Tunggakan</td>	
											<td><?php echo rupiah($total['total']); ?></td>
										</tr>
										<tr>
											<td colspan="6">

												<a href="proses/proses_entry_sp_tunggakan.php?nisn=<?php echo $nisn;?>&th_ajaran=<?php echo $tahun_ajaran; ?>&kelas=<?php echo $id_kelas; ?>&no_pemspp=<?php echo $no_pemspp; ?>" onclick="return confirm('Yakin ingin membuat Surat Peringatan Tunggakan?')">
													<button style="margin-left:5%">
														<i class="fa fa-print"></i> Tambah Surat Peringatan
													</button>
												</a>
											</td>	
										</tr>
										<tr>
											<td colspan="6" style="text-align:left;"><p style="color:red;">*Jatuh Tempo Pembayaran SPP setiap tanggal <b>10</b> setiap bulannya</p></a></td>
										</tr>
									</tbody>
								</table>
							</div>
								<?php
									}else{
											echo '<center>Tidak ada Tunggakan SPP</center>';
									}						
								?>	
				</div>
			</div>
		<script>
			function print_d(){
				var tanya = confirm('Ingin Mencetak Surat Peringatan ?');
				if (tanya == true){
					window.open("cetak_laporan_detil_tunggakan_spp.php?nisn=<?php echo $nisn;?>&th_ajaran=<?php echo $tahun_ajaran; ?>&kelas=<?php echo $id_kelas; ?>","_blank");
					return true;
				}else{
					return false;
				}
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