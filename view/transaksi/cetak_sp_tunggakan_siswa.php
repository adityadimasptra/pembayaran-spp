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
			$no_spt = $_GET['nospt'];
			$query = "SELECT 
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
								AND		spt.no_speringatan = '$no_spt'";

			$query_sptunggakan = mysqli_query($connect, $query) or die(mysqli_error($connect));
			$getA = mysqli_fetch_array($query_sptunggakan);
			$get_nisn 		= $getA['nisn'];
			$get_nama 		= $getA['nm_siswa'];
			$get_idkelas	= $getA['id_kelas'];
			$get_kelas 		= $getA['nm_kelas'];
			$get_nisn 		= $getA['nisn'];
			$get_thajaran = $getA['tahun_ajaran'];

			// menghitung jumlah bulan tunggakan
			$jumlah = mysqli_num_rows($query_sptunggakan);
			// bulan tunggakan awal
			$bulan_awal = mysqli_query($connect,$query."ORDER BY no_pemspp ASC LIMIT 1");
			$data_bulanawal = mysqli_fetch_array($bulan_awal);

			// bulan tunggakan akhir
			$bulan_akhir = mysqli_query($connect,$query."ORDER BY no_pemspp DESC LIMIT 1");
			$data_bulanakhir = mysqli_fetch_array($bulan_akhir);

			$tgl_sekarang = date('Y-m-d');
			//$tgl_sekarang = date('2018-12-10');

			//hitung jumlah tunggakan
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
																									AND ds.nisn = '$get_nisn'
																									AND k.id_kelas = '$get_idkelas' 
																									AND tahun_ajaran ='$get_thajaran'")
																									or die (mysqli_error($connect));
			$data_total = mysqli_fetch_array($query_total);
			$total = $data_total['total'];
		?>
		<label style="margin:0px 0px 0px 0px;">No SPT </label><label>: <?php echo $no_spt; ?></label><br>
		<label style="margin:0px 28px 0px 0px;">Hal </label><label>: Surat Peringatan Tunggakan Pembayaran SPP</label><br><br>
		<label style="margin:0px 0px 0px 0px;">Kepada</label><br>
		<label style="margin:0px 0px 0px 0px;">Yth. Bpk/ Ibu Orang Tua/ Wali Murid</label><br>
		<label style="margin:0px 0px 0px 0px;">SMP PERWIRA JAKARTA</label><br>
		<label style="margin:0px 0px 0px 0px;">di. Tempat</label><br>
		<label style="margin:0px 0px 0px 0px;">Dengan hormat,</label><br>
		<p align="justify"> Sehubung dengan hasil pemantauan kami, bila anak Bpk/ Ibu Orang Tua/ Wali Murid :</p>
		<label style="margin-left:30px;margin-right:67px;">NISN </label><label>: <?php echo $get_nisn; ?></label><br>
		<label style="margin-left:30px;margin-right:28px;">Nama Siswa</label>: <?php echo $get_nama; ?><br>
		<label style="margin-left:30px;margin-right:30px;">Kelas Siswa</label>: <?php echo $get_kelas;?>
		<p align="justify"> Masih menunggak Pembayaran SPP selama <?php echo $jumlah; ?> bulan, dari bulan <b><?php echo $data_bulanawal['bulan'].'</b> sampai bulan <b>'.$data_bulanakhir['bulan'] ?></b> sebanyak <i><?php echo rupiah($total); ?>,-</i> </p>
		<p style="text-indent:30px; text-align:justify;">Kami sangat prihatin, mengingat kelangsungan sekolah kita yang berstatus sekolah swasta yang harus membayar segala kebutuhan operasional sekolah dan gaji guru. Dalam hal ini kami sangat mengharapkan bantuan dan dukungan dari Bapak/ Ibu agar dapat segera membayar dan menyelesaikan uang tunggakan SPP sebesar tersebut diatas.</p>
		<p style="text-indent:30px; text-align:justify;">Demikianlah kami sampaikan kepada Bpk/ Ibu atas bantuan dan perhatiannya, kami ucapkan terima kasih.</p>
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