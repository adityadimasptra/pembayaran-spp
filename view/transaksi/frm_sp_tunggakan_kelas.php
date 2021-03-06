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
		<a href="frm_sp_tunggakan.php?halaman=1">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
		</a>
			<h1>&nbsp;Tambah Surat Peringatan Tunggakan</h1>
			<hr>
				<div class="container">
					<?php							
							$query_kelas 	 = mysqli_query($connect,"	SELECT ds.id_kelas, nm_kelas 
																		FROM 	tb_kelas k,
																				detil_siswakelas ds
																	 	WHERE k.id_kelas = ds.id_kelas
																	 	GROUP BY ds.id_kelas, nm_kelas
																		ORDER BY nm_kelas ASC");
							$query_tajaran = mysqli_query($connect,"SELECT tahun_ajaran FROM detil_siswakelas group by tahun_ajaran");
						?>
					<div class="column" style="width:40%">
						<form method="POST" action="" >					
							<div class="row">
								<div class="col-1">
									<label>Kelas </label>
								</div>
								<div class="col-2">
									<select name='kelas'>
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
								<div class="col-1">
									<label>Tahun Ajaran</label>
								</div>
								<div class="col-2">
									<select name='th_ajaran'>
										<option value="">Tahun Ajaran </option>
										<?php 
											while($data_tajaran=mysqli_fetch_array($query_tajaran)){
										?>
												<option value="<?php echo $data_tajaran['tahun_ajaran'];?>"><?php echo $data_tajaran['tahun_ajaran'];?></option>
										<?php 
										} 
										?>
									</select>
									
								</div>
							</div>	
							<div class="row" style="padding:20px 20px 20px 0px">
								<input type="submit" style="float:right;" value="Cari">	
							</div>
						</form>
						</div>
						
						<!-- TAMPIL DATA TUNGGAKAN PEMBAYARAN SPP -->
						<?php 
						if(isset($_POST['kelas']) && $_POST['th_ajaran']!=''){
							$kelas = $_POST['kelas'];
							$tahun_ajaran = $_POST['th_ajaran'];
							$tgl_sekarang = date('Y-m-d');
							//$tgl_sekarang = date('2018-12-10');
							$qnama_kelas 	= mysqli_query($connect,"SELECT * FROM tb_kelas WHERE id_kelas ='$kelas'");
							$nm_kelas = mysqli_fetch_array($qnama_kelas);
							$namakelas = $nm_kelas['nm_kelas'];
							$lap_tunggakan = mysqli_query($connect,"SELECT p.nisn as siswa, nm_siswa, no_pemspp, k.id_kelas, nm_kelas as kelas, tahun_ajaran, count(bulan) as jml_bulan, sum(biaya_spp) as total
																											FROM 
																												tb_pembayaranspp p,
																												detil_siswakelas ds,
																												tb_biayaspp b,
																												tb_kelas k,
																												tb_siswa s
																											WHERE p.nisn = ds.nisn
																												AND p.id_kelas = ds.id_kelas
																												AND p.id_biayaspp = ds.id_biayaspp
																												AND ds.id_biayaspp = b.id_biayaspp
																												AND ds.nisn = s.nisn
																												AND ds.id_kelas = k.id_kelas
																														
																												AND jatuh_tempo < '$tgl_sekarang'
																												AND tgl_pemspp is null
																												AND k.id_kelas = '$kelas' 
																												AND tahun_ajaran = '$tahun_ajaran'
																											GROUP BY siswa, nm_siswa, k.id_kelas, kelas, tahun_ajaran
																											ORDER BY nm_siswa asc") or die (mysqli_error($connect));
							$available = mysqli_num_rows($lap_tunggakan);
							//$nisn = $data_siswa['nisn'];
							if($available > 0 ){
						?>
							
						<div class="column" style="width:100%;margin:0px;:;background-color:;">
							<hr>
							<center><h3>Data Tunggakan Kelas <?php echo $namakelas; ?> | Tahun Ajaran <?php echo $tahun_ajaran;?></h3></center>
								<table class="fixed-th" style="margin-left:10px;width:98%;">
									<thead>
										<tr>
											<th><center>No</center></th>				
											<th>NISN</th>
											<th>Nama Siswa</th>
											<th>NO Pemspp</th>
											<th>Kelas</th>		
											<th>Tahun Ajaran</th>		
											<th>Total Bulan</th>
											<th>Total Tagihan</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
									// query lap pembayaran spp 
									$no = 0;
									while($data = mysqli_fetch_array($lap_tunggakan)){
										$no++;
										$query_ceksperingatan = mysqli_query($connect,"SELECT * 	FROM 
																									sp_tunggakan spt, 
																									tb_pembayaranspp sp
																								WHERE
																									spt.no_pemspp = sp.no_pemspp
																								AND
																									spt.no_pemspp = '$data[no_pemspp]'") or die (mysqli_error($connect));
										$cek_speringatan = mysqli_num_rows($query_ceksperingatan);
									?>
												<tr>
													<td><center><?php echo $no;?></center></td>
													<td><center><?php echo $data['siswa'];?></center></td>												
													<td><center><?php echo $data['nm_siswa'];?></center></td>
													<td><center><?php echo $data['no_pemspp'];?></center></td>
													<td><center><?php echo $data['kelas'];?></center></td>		
													<td><center><?php echo $data['tahun_ajaran']; ?></center></td>
													<td><center><?php echo $data['jml_bulan'];?></center></td>
													<td><center><?php echo rupiah($data['total']); ?></center></td>
													<td><center>
														<?php if($cek_speringatan > 0){ ?>
															<label> - </label>
														<?php }else{ ?>
															<a href="frm_sp_tunggakan_siswa.php?nisn=<?php echo $data['siswa']?>&th_ajaran=<?php echo $data['tahun_ajaran'];?>&kelas=<?php echo $data['id_kelas'];?>"><button class="button-coklat">Pilih </button></a>
														<?php }?>
													</td>
												</tr>
									<?php 
								}
									
									$query_total = mysqli_query($connect,"SELECT sum(biaya_spp) as total 	
																												FROM 
																														tb_pembayaranspp p,
																														detil_siswakelas ds,
																														tb_biayaspp b,
																														tb_kelas k
																												WHERE p.nisn = ds.nisn
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
										<td colspan="7">Total Tunggakan</td>	
										<td><?php echo rupiah($total['total']); ?></td>
										<td></td>
									</tr>
									<!--<tr>
										<td colspan="8"><button style="margin-left:5%" onClick="print_d()"><i class="fa fa-print"></i> Cetak</button></td>	
									</tr>-->
									<tr>
										<td colspan="9" style="text-align:left;"><p style="color:red;">*Jatuh Tempo Pembayaran SPP setiap tanggal <b>10</b> setiap bulannya</p></a></td>
									</tr>
								</tbody>
							</table>
						</div>
							<?php
								}else{
									echo "<div class='column' style='width:100%;margin:0px;:;background-color:;'>";
										echo '<center>Tidak ada Tunggakan SPP</center>';
									echo "<div>";
								}						
							}
							?>	
				</div>
			</div>
		<script>
			function print_d(){
				window.open("cetak_laporan_tunggakan_spp.php?kelas=<?php echo $kelas;?>&th_ajaran=<?php echo $tahun_ajaran; ?>","_blank");
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