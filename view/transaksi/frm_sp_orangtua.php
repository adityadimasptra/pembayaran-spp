<html>
	<head>
		<title>Halaman Surat Panggilan Orangtua</title>
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
				<h1>&nbsp;Surat Panggilan Orangtua</h1>
			<hr>
			<a href="frm_entry_sp_orangtua.php?halaman=1"><button class="button-link" style="margin:0px 80px 5px;">Buat SP Orangtua</button></a>
			<table class="fixed-th" style="margin-left:100px; width:80%;">
				<thead>
					<tr>
						<th>No</th>
						<th>No SP Orangtua</th>
						<th>No SP Tunggakan</th>
						<th>Tanggal</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					// menghubungkan koneksi database				
					$batas = 10;
					$posisi = cariPosisi($batas);
					
					$result = mysqli_query($connect,"SELECT no_spanggilan, no_speringatan, tgl_spanggilan FROM sp_orangtua ORDER BY no_spanggilan desc");
					$jml_record = mysqli_num_rows($result);
					
					// mengambil data kelas
					$cari = mysqli_query($connect,"SELECT no_spanggilan, no_speringatan, tgl_spanggilan FROM sp_orangtua order by no_spanggilan asc LIMIT $posisi, $batas  ") or die (mysqli_error($connect));
					$nomor = $posisi + 	1;					
					
					if($jml_record > 0){
						// menampilkan data dari tabel sp_tunggakan
						while($row=mysqli_fetch_array($cari)){
						$no_speringatan = $row['no_speringatan'];
						$query_sptunggakan = mysqli_query($connect, "SELECT 
																														spt.no_speringatan, s.nisn as nisn, nm_siswa, k.id_kelas as id_kelas, nm_kelas, spp.no_pemspp as no_pemspp, bulan, jatuh_tempo, tahun_ajaran, keterangan
																													FROM 
																														sp_orangtua spo,
																														sp_tunggakan spt,
																														tb_pembayaranspp spp,
																														detil_siswakelas ds,
																														tb_siswa s,
																														tb_kelas k
																													WHERE
																															ds.nisn = s.nisn
																													AND ds.id_kelas = k.id_kelas
																													AND ds.nisn = spp.nisn
																													AND ds.id_kelas = spp.id_kelas
																													AND spt.no_pemspp = spp.no_pemspp
																													AND spo.no_speringatan = spt.no_speringatan") or die(mysqli_error($connect));
						$getA = mysqli_fetch_array($query_sptunggakan);
						$get_nama = $getA['nm_siswa'];
						$get_kelas = $getA['nm_kelas'];
						$get_nisn = $getA['nisn'];
					?>
					<tr>
							<td><?php echo $nomor;?></td>
							<td><?php echo $row['no_spanggilan']; ?></td>
							<td><?php echo $row['no_speringatan']; ?></td>
							<td><?php echo $row['tgl_spanggilan']; ?></td>
							<td><a href="cetak_sp_orangtua.php?no_spo=<?php echo $row['no_spanggilan']; ?>" target="_BLANK"><button class="button-abu">Cetak</button></a></td>
							
						</tr>
				<?php
						$nomor++;
					} 
				?>
					<?php
					}else{ 
					?>
						<td colspan="5">Tidak ada Data Surat Panggilan Orangtua</td>
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