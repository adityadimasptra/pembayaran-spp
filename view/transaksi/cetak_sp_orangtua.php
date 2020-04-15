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
				<p>Jl. H. Dilun No. 4 Ulujami, Ulujami, Kec. Pesanggrahan, Kota Jakarta Selatan Provinsi D.K.I. Jakarta | 021 7341719</p>
			</center>
		</td>
	</table>
	<hr style="border:solid 3px;">
		<?php 
		$no_spo = $_GET['no_spo'];
		$query = "SELECT 
								spo.no_speringatan, s.nisn as nisn, nm_siswa, k.id_kelas as id_kelas, nm_kelas, spp.no_pemspp as no_pemspp, bulan, jatuh_tempo, keterangan
							FROM 
								sp_orangtua spo,
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
							AND		spo.no_speringatan = spt.no_speringatan
							AND		no_spanggilan = '$no_spo'";

		$query_sptunggakan = mysqli_query($connect, $query) or die(mysqli_error($connect));
		$getA = mysqli_fetch_array($query_sptunggakan);
		$get_nama = $getA['nm_siswa'];
		$get_kelas = $getA['nm_kelas'];
		$get_nisn = $getA['nisn'];
		?>
	<label style="margin:0px 0px 0px 0px;">No SPO </label><label>: <?php echo $no_spo; ?></label><br>
	<label style="margin:0px 28px 0px 0px;">Hal </label><label>: Surat Panggilan Orang Tua</label><br><br>
	<label style="margin:0px 0px 0px 0px;">Kepada</label><br>
	<label style="margin:0px 0px 0px 0px;">Yth. Bpk/ Ibu Orang Tua/ Wali Murid</label><br>
	<label style="margin:0px 0px 0px 0px;">SMP PERWIRA JAKARTA</label><br>
	<label style="margin:0px 0px 0px 0px;">di. Tempat</label><br>
	<label style="margin:0px 0px 0px 0px;">Dengan hormat,</label><br>
	<p align="justify"> Dengan ini kami mengharapkan kehadiran Bpk/Ibu Orang Tua/ Wali Murid</p>
	<label style="margin-left:30px;margin-right:67px;">NISN </label><label>: <?php echo $get_nisn; ?></label><br>
	<label style="margin-left:30px;margin-right:28px;">Nama Siswa</label>: <?php echo $get_nama; ?><br>
	<label style="margin-left:30px;margin-right:30px;">Kelas Siswa</label>: <?php echo $get_kelas;?>
	<p style="text-indent:0px; text-align:justify;">Untuk datang ke sekolah dengan maksud undangan Pembayaran SPP yang belum di bayarkan atau Pembayaran SPP yang telah menunggak.</p>
	<p style="text-indent:30px; text-align:justify;">Demi tercapainya pemmbinaan putra/putri Bpk/ Ibu dalam pendidikannya maka kami sangat mengharapkan untuk hadir ke Sekolah. Demikianlah kami sampaikan kepada Bpk/ Ibu atas bantuan dan perhatiannya, kami ucapkan terima kasih.</p>
	<br>
		<table border="0" width="90%" align="center">
			<tr>
				<td style="padding-left:60%;" >Jakarta, <?php echo date('d F Y'); ?></td>
			</tr>
			<tr>
				<td style="padding-top:20%;padding-left:59%;">(_________________)</td>
				
			</tr>
			<tr>
				<td style="padding-left:66%;"><label><?php echo $_SESSION['nm_admin']; ?></label></td>
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