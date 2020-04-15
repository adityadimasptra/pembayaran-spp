<html>
	<head>
		<title>Halaman Siswa</title>
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
			<h1>&nbsp;Data Siswa</h1>
			<hr>
			
			<!-- cari siswa -->
			<div style="margin-left:600px">
				<form action="" method="post">
					<div class="col-1" style="width:80%">
						<input type="text" name="cari" placeholder="Cari Siswa...">
					</div>
					<div class="col-2" style="width:20%">
						<a href="#"><input type="submit" value="Cari" style="margin-left:5px; "></a>
					</div>
				</form>
				<?php
					if(!empty($_POST['cari'])){
						$cari = $_POST['cari'];
						echo "Hasil Pencarian : ".$cari;
					}
				?>
			</div>
				<button class="button-link" style="margin:0px 80px 5px;" id="myBtnEntry" ><i class="fa fa-plus-square"></i> Tambah Siswa</button>
				<!-- The Modal Entry-->
				<div id="myModalEntry" class="modal">
					<!-- Modal content -->
					<div class="modal-content">
						<div class="modal-header">
							<span class="closeEntry" id="tutup">&times;</span>
							<h2>Tambah Data Siswa</h2>
						</div>
						<div class="modal-body">
							<div class="main-body">
								<form method="post" action="proses/proses_entry_siswa.php" >
								<!---------------------------SISWA------------------------>
								<div class="column2nd">
								
									<div class="row2nd	">
										<div class="col-1nd">
											<label class="">NISN Siswa</label>
										</div>
										<div class="col-2nd">
											<input type="text" maxlength="10" name="nisn_entry" title="Gunakan Angka 10 Digit" pattern="^\d{10}$" required>
										</div>
									</div>
									
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Nama Siswa</label>
										</div>
										<div class="col-2nd">
											<input type="text" name="nm_siswa_entry" maxlength="50" title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+" required>
										</div>
									</div>
									
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Jenis Kelamin</label>
										</div>
										<div class="col-2nd">
											<select name="jenkel_entry">
												<option value="">--Pilih--</option>
												<option value="Laki-Laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
									</div>
									
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Tempat Lahir</label>
										</div>
										<div class="col-2nd">
											<input type="text" name="tempat_lahir_entry" maxlength="30"  placeholder="Masukan tempat Lahir..." required>
										</div>
									</div>
									
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Tanggal Lahir</label>
										</div>
										<div class="col-2nd">
											<input type="date" name="tgl_lahir_siswa_entry" required>
										</div>
									</div>
									
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Agama</label>
										</div>
										<div class="col-2nd">
											<select name="agama_entry" required>
												<option value="">--Pilih--</option>
												<option value="Islam">Islam</option>
												<option value="Kristen">Kristen</option>
												<option value="Hindu">Hindu</option>
												<option value="Budha">Budha</option>
												<option value="Lainnya">Lainnya</option>
											</select>
										</div>
									</div>
									
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Alamat</label>
										</div>
										<div class="col-2nd">
											<textarea name="alamat_siswa_entry" placeholder="Masukan alamat lengkap..." style="height:100px;	" maxlength="80"  title="Gunakan Alamat yang Benar" required></textarea>
										</div>
									</div>
									
									<div class="row2nd" style="padding-bottom:5px;">
										<div class="col-1nd">
											<label class="">Telp Siswa</label>
										</div>
										<div class="col-2nd">
											<input type="text" name="telp_siswa_entry" maxlength="12" title="12 Digit Nomor Telepon" pattern="^\d{12}$" required>
										</div>
									</div>
									
								</div>
								<!---------------------------ORANG TUA------------------------>
								<div class="column2nd" style="margin-left:40px;">
								
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Nama Orangtua</label>
										</div>
										<div class="col-2nd">
											<input type="text" name="nama_orangtua_entry" maxlength="50"  title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+" required>
										</div>
									</div>
									
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Tanggal Lahir</label>
										</div>
										<div class="col-2nd">
											<input type="date" name="tgl_lahir_orangtua_entry" required>
										</div>
									</div>
									
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Pekerjaan</label>
										</div>
										<div class="col-2nd">
											<input type="text" name="pekerjaan_entry" maxlength="20"  title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+" required>
										</div>
									</div>
									
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Alamat Kantor</label>
										</div>
										<div class="col-2nd">
											<textarea name="alamat_kantor_entry" placeholder="Masukan alamat lengkap..." style="height:100px;" maxlength="80"  title="Gunakan Alamat yang Benar" required></textarea>
										</div>
									</div>
									
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Penghasilan</label>
										</div>
										<div class="col-2nd">
											<select name="penghasilan_entry">
												<option value="">--Pilih--</option>
												<option value="< 1.000.000">< 1.000.000</option>
												<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
												<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
												<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
												<option value="> 7.000.000">> 7.000.000</option>
											</select>
										</div>
									</div>
									
									<div class="row2nd">
										<div class="col-1nd">
											<label class="">Alamat Orangtua</label>
										</div>
										<div class="col-2nd">
											<textarea name="alamat_orangtua_entry" placeholder="Masukan alamat lengkap..." style="height:100px;" maxlength="80"  title="Gunakan Alamat yang Benar" required></textarea>
										</div>
									</div>
									
									<div class="row2nd" style="padding-bottom:5px;margin-bottom:5px;">
										<div class="col-1nd">
											<label class="">Telp Orangtua</label>
										</div>
										<div class="col-2nd">
											<input type="text" name="telp_orangtua_entry" maxlength="12" title="12 Digit Nomor Telepon" pattern="^\d{12}$" required>
										</div>
									</div>
									<input type="submit" style="float:right;" value="Simpan Data">
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
				<table class="fixed-th" style="margin-left:100px;width:80%;">
					<thead>
						<tr>
							<th>NO</th>
							<th>NISN</th>
							<th>Nama</th>
							<th>Jenis Kelamin</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$batas = 15;
						$posisi = cariPosisi($batas);
						
						$nomor = 1;
						if($_SERVER['REQUEST_METHOD'] == "POST"){
							$cari = trim(mysqli_real_escape_string($connect, $_POST['cari']));
							if($cari != ''){
								$query 			= "SELECT * FROM tb_siswa WHERE nm_siswa LIKE '%$cari%' Order by nm_siswa";
								$query_jml 	= "SELECT * FROM tb_siswa WHERE nm_siswa LIKE '%$cari%' Order by nm_siswa";
							}else{
								$query 			= "SELECT * FROM tb_siswa order by nm_siswa LIMIT $posisi, $batas";
								$query_jml 	= "SELECT * FROM tb_siswa";
								$nomor 			= $posisi + 1;
							}
						}else{
							$query = "SELECT * FROM tb_siswa order by nm_siswa LIMIT $posisi, $batas";
							$query_jml = "SELECT * FROM tb_siswa";
							$nomor = $posisi + 1;
						}
						
						//query siswa
						$sql_siswa = mysqli_query($connect, $query) or die (mysqli_error($connect));
						
						//menampilkan data siswa
						$available = mysqli_num_rows($sql_siswa);
						if($available > 0){
							while($data=mysqli_fetch_array($sql_siswa)){
							?>
								<tr>
									<td><?php echo $nomor;?></td>
									<td><?php echo $data['nisn']; ?></td>
									<td><?php echo $data['nm_siswa']; ?></td>
									<td><?php echo $data['jenis_kelamin']; ?></td>
									<td style="text-align:center;">
										<button class="button-coklat" id="myBtn<?=$nomor?>"><i class="fa fa-search-plus fa-lg"></i></button>

										<!-- The Modal Lihat-->
										<div id="myModal<?=$nomor?>" class="modal">
										<!-- Modal content -->
											<div class="modal-content">
												<div class="modal-header">
													<span class="close<?=$nomor?>" id="tutup">&times;</span>
													<h2><?php echo $data['nm_siswa']; ?></h2>
												</div>
												<div class="modal-body">
													<div class="main-body">
														<!---------------------------SISWA------------------------>
														<div class="column2nd">
														
															<div class="row2nd	">
																<div class="col-1nd">
																	<label class="">NISN Siswa</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['nisn']; ?></label>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Nama Siswa</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['nm_siswa']; ?></label>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Jenis Kelamin</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['jenis_kelamin']; ?></label>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Tempat Lahir</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['tempat_lahir']; ?></label>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Tanggal Lahir</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo tanggal($data['tgl_lahir_siswa']).' ('.usia($data['tgl_lahir_siswa']).' thn)'; ?></label>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Agama</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['agama']; ?></label>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Alamat</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['alamat_siswa']; ?></label>
																</div>
															</div>
															
															<div class="row2nd" style="padding-bottom:5px;">
																<div class="col-1nd">
																	<label class="">Telp Siswa</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['telp_siswa']; ?></label>
																</div>
															</div>
															
														</div>
														<!---------------------------ORANG TUA------------------------>
														<div class="column2nd" style="margin-left:40px;">
														
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Nama Orangtua</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['nm_orangtua']; ?></label>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Tanggal Lahir</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo tanggal($data['tgl_lahir_orangtua']).' ('.usia($data['tgl_lahir_orangtua']).' thn)'; ?></label>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Pekerjaan</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['pekerjaan']; ?></label>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Alamat Kantor</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['alamat_kantor']; ?></label>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Penghasilan</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['penghasilan']; ?></label>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Alamat Orangtua</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['alamat_orangtua']; ?></label>
																</div>
															</div>
															
															<div class="row2nd" style="padding-bottom:5px;margin-bottom:50px;">
																<div class="col-1nd">
																	<label class="">Telp Orangtua</label>
																</div>
																<div class="col-2nd">
																	<label class="">: <?php echo $data['telp_orangtua']; ?></label>
																</div>
															</div>														
														</div>
													</div>
												</div>
											</div>

										</div>
										<!-- JavScriptModalLihat -->
										<script>
											// Get the modal
											var modal<?=$nomor?> = document.getElementById('myModal<?=$nomor?>');

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
													
										<button class="button-abu" id="myBtn2<?=$nomor?>"><i class="fa fa-pencil fa-lg"></i></button>
										<!-- The Modal Update -->
										<div id="myModal2<?=$nomor?>" class="modal">
										<!-- Modal content -->
											<div class="modal-content">
												<div class="modal-header">
													<span class="close2<?=$nomor?>" id="tutup">&times;</span>
													<h2>Ubah Data Siswa</h2>
												</div>
												<div class="modal-body">
													<form method="post" action="proses/proses_update_siswa.php" >
													<div class="main-body">
														<!---------------------------SISWA------------------------>
														<div class="column2nd">
														
															<div class="row2nd	">
																<div class="col-1nd">
																	<label class="">NISN Siswa</label>
																</div>
																<div class="col-2nd">
																	<input type="text" maxlength="10" name="nisn_update" value="<?php echo $data['nisn']; ?>" readonly>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Nama Siswa</label>
																</div>
																<div class="col-2nd">
																	<input type="text" name="nm_siswa_update" maxlength="50" title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+"  value="<?php echo $data['nm_siswa']; ?>"required>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Jenis Kelamin</label>
																</div>
																<div class="col-2nd">
																	<select name="jenkel_update">
																		<?php 
																			if($data['jenis_kelamin']=='LAKI-LAKI'){
																			?>
																				<option value="Laki-Laki">Laki-Laki</option>
																				<option value="Perempuan">Perempuan</option>
																			<?php
																			}else if($data['jenis_kelamin']=='PEREMPUAN'){
																			?>
																				<option value="Perempuan">Perempuan</option>
																				<option value="Laki-Laki">Laki-Laki</option>
																			<?php
																			}
																		?>
																	</select>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Tempat Lahir</label>
																</div>
																<div class="col-2nd">
																	<input type="text" name="tempat_lahir_update" maxlength="30" placeholder="Masukan tempat Lahir..." value="<?php echo $data['tempat_lahir']; ?>" required>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Tanggal Lahir</label>
																</div>
																<div class="col-2nd">
																	<input type="date" name="tgl_lahir_siswa_update" value="<?php echo $data['tgl_lahir_siswa']; ?>" required>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Agama</label>
																</div>
																<div class="col-2nd">
																	<select name="agama_update" required>
																		<?php 
																			if($data['agama']=='ISLAM'){
																		?>
																				<option value="Islam">Islam</option>
																				<option value="Kristen">Kristen</option>
																				<option value="Hindu">Hindu</option>
																				<option value="Budha">Budha</option>
																				<option value="Lainnya">Lainnya</option>
																			<?php
																			}else if($data['agama']=='KRISTEN'){
																			?>
																				<option value="Kristen">Kristen</option>
																				<option value="Islam">Islam</option>
																				<option value="Hindu">Hindu</option>
																				<option value="Budha">Budha</option>
																				<option value="Lainnya">Lainnya</option>
																		<?php
																			}else if($data['agama']=='HINDU'){
																			?>
																				<option value="Hindu">Hindu</option>
																				<option value="Islam">Islam</option>
																				<option value="Kristen">Kristen</option>
																				<option value="Budha">Budha</option>
																				<option value="Lainnya">Lainnya</option>
																			<?php
																			}else if($data['agama']=='BUDHA'){
																			?>
																				<option value="Budha">Budha</option>
																				<option value="Islam">Islam</option>
																				<option value="Kristen">Kristen</option>
																				<option value="Hindu">Hindu</option>
																				<option value="Lainnya">Lainnya</option>
																			<?php
																			}else if($data['agama']=='LAINNYA'){
																				?>
																				<option value="Lainnya">Lainnya</option>
																				<option value="Islam">Islam</option>
																				<option value="Kristen">Kristen</option>
																				<option value="Hindu">Hindu</option>
																				<option value="Budha">Budha</option>
																				<?php
																			}
																		?>
																	</select>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Alamat</label>
																</div>
																<div class="col-2nd">
																	<textarea name="alamat_siswa_update" placeholder="Masukan alamat lengkap..." style="height:100px;text-transform:uppercase" maxlength="80" required><?php echo $data['alamat_siswa']; ?></textarea>
																</div>
															</div>
															
															<div class="row2nd" style="padding-bottom:5px;">
																<div class="col-1nd">
																	<label class="">Telp Siswa</label>
																</div>
																<div class="col-2nd">
																	<input type="text" name="telp_siswa_update" maxlength="12" pattern="^\d{12}$" title="12 Digit Nomor Telepon" value="<?php echo $data['telp_siswa']; ?>" required>
																</div>
															</div>
															
														</div>
														<!---------------------------ORANG TUA------------------------>
														<div class="column2nd" style="margin-left:40px;">
														
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Nama Orangtua</label>
																</div>
																<div class="col-2nd">
																	<input type="text" name="nama_orangtua_update" maxlength="50"  title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+" value="<?php echo $data['nm_orangtua']; ?>" required>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Tanggal Lahir</label>
																</div>
																<div class="col-2nd">
																	<input type="date" name="tgl_lahir_orangtua_update" value="<?php echo $data['tgl_lahir_orangtua'];?>" required>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Pekerjaan</label>
																</div>
																<div class="col-2nd">
																	<input type="text" name="pekerjaan_update" maxlength="20"  title="Gunakan Huruf Alphabet" pattern="[A-Za-z\s]+" value="<?php echo $data['pekerjaan']; ?>" required>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Alamat Kantor</label>
																</div>
																<div class="col-2nd">
																	<textarea name="alamat_kantor_update" placeholder="Masukan alamat lengkap..." style="height:100px;" maxlength="80"   required><?php echo $data['alamat_kantor']; ?></textarea>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Penghasilan</label>
																</div>
																<div class="col-2nd">
																	<select name="penghasilan_update">
																		<?php 
																			if($data['penghasilan']=='< 1.000.000'){
																			?>
																				<option value="< 1.000.000">< 1.000.000</option>
																				<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
																				<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
																				<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
																				<option value="> 7.000.000">> 7.000.000</option>
																			<?php 
																			}else if($data['penghasilan']=='1.000.000-3.000.000'){
																			?>
																				<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
																				<option value="< 1.000.000">< 1.000.000</option>
																				<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
																				<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
																				<option value="> 7.000.000">> 7.000.000</option>
																			<?php
																			}else if($data['penghasilan']=='3.000.000-5.000.000'){
																			?>
																				<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
																				<option value="< 1.000.000">< 1.000.000</option>
																				<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
																				<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
																				<option value="> 7.000.000">> 7.000.000</option>
																			<?php
																			}else if($data['penghasilan']=='5.000.000-7.000.000'){
																			?>
																				<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
																				<option value="< 1.000.000">< 1.000.000</option>
																				<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
																				<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
																				<option value="> 7.000.000">> 7.000.000</option>
																			<?php
																			}else if($data['penghasilan']=='> 7.000.000'){
																			?>
																				<option value="> 7.000.000">> 7.000.000</option>
																				<option value="< 1.000.000">< 1.000.000</option>
																				<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
																				<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
																				<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
																			<?php
																			}else if($data['penghasilan']==''){
																			?>
																				<option value="< 1.000.000">< 1.000.000</option>
																				<option value="1.000.000-3.000.000">1.000.000 - 3.000.000</option>
																				<option value="3.000.000-5.000.000">3.000.000 - 5.000.000</option>
																				<option value="5.000.000-7.000.000">5.000.000 - 7.000.000</option>
																				<option value="> 7.000.000">> 7.000.000</option>
																			<?php
																			}
																		?>
																	</select>
																</div>
															</div>
															
															<div class="row2nd">
																<div class="col-1nd">
																	<label class="">Alamat Orangtua</label>
																</div>
																<div class="col-2nd">
																	<textarea name="alamat_orangtua_update" placeholder="Masukan alamat lengkap..." style="height:100px;" maxlength="80" required><?php echo $data['alamat_orangtua']; ?></textarea>
																</div>
															</div>
															
															<div class="row2nd" style="padding-bottom:5px;margin-bottom:5px;">
																<div class="col-1nd">
																	<label class="">Telp Orangtua</label>
																</div>
																<div class="col-2nd">
																	<input type="text" name="telp_orangtua_update" maxlength="12" pattern="^\d{12}$" title="12 Digit Nomor Telepon" value="<?php echo $data['telp_orangtua']; ?>" required>
																</div>
															</div>
															<input type="submit" style="float:right;" value="Ubah Data">
														</div>
													</div>
													</form>
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
										<a href="proses/proses_delete_siswa.php?nisn=<?php echo $data['nisn']; ?>" onclick="return confirm('Yakin Hapus?')">
											<button class="button-merah">
												<i class="fa fa-trash fa-lg"></i>
											</button>
										</a>
										
									</td>
								</tr>
						<?php
						$nomor++;
							}
						}else{
							echo "<tr><td colspan='6' align='center'> Data tidak ditemukan! </td></tr>";
						}
						?>
						</tbody>
					</table>
					<?php
					
					// jika $_POST['Cari'] Kosong
					if(!empty($_POST['cari'])){
						// tampilkan jumlah data pencarian
						$jml = mysqli_num_rows(mysqli_query($connect, $query_jml));
						echo "<p style='padding-left:10%;'>Data Pencarian : $jml</p>";
					}else{
						// tampilkan jumlah data
						$jml= mysqli_num_rows(mysqli_query($connect, $query_jml));
						echo "<p style='padding-left:10%;'>Jumlah Data : $jml</p>";
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
					<?php }?>
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
