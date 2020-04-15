<html>
	<head>
		<title>Halaman Pembayaran SPP</title>
		<style>
        .tt-dropdown-menu {
            width: 200px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
						font-size:12px;
            color: #111;
            background-color: #F1F1F1;
        }
    </style>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../../style/istyle.css">		 
		<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    	<!-- <script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script> -->
    
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
			<h1>&nbsp;Pembayaran SPP</h1>
			<hr>
				<div class="container">
					<div class="column" style="width:100%;">	
						<form name="pencarian" method="post">
						
							<div class="row2nd" style="padding-bottom:10px;">
								<div class="col-1" style="width:40%;">
									<label style="float:right;padding-right:37px;">NISN Siswa</label>
								</div>
								<div class="col-2" style="width:50%;">
									<input type="text" name="nisn" class ="siswa" title="Gunakan NISN 10 Digit" pattern="^\d{10}$" maxlength="10" placeholder="Masukan NISN Siswa" style="width:;" required />
								</div>
							</div>
							<div class="row2nd" style="padding-bottom:10px;">
								<div class="col-1" style="width:40%;">
									<label style="float:right;padding-right:26px;">Tahun Ajaran</label>
								</div>
								<div class="col-2" style="width:50%;">									
									<select name="th_ajaran" style="width:185px;" required>
										<option value=""> Pilih</option>
										<?php 
											$query_tajaran = mysqli_query($connect,"SELECT tahun_ajaran FROM detil_siswakelas group by tahun_ajaran");
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
					</div>
					

						<?php
							if(isset($_POST['nisn']) && $_POST['nisn']!='' ){
								$nisn = $_POST['nisn'];
								$tahun_ajaran = $_POST['th_ajaran'];
								$sql_siswa = mysqli_query($connect,"SELECT * 	FROM 
																															detil_siswakelas ds,
																															tb_siswa s,
																															tb_biayaspp b,
																															tb_kelas k
																															WHERE
																															ds.nisn = s.nisn
																															AND ds.id_biayaspp = b.id_biayaspp
																															AND ds.id_kelas = k.id_kelas
																															AND tahun_ajaran = '$tahun_ajaran'
																															AND ds.nisn='$nisn'");
								$data_siswa = mysqli_fetch_array($sql_siswa);
								$available = mysqli_num_rows($sql_siswa);
								if($available > 0 ){
							?>
							<hr>
							<center><h3>Biodata</h3></center>
							<div class="row2nd">
								<div class="col-1" style="width:50%;">
									<label for="nama_lengkap" style="float:right;padding-right:70px;">NISN</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label>: <?php echo $data_siswa['nisn'];  ?></label>
								</div>
							</div>
							
							<div class="row2nd">
								<div class="col-1" style="width:50%;">
									<label for="nama_lengkap" style="float:right;padding-right:26px;">Nama Siswa</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label>: <?php echo $data_siswa['nm_siswa'] ?></label>
								</div>
							</div>
							
							<div class="row2nd">
								<div class="col-1" style="width:50%;">
									<label for="nama_lengkap" style="float:right;padding-right:69;">Kelas</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label>: <?php echo $data_siswa['nm_kelas'] ?></label>
								</div>
							</div>
							
							<div class="row2nd">
								<div class="col-1" style="width:50%;">
									<label for="nama_lengkap" style="float:right;padding-right:44px;">Angkatan</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label>: <?php echo $data_siswa['angkatan'] ?></label>
								</div>
							</div>
							
							<div class="row2nd" style="padding-bottom:20px;">
								<div class="col-1" style="width:50%;">
									<label for="nama_lengkap" style="float:right;padding-right:20px;">Tahun Ajaran</label>
								</div>
								<div class="col-2" style="width:50%;">
									<label>: <?php echo $data_siswa['tahun_ajaran']; ?></label>
								</div>
							</div>
						

						<div class="column" style="width:100%;margin:0px;:;background-color:;">
						<hr>
							<center><h3>Tagihan Pembayaran SPP</h3></center>
								<table class="fixed-th" style="margin-left:10px;width:98%;">
									<thead>
										<tr>
											<th><center>NO</center></th>				
											<th>No Pembayaran SPP</th>
											<th>Bulan</th>
											<th>Jatuh Tempo</th>
											<th>Biaya SPP</th>
											<th>Tanggal Bayar</th>						
											<th>Action</th>
										</tr>
									</thead>
									
									<tbody>
									<?php
									// query pembayaran spp tb_pembayaran spp
									$query_tagihan = mysqli_query($connect,"SELECT * 	
																													FROM 
																														tb_pembayaranspp spp,
																														detil_siswakelas ds,
																														tb_siswa s,
																														tb_kelas k,
																														tb_biayaspp b
																													WHERE 
																														ds.nisn = s.nisn
																													AND ds.id_biayaspp = b.id_biayaspp
																													AND ds.id_kelas = k.id_kelas
																													
																													AND spp.nisn = ds.nisn
																													AND spp.id_biayaspp = ds.id_biayaspp
																													AND spp.id_kelas = ds.id_kelas
																													
																													AND tahun_ajaran ='$tahun_ajaran'
																													AND spp.nisn='$nisn' ORDER BY no_pemspp ASC");
									$no = 0;
									$query_data_akhir = mysqli_query($connect,"SELECT * FROM 	tb_pembayaranspp spp,
																																			detil_siswakelas ds
																																WHERE spp.nisn = ds.nisn
																																AND spp.nisn='$nisn' 
																																AND status='AKTIF' 
																																AND tgl_pemspp is null 
																																ORDER BY jatuh_tempo ASC LIMIT 1");
																																
									$jml_data_akhir = mysqli_fetch_array($query_data_akhir);
									
									$data_akhir = tanggal($jml_data_akhir['jatuh_tempo']);
									while($data_tagihan = mysqli_fetch_array($query_tagihan)){
										$no++;
									?>
										<tr>
											<td><center><?php echo $no?></center></td>
											<td><center><?php echo $data_tagihan['no_pemspp'];?></center></td>												
											<td><center><?php echo $data_tagihan['bulan'];?></center></td>
											<td><center><?php echo tanggal($data_tagihan['jatuh_tempo']);?></center></td>
											<td><center><?php echo rupiah($data_tagihan['biaya_spp']);?></center></td>
											<td><center><?php if($data_tagihan['tgl_pemspp']!=''){
												echo tanggal($data_tagihan['tgl_pemspp']); 
												}else{
													echo "-";
												}?>
												</center></td>
											<td>
												<?php
													if($data_tagihan['tgl_pemspp']==''){?>
														<a href="proses/proses_pembayaran_spp.php?nisn=<?php echo $nisn;?>&no=<?php echo $data_tagihan['no_pemspp'];?>" onclick="return confirm('Ingin melakukan Pembayaran SPP ?')"><center><button class='button-bayar' style='float:none;'>Bayar <i class="fa fa-thumbs-o-up"></i></button></center></a>
													<?php
													}else{
														echo "<center>LUNAS</center>";
													}
												}?>
											</td>
										</tr>
										<tr>
											<td colspan="8"><button style="margin-left:5%" onClick="print_d()"><i class="fa fa-print"></i> Cetak</button></td>	
										</tr>
										<tr>
											<td colspan="8" style="text-align:left;"><p style="color:red;">*Jatuh Tempo Pembayaran SPP setiap tanggal <b>10</b> setiap bulannya</p></a></td>
										</tr>
									<?php 
									}else{
										echo '<center>Data Tidak Ditemukan</center>';
										}							
									?>			
								</tbody>
							</table>
						</div>
							<?php
								}
							?>			
				</div>
			</div>
    <script>
        // $(document).ready(function() {

        //     $('input.siswa').typeahead({
        //         name: 'siswa',
        //         remote: 'proses/proses_autocomplete.php?query=%QUERY'
        //     });

        // })
    </script>			
		<script>
		// fungsi print
				function print_d(){
					window.open("cetak_pembayaran_spp.php?nisn=<?php echo $nisn;?>&th_ajaran=<?php echo $tahun_ajaran; ?>","_blank");
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