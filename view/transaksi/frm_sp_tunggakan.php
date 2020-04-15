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
				<h1>&nbsp;Surat Peringatan Tunggakan</h1>
			<hr>
			<a href="frm_sp_tunggakan_kelas.php"><button class="button-link" style="margin:0px 80px 5px;">Buat SP Tunggakan</button></a>
			<table class="fixed-th" style="margin-left:100px; width:80%;">
				<thead>
					<tr>
						<th>No</th>
						<th>No SP Tunggakan</th>
						<th>Tanggal</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php					
					$batas = 10;
					$posisi = cariPosisi($batas);
					
					$result = mysqli_query($connect,"SELECT no_speringatan, tgl_speringatan FROM sp_tunggakan GROUP BY no_speringatan desc, tgl_speringatan");
					
					
					// mengambil data kelas
					$cari = mysqli_query($connect,"SELECT no_speringatan, tgl_speringatan FROM sp_tunggakan GROUP BY no_speringatan desc, tgl_speringatan LIMIT $posisi, $batas  ") or die (mysqli_error($connect));
					$nomor = $posisi + 	1;
					
					$jml_record = mysqli_num_rows($result);
					
					if($jml_record > 0){
						// menampilkan data dari tabel sp_tunggakan
						while($row=mysqli_fetch_array($cari)){
						$no_speringatan = $row['no_speringatan'];
						$query_tunggakan = "SELECT 
																	no_speringatan, s.nisn as nisn, nm_siswa, k.id_kelas as id_kelas, nm_kelas, spp.no_pemspp as no_pemspp, bulan, jatuh_tempo, tahun_ajaran, keterangan
																FROM 
																	sp_tunggakan spt,
																	tb_pembayaranspp spp,
																	detil_siswakelas ds,
																	tb_siswa s,
																	tb_kelas k
																WHERE
																		ds.nisn = s.nisn
																AND 	ds.id_kelas = k.id_kelas
																AND 	ds.nisn = spp.nisn
																AND 	ds.id_kelas = spp.id_kelas
																AND 	spt.no_pemspp = spp.no_pemspp
																AND		spt.no_speringatan = '$no_speringatan'";
						$query_sptunggakan = mysqli_query($connect, $query_tunggakan) or die(mysqli_error($connect));
						$getA = mysqli_fetch_array($query_sptunggakan);
						$get_nama = $getA['nm_siswa'];
						$get_kelas = $getA['nm_kelas'];
						$get_nisn = $getA['nisn'];
					?>
					<tr>
							<td><?php echo $nomor;?></td>
							<td><?php echo $row['no_speringatan']; ?></td>
							<td><?php echo $row['tgl_speringatan']; ?></td>
							<td>
								<button class="button-coklat" id="myBtn<?=$nomor?>"><i class="fa fa-search-plus fa-lg"></i></button>

										<!-- The Modal -->
										<div id="myModal<?=$nomor?>" class="modal">

										<!-- Modal content -->
											<div class="modal-content">
												<div class="modal-header">
													<span class="close<?=$nomor?>" id="tutup">&times;</span>
													<h2>No Surat Peringatan Tunggakan : <?php echo $row['no_speringatan']; ?></h2>
												</div>
												<div class="modal-body">
													<div class="row2nd" style="text-align:left; padding-left:100px;">
														<label>Nisn : <?php echo $get_nisn; ?></label><br>
														<label>Nama : <?php echo $get_nama; ?></label><br>
														<label>Kelas : <?php echo $get_kelas; ?></label><br>
														<label></label><br>
													</div>
													
													<div class="main-body">
														<table class="fixed-th" style="margin-left:100px;width:80%;">
															<thead>
																<tr>
																	<th>No</th>
																	<th>No Pembayaran SPP</th>
																	<th>Bulan</th>
																	<th>Jatuh Tempo</th>
																	<th>Keterangan</th>
																</tr>
															</thead>
															<tbody>
																<?php
																	// mengambil data detil_sptunggakan
																	$query_desptunggakan = mysqli_query($connect, $query_tunggakan) or die(mysqli_error($connect));
																	$no = 1;
																	while($d = mysqli_fetch_array($query_desptunggakan))
																	{
																?>
																<tr>
																	<td><?php echo $no; ?></td>
																	<td><?php echo $d['no_pemspp']; ?></td>
																	<td><?php echo $d['bulan'];?></td>
																	<td><?php echo $d['jatuh_tempo'];?></td>
																	<td><?php echo $d['keterangan'];?></td>
																</tr>
																<?php 
																$no++;
																	}
																?>
																<tr>
																	<td colspan="5"><a href="cetak_sp_tunggakan_siswa.php?nospt=<?php echo $row['no_speringatan'];?>" target="_BLANK">Cetak</a></td>	
																</tr>
															</tbody>
															
														</table>
															<br><br>
													</div>
												</div>
											</div>

										</div>
										<script>
											// Get the modal
											var modal<?=$nomor?>= document.getElementById('myModal<?=$nomor?>');

											// Get the button that opens the modal
											var btn<?=$nomor?> = document.getElementById("myBtn<?=$nomor?>");

											// Get the <span> element that closes the modal
											var span<?=$nomor?> = document.getElementsByClassName("close<?=$nomor?>")[0];

											// When the user clicks the button, open the modal 
											btn<?=$nomor?>.onclick = function() {
													modal<?=$nomor?>.style.display = "block";
											}

											// When the user clicks on <span> (x), close the modal
											span<?=$nomor?>.onclick = function() {
													modal<?=$nomor?>.style.display = "none";
											}
										</script>										
							</td>
							
						</tr>
				<?php
						$nomor++;
					} 
				?>
					<?php
					}else{ 
					?>
						<td colspan="4">Tidak ada Data Surat Peringatan Tunggakan</td>
				<?php 
					} 
				?>
				</tbody>
			</table>
			<p style='padding-left:10%;'>Jumlah Data : <?php echo $jml_record;?></p>
			<div class="paginasi-bar">
				<div class="paginasi">
					<?php 
						//paginasi
						$jml_halaman = jmlHalaman($jml_record,$batas);
						$link = linkHal(@$_GET['halaman'],$jml_halaman);
						echo $link;				
					?>
				</div>
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