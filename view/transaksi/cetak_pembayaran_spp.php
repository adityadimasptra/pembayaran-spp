<html>
	<head>
		<title>Print Document</title>
			<link href="style.css" type="text/css" rel="stylesheet" />
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
	?>
	<table width="90%" align="center">
		<td width="150"><img src="../../images/favicon.jpg" style="width:150px;border-radius:;"></td>
		<td>
			<center>
				<h2 syle="margin:0 0 0 0;">SMP PERWIRA JAKARTA 1986</h2>
				<p>Jl. H. Dilun No. 4 Ulujami, Ulujami, Kec. Pesanggrahan, Kota Jakarta Selatan Prov. D.K.I. Jakarta | 021 7341719</p>
			</center>
		</td>
	</table>
	<hr style="border:solid 3px;">	
	<?php 
	$tahun_ajaran = $_GET['th_ajaran'];
	$nisn = $_GET['nisn'];
	$sql_siswa = mysqli_query($connect,"SELECT * 	FROM 
																								detil_siswakelas ds,
																								tb_siswa s,
																								tb_biayaspp b,
																								tb_kelas k
																								WHERE
																								ds.nisn = s.nisn
																								AND ds.id_biayaspp = b.id_biayaspp
																								AND ds.id_kelas = k.id_kelas
																								AND ds.nisn='$nisn'");
	$data_siswa = mysqli_fetch_array($sql_siswa);
	?>
	<table width="100%" style="border-collapse:collapse;">
		<tr>
			<td colspan="2"><center><h3>Bukti Pembayaran SPP</h3></center></td>
		</tr>
		<tr>
			<td width="100px;">Nisn</td>
			<td>: <?php echo $data_siswa['nisn'] ?></td>
		</tr>
		<tr>
			<td>Nama Siswa</td>
			<td>: <?php echo $data_siswa['nm_siswa'] ?></td>
		</tr>
		<tr>
			<td>Kelas Siswa</td>
			<td>: <?php echo $data_siswa['nm_kelas'] ?></td>
		</tr>
		<tr>
			<td>Angkatan</td>
			<td>: <?php echo $data_siswa['angkatan'] ?></td>
		</tr>
		<tr>
			<td>Tahun Ajaran</td>
			<td>: <?php echo $data_siswa['tahun_ajaran']; ?></td>
		</tr>
		
	</table>
	<br>
		<table border="1" width="100%" style="border-collapse:collapse;" align="center">
				<tr>
						<th><center>NO</center></th>				
						<th>Bulan</th>
						<th>Biaya SPP</th>
						<th>Jatuh Tempo</th>
						<th>Tanggal Bayar</th>	
						<th>Keterangan</th>
				 </tr>
					<?php $query_tagihan = mysqli_query($connect,"SELECT * 
																												FROM 
																													tb_pembayaranspp spp,
																													detil_siswakelas ds,
																													tb_siswa s,
																													tb_kelas k,
																													tb_biayaspp b
																												WHERE ds.nisn = s.nisn
																												AND ds.id_biayaspp = b.id_biayaspp
																												AND ds.id_kelas = k.id_kelas
																																		
																												AND spp.nisn = ds.nisn
																												AND spp.id_biayaspp = ds.id_biayaspp
																												AND spp.id_kelas = ds.id_kelas
																												
																												AND tahun_ajaran ='$tahun_ajaran'
																												AND spp.nisn='$nisn' ORDER BY no_pemspp ASC");
					$no = 0;
					while($hasil = mysqli_fetch_array($query_tagihan)){ 
					$no++;
					?>
					<tr>
						<td><center><?php echo $no;?></center></td>												
						<td><center><?php echo $hasil['bulan'];?></center></td>
						<td><center><?php echo rupiah($hasil['biaya_spp']);?></center></td>
						<td><center><?php echo date('d-m-Y', strtotime($hasil['jatuh_tempo']));?></center></td>
						<td><center><?php if($hasil['tgl_pemspp']!=''){
							echo date('d-m-Y', strtotime($hasil['tgl_pemspp'])); 
							}else{
								echo "-";
							}?>
						</center></td>
						<td><center><?php echo $hasil['keterangan'];?></center></td>
					</tr>
					<?php } ?>
			</table>
			<br>
			
			<p><i>
				Pembayaran SPP selambat-lambatnya pada tanggal 10 setiap bulannya.<Br>
				Tiga bulan berturut-turut belum melunasi Pemayaran SPP dianggap mengundurkan diri dan dicoret dari sekolah.
			</i></p><br>
			<table border="0" width="90%" style="border-collapse:collapse;" align="center">
				<tr>
					<td style="padding-left:60%;">Jakarta, <?php echo date('d F Y'); ?></td>
				</tr>
				<tr>
					<td style="padding-top:20%;padding-left:59%;">(_________________)</td>
				</tr>

			</table>
			<script>
			window.load = print_d();
			function print_d(){
				window.print();
			}
		</script>
	</body>
</html>