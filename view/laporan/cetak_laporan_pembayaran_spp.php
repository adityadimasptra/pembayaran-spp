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

			$lap_pembayaranspp = mysqli_query($connect,"SELECT * 	FROM 
																														tb_pembayaranspp ds,
																														tb_biayaspp b,
																														tb_siswa s
																														WHERE
																														ds.id_biayaspp = b.id_biayaspp
																														AND ds.nisn = s.nisn
																														AND tgl_pemspp between '$dari_periode' AND '$hingga_periode'
																														ORDER BY tgl_pemspp desc");
			$no = 0;
			$query_total = mysqli_query($connect,"SELECT sum(biaya_spp) as total 	FROM 
																												tb_pembayaranspp ds,
																												tb_biayaspp b
																												WHERE
																												ds.id_biayaspp = b.id_biayaspp
																												AND tgl_pemspp between '$dari_periode' AND '$hingga_periode'");
			$total = mysqli_fetch_array($query_total);
		?>
		<table border="0" width="100%" style="border-collapse:collapse;" align="center">
			<tr>
				<td colspan="2"><center><h3>Laporan Pembayaran SPP</h3></center></td>
			</tr>
			<tr>
				<td width="100">Periode</td>
				<td>: <?php echo tanggal($dari_periode).' s/d '.tanggal($hingga_periode); ?></td>
			</tr>
			<tr>
				<td>Total</td>
				<td>: <?php echo rupiah($total['total']); ?>,-</td>
			</tr>
		</table>
		<br>
		<table border="1" width="100%" style="border-collapse:collapse;" align="center">
			<thead>
				<tr>
						<th><center>No</center></th>
						<th>NISN</th>
						<th>Nama Siswa</th>
						<th>No SPP</th>
						<th>Tanggal	</th>
						<th>Biaya SPP</th>
				</tr>
			</thead>
					<?php 
						while($hasil = mysqli_fetch_array($lap_pembayaranspp)){ 
						$no++;
					?>
					<tr>
						<td><center><?php echo $no;?></center></td>												
						<td><center><?php echo $hasil['nisn'];?></center></td>
						<td style="padding-left:5px;"><?php echo $hasil['nm_siswa'];?></td>
						<td><center><?php echo $hasil['no_pemspp'];?></center></td>
						<td><center><?php echo tanggal($hasil['tgl_pemspp']);?></center></td>
						<td><center><?php echo rupiah($hasil['biaya_spp']);?></center></td>
					</tr>
					<?php }
					?>
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