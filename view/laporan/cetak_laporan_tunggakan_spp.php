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
			$id_kelas = $_GET['kelas'];
			$th_ajaran = $_GET['th_ajaran'];
			$tgl_sekarang = date('Y-m-d');
			//$tgl_sekarang = date('2018-12-10');
			$sql_kelas = mysqli_query($connect,"SELECT * FROM tb_kelas WHERE id_kelas='$id_kelas'")or die(mysqli_error($connect));
			$data_kelas = mysqli_fetch_array($sql_kelas);
			
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
																														AND k.id_kelas = '$id_kelas' 
																														AND tahun_ajaran ='$th_ajaran'")
																														or die (mysqli_error($connect));
			$total = mysqli_fetch_array($query_total);
		?>
	<table border="0" width="100%">
		<tr>
			<td colspan="2"><center><h3>Laporan Tunggakan Pembayaran SPP</h3></center><br></td>
		</tr>
		<tr>
			<td width="130px">ID Kelas</td>			
			<td>: <?php echo $id_kelas; ?></td>
		</tr>
		<tr>
			<td width="">Nama Kelas</td>			
			<td>: <?php echo $data_kelas['nm_kelas']; ?></td>
		</tr>
		<tr>
			<td width="">Tahun Ajaran</td>			
			<td>: <?php echo $th_ajaran; ?></td>
		</tr>
		<tr>
			<td width="">Total Tunggakan</td>			
			<td>: <?php echo rupiah($total['total']); ?></td>
		</tr>
	</table><br>
		<table border="1" width="100%" style="border-collapse:collapse;" align="center">
				<tr>
							<th><center>No</center></th>				
							<th>NISN</th>
							<th>Nama Siswa</th>
							<th>Bulan</th>
							<th>Biaya SPP</th>
				 </tr>
					<?php 
						$lap_tunggakan = mysqli_query($connect,"SELECT p.nisn as siswa, nm_siswa, p.id_kelas as kelas,  bulan, jatuh_tempo, biaya_spp 
																										FROM 
																											tb_pembayaranspp p,
																											detil_siswakelas ds,
																											tb_biayaspp b,
																											tb_kelas k,
																											tb_siswa s
																										WHERE p.nisn = ds.nisn
																											AND ds.id_biayaspp = b.id_biayaspp
																											AND ds.nisn = s.nisn
																											AND ds.id_kelas = k.id_kelas
																													
																											AND jatuh_tempo < '$tgl_sekarang'
																											AND tgl_pemspp is null
																											AND k.id_kelas = '$id_kelas' 
																											AND tahun_ajaran = '$th_ajaran'
																											ORDER BY nm_siswa") or die (mysqli_error($connect));
						$no = 0;
						while($hasil = mysqli_fetch_array($lap_tunggakan)){ 
						$no++;
					?>
					<tr>
						<td><center><?php echo $no;?></center></td>												
						<td><center><?php echo $hasil['siswa'];?></center></td>
						<td><center><?php echo $hasil['nm_siswa'];?></center></td>
						<td><center><?php echo $hasil['bulan'];?></center></td>
						<td><center><?php echo rupiah($hasil['biaya_spp']);?></center></td>
					</tr>
					<?php } ?>
			</table>
			<br>
			<table border="0" width="90%" style="border-collapse:collapse;" align="center">
				<tr>
					<td style="padding-left:60%;">Jakarta, <?php echo date('d M Y'); ?></td>
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