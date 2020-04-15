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
				$dari_periode = $_GET['dari_periode'];
				$hingga_periode = $_GET['hingga_periode'];
			
				$lap_sporangtua = mysqli_query($connect,"SELECT nm_siswa, nm_orangtua, alamat_siswa, spo.no_speringatan, spo.no_spanggilan, tgl_spanggilan FROM 
																																			sp_orangtua spo,
																																			sp_tunggakan spt,
																																			tb_pembayaranspp sp,
																																			detil_siswakelas ds,
																																			tb_siswa s
																																		WHERE
																																			spo.no_speringatan = spt.no_speringatan
																																		AND
																																			spt.no_pemspp = sp.no_pemspp
																																		AND
																																			sp.nisn = ds.nisn
																																		AND
																																			ds.nisn = s.nisn
																																		AND
																																			tgl_spanggilan between '$dari_periode' AND '$hingga_periode'
																																		GROUP BY nm_siswa, nm_orangtua, alamat_siswa, spo.no_speringatan, spo.no_spanggilan, tgl_spanggilan desc ") or die(mysqli_error($connect));
				$jml_record = mysqli_num_rows($lap_sporangtua);
				$no = 0;
			?>
		<table border="0" width="100%" style="border-collapse:collapse;" align="center">
			<tr>
				<td colspan="2"><center><h2>Laporan Surat Panggilan Orangtua</h2></center></td>
			</tr>
			<tr>
				<td width="100px">Periode</td>
				<td>: <?php echo tanggal($dari_periode).' s/d '.tanggal($hingga_periode); ?></td>
			</tr>
			<tr>
				<td width="100px">Total SPO</td>
				<td>: <?php echo $jml_record; ?></td>
			</tr>
		</table>
		<br>
		<table border="1" width="100%" style="border-collapse:collapse;" align="center">
			<thead style="font-size:px;">
				<tr>
					<th><center>NO</center></th>				
					<th>Nama Siswa</th>
					<th>Nama Orangtua</th>
					<th>Alamat</th>
					<th>No SPO</th>
					<th>No SPT</th>
					<th>Tanggal SPO</th>	
				</tr>
			</thead>
				<tbody>
					<?php 
						while($hasil = mysqli_fetch_array($lap_sporangtua)){ 
						$no++;
					?>
					<tr>
													<td><center><?php echo $no;?></center></td>
													<td><center><?php echo $hasil['nm_siswa'];?></center></td>
													<td><center><?php echo $hasil['nm_orangtua'];?></center></td>
													<td><center><?php echo $hasil['alamat_siswa'];?></center></td>
													<td><center><?php echo $hasil['no_spanggilan'];?></center></td>												
													<td><center><?php echo $hasil['no_speringatan']; ?></center></td>
													<td><center><?php echo tanggal($hasil['tgl_spanggilan']);?></center></td>
					</tr>
					<?php 
						}
					?>
					</tbody>
			</table>
			<br>
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