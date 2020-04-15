<?php
//ambil tanggal tahun bulan menit deti dll
$date_now = getdate();
/* Array ( 	[seconds] => 59 
						[minutes] => 39 
						[hours] => 1 
						[mday] => 25 
						[wday] => 1 
						[mon] => 6 
						[year] => 2018 
						[yday] => 175 
						[weekday] => Monday 
						[month] => June 
						[0] => 1529905199 ) */
echo $date_now['mday'].'-'.$date_now['month'].'-'.$date_now['year'];
echo "<br>";
$tahun_ajaran = 1;
echo $tahun_ajaran;
?>



<h2>Tahun Ajaran Filled </h2>

<select name="tahun">
	<?php
	$thn_skr = date('Y');
	$batas = 2;
	$x = $thn_skr + $batas;
	$thn_sblm = $x - 1;
	while($x >= $thn_skr - $batas){
		?>
			<option value="<?php echo $x ?>"><?php echo $thn_sblm.'/'. $x; ?></option>
		<?php
		$x--;
		$thn_sblm--;
	}
	?>           
</select>
<br>
		<h2>TUNGGAKAN PEMBAYARAN SPP </h2>
<table border="1">
	<thead>
		<th>No Pembayaran</th>
		<th>Bulan</th>
		<th>Jatuh_tempo</th>
		<th>Biaya SPP</th>
		<th>Jumlah Bulan</th>
	</thead>
	<tbody>
<?php
include 'koneksi/koneksi.php';
	$awal_tempo		= '2018-06-10';
	$tgl_sekarang = '2018-12-10';
	$bulan = array(	
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	);
	$id_siswa = $_GET['id_siswa'];
	$tahun_ajaran = $_GET['th_ajaran'];
	$id_kelas = $_GET['kelas'];
	$query_siswa = mysqli_query($connect,"SELECT *  FROM tb_siswa WHERE id_siswa='$id_siswa'");
	$data_siswa = mysqli_fetch_array($query_siswa);
	$query_kelas = mysqli_query($connect,"SELECT *  FROM tb_kelas WHERE id_kelas='$id_kelas'");
	$data_kelas = mysqli_fetch_array($query_kelas);
	echo "ID Siswa : ".$id_siswa;
	echo "<br>";
	echo "Nama Siswa : ".$data_siswa['nm_siswa'];
	echo "<br>";
	echo "Kelas : ".$data_kelas['nm_kelas'];
	echo "<br>";
	echo "Tahun Ajaran : ".$tahun_ajaran;
	echo "<br>";
	echo "Tanggal Sekarang : ".$tgl_sekarang;
	echo '<br>';
	//$sql = mysqli_query($connect,"SELECT * FROM tb_pembayaranspp WHERE jatuh_tempo < '$tgl_sekarang' and id_kelas ='K0001' and tgl_pemspp is null");
	$sql = mysqli_query($connect, "SELECT no_pemspp, bulan, jatuh_tempo, tahun_ajaran, biaya_spp FROM 
																													tb_pembayaranspp p,
																													detil_siswakelas ds,
																													tb_biayaspp b,
																													tb_kelas k,
																													tb_siswa s
																													WHERE
																													p.id_siswa = ds.id_siswa
																													
																													AND ds.id_biayaspp = b.id_biayaspp
																													AND ds.id_siswa = s.id_siswa
																													AND ds.id_kelas = k.id_kelas
																													
																													AND jatuh_tempo < '$tgl_sekarang'
																													AND tgl_pemspp is null
																													AND k.id_kelas = '$id_kelas'
																													AND	s.id_siswa = '$id_siswa'
																													AND tahun_ajaran = '$tahun_ajaran'
																													") or die (mysqli_error($connect)); 
	$available= mysqli_num_rows($sql);
	if($available > 0){	
		while($data = mysqli_fetch_array($sql)){
			?>
			<tr>
				<td><?php echo $data['no_pemspp'];?></td>
				<td><?php echo $data['bulan'];?></td>
				<td><?php echo $data['jatuh_tempo'];?></td>
				<td><?php echo $data['tahun_ajaran'];?></td>
				<td><?php echo $data['biaya_spp']?></td>
			</tr>
		<?php 
		}
		$query_total = mysqli_query($connect,"SELECT sum(biaya_spp) as total 	
																													FROM 
																															tb_pembayaranspp p,
																															detil_siswakelas ds,
																															tb_biayaspp b,
																															tb_kelas k,
																															tb_siswa s
																													WHERE p.id_siswa = ds.id_siswa
																															AND ds.id_biayaspp = b.id_biayaspp
																															AND ds.id_kelas = k.id_kelas
																															AND ds.id_siswa = s.id_siswa
																															
																															AND jatuh_tempo < '$tgl_sekarang'
																															AND tgl_pemspp is null
																															AND s.id_siswa = '$id_siswa'
																															AND k.id_kelas = '$id_kelas' 
																															AND tahun_ajaran ='$tahun_ajaran'")
																															or die (mysqli_error($connect));
		$total = mysqli_fetch_array($query_total);
	}else{?>
		<tr>
			<td colspan="5"><center>tidak ada Tunggakan</center></td>
		</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="5">Total Tagihan : <?php echo $total['total'];?> </td>
	</tr>
	<tr>
		<td colspan="5"><button>Buat Surat Peringatan</button> </td>
	</tr>
	</tbody>
</table>