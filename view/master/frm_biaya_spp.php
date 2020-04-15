<html>
	<head>
		<title>Halaman Biaya SPP</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../../style/istyle.css">
	</head>
	<body>
		<?php
			// menghubungkan koneksi database
			include '../../koneksi/koneksi.php';
			include '../function/paginasi.php';
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
			<h1>&nbsp;Data Biaya SPP</h1>
			<hr>
			<div class="konten">
				<button class="button-link" style="margin:0px 80px 5px;" id="myBtnEntry" ><i class="fa fa-plus-square"></i> Tambah Biaya SPP</button>
					<!-- The Modal Entry-->
				<div id="myModalEntry" class="modal">
				<!-- Modal content -->
					<div class="modal-content" style="width:30%;">
						<div class="modal-header">
							<span class="closeEntry" id="tutup">&times;</span>
							<h2>Tambah Biaya SPP</h2>
						</div>
						<div class="modal-body">
							<div class="main-body">
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
								<form method="post" action="proses/proses_entry_biaya_spp.php" >  	
									<div class="row2nd">
										<div class="col-1nd">
											<label>ID Biaya SPP</label>
										</div>
										<div class="col-2nd">
											<input type="text" maxlength="5" name="id_biayaspp_entry" value="<?php echo "$kode_otomatis"; ?>" readonly>
										</div>
									</div>
									<div class="row2nd">
										<div class="col-1nd">
											<label>Angkatan</label>
										</div>
										<div class="col-2nd">
											<select name="angkatan_entry" required>
												<option value="">Pilih Angkatan</option>
												<?php
												$thn_skr = date('Y');
												$batass = 3;
												$x = $thn_skr - $batass;
												while($x <= $thn_skr + $batass){
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
									<div class="row2nd">
										<div class="col-1nd">
											<label>Biaya SPP</label>
										</div>
										<div class="col-2nd">
											<input type="text" maxlength="12" name="biaya_spp_entry" title=""  required>
										</div>
									</div>
									<div class="row2nd" style="padding-bottom:5px;">
										<input type="submit" value="Simpan Data" style="float:right;">
									</div>
								</form>
							</div>
						</div>
					</div>

				</div>
				<!-- JavScriptModalEntry -->
				<script>
					// Get the modal
					var modalEntry = document.getElementById('myModalEntry');

					// Get the button that opens the modal
					var btnEntry = document.getElementById("myBtnEntry");

					// Get the <span> element that closes the modal
					var spanEntry = document.getElementsByClassName("closeEntry")[0];

					// When the user clicks the button, open the modal 
					btnEntry.onclick = function() {
							modalEntry.style.display = "block";
					}

					// When the user clicks on <span> (x), close the modal
					spanEntry.onclick = function() {
							modalEntry.style.display = "none";
					}
				</script>
				<table class="fixed-th" style="margin-left:100px; width:80%;">
					<thead>
						<tr>
							<th>No</th>
							<th>ID Biaya SPP</th>
							<th>Angkatan</th>
							<th>Biaya SPP</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php						
						$batas = 5;
						$posisi = cariPosisi($batas);
						
						$result = mysqli_query($connect,"SELECT * FROM tb_biayaspp");
						$jml_record = mysqli_num_rows($result);

						// mengambil data biaya spp
						$cari = mysqli_query($connect,"SELECT * FROM tb_biayaspp ORDER BY angkatan ASC LIMIT $posisi, $batas") or die (mysqli_error());
						$nomor =  $posisi+1;
						
						// menampilkan data dari tabel biaya spp
						$available = mysqli_num_rows($cari);
						if($available > 0){
						while($data=mysqli_fetch_array($cari,MYSQLI_ASSOC)){
						?>
							<tr>
								<td><?php echo $nomor++; ?></td>
								<td><?php echo $data['id_biayaspp']; ?></td>
								<td><?php echo $data['angkatan']; ?></td>
								<td><?php echo rupiah($data['biaya_spp']); ?></td>
								<td>
									<button class="button-abu" id="myBtn2<?=$nomor?>"><i class="fa fa-pencil fa-lg"></i></button>
										<!-- The Modal Update -->
										<div id="myModal2<?=$nomor?>" class="modal">
										<!-- Modal content -->
											<div class="modal-content" style="width:30%;">
												<div class="modal-header">
													<span class="close2<?=$nomor?>" id="tutup">&times;</span>
													<h2>Update Biaya SPP</h2>
												</div>
												<div class="modal-body">
													<div class="main-body">
															<form method="post" action="proses/proses_update_biaya_spp.php" >  
																<div class="row2nd">
																	<div class="col-1nd">
																		<label for="kd_pelanggan">ID Biaya</label>
																	</div>
																	<div class="col-2nd">
																		<input type="text" maxlength="10" name="id_biayaspp_update" value="<?php echo $data['id_biayaspp']; ?>" readonly>
																	</div>
																</div>
																	
																<div class="row2nd">
																	<div class="col-1nd">
																		<label for="nama_lengkap">Angkatan</label>
																	</div>
																	<div class="col-2nd">
																		<input type="text" maxlength="9" name="angkatan_update"  value="<?php echo $data['angkatan']; ?>" readonly>
																	</div>
																</div>

																<div class="row2nd">
																	<div class="col-1nd">
																		<label for="kd_pelanggan">Biaya</label>
																	</div>
																	<div class="col-2nd">
																		<input type="text" maxlength="12" name="biaya_spp_update" pattern="[0-9]+" title="Maximal 12 Digit Angka" value="<?php echo $data['biaya_spp']; ?>" required>
																	</div>
																</div>
																<input type="submit" style="float:right;" value="Ubah Data">
															</form>
													</div>
												</div>
											</div>

										</div>
										<!-- JavScriptModalUpdate -->
										<script>
											// Get the modal
											var modal2<?=$nomor?> = document.getElementById('myModal2<?=$nomor?>');

											// Get the button that opens the modal
											var btn2<?=$nomor?> = document.getElementById("myBtn2<?=$nomor?>");

											// Get the <span> element that closes the modal
											var span2<?=$nomor?> = document.getElementsByClassName("close2<?=$nomor?>")[0];

											// When the user clicks the button, open the modal 
											btn2<?=$nomor?>.onclick = function() {
													modal2<?=$nomor?>.style.display = "block";
											}

											// When the user clicks on <span> (x), close the modal
											span2<?=$nomor?>.onclick = function() {
													modal2<?=$nomor?>.style.display = "none";
											}
										</script>
									<a href="proses/proses_delete_biaya_spp.php?id=<?php echo $data['id_biayaspp']; ?>" onclick="return confirm('Yakin Hapus?')">
										<button class="button-merah"><i class="fa fa-trash fa-lg"></i></button>
									</a>
								</td>
							</tr>
						<?php
						}
						}else{
							echo "<tr><td colspan='5' align='center'> Data tidak ditemukan! </td></tr>";
						}
						?>
					</tbody>
				</table>
				
				<p style="padding-left:10%;">Jumlah Data: <?php echo $jml_record;?></p>
				<div class="paginasi-bar">
					<div class="paginasi">
						<?php 
							// paginasi
							$jml_halaman = jmlHalaman($jml_record,$batas);
							$link = linkHal(@$_GET['halaman'],$jml_halaman);
							echo $link;			
						?>					
					</div>
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
