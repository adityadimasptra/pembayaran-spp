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
<br><br>

<?php
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
	$j=0;
	$awal_tempo = date('Y').'-07-10';
	$tgl_skrg = '2020-07-10';
	
	$jatuh_tempo = date("Y-m-d", strtotime("+$j m", strtotime($awal_tempo)));
	$bln = $bulan[date('m', strtotime($jatuh_tempo))]." ".date('Y', strtotime($jatuh_tempo));
	echo $jatuh_tempo.'<br>';
	echo $awal_tempo.'<br>';
	echo $bln;
?>
	
<br><br>



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
<table>
	<thead>
		<th>ID Siswa</th>
		<th>Nama Siswa</th>
		<th>Kelas</th>
		<th>Jumlah Bulan</th>
		<th>Total</th>
		<th>Action</th>
	</thead>
	<tbody>
<?php
include 'koneksi/koneksi.php';
	$awal_tempo		= '2018-06-10';
	$tgl_sekarang = '2018-12-10';
	$id_kelas = 'K0001';
	$th_ajaran = '2016/2017';
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
	echo "Tanggal Sekarang : ".$tgl_sekarang;
	echo '<br>';
	//$sql = mysqli_query($connect,"SELECT * FROM tb_pembayaranspp WHERE jatuh_tempo < '$tgl_sekarang' and id_kelas ='K0001' and tgl_pemspp is null");
	$sql = mysqli_query($connect, "SELECT p.id_siswa as siswa, nm_siswa, nm_kelas as kelas, tahun_ajaran, count(bulan) as jml_bulan, sum(biaya_spp) as total FROM 
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
																													AND tahun_ajaran = '$th_ajaran'
																													GROUP BY siswa, nm_siswa, kelas") or die (mysqli_error($connect)); 
	$available= mysqli_num_rows($sql);
	if($available > 0){	
		while($data = mysqli_fetch_array($sql)){
			?>
			<tr>
				<td><?php echo $data['siswa'];?></td>
				<td><?php echo $data['nm_siswa'];?></td>
				<td><?php echo $data['kelas'];?></td>
				<td><?php echo $data['tahun_ajaran'];?></td>
				<td><?php echo $data['jml_bulan']?></td>
				<td><?php echo $data['total'];?></td>
				<td><a href="frm_detil_tagihan.php?id_siswa=<?php echo $data['siswa']?>&th_ajaran=<?php echo $th_ajaran;?>&kelas=<?php echo $id_kelas;?>"><button class="button-coklat">Lihat Tagihan</button></a></td>
			</tr>
		<?php 
		}
		$query_total = mysqli_query($connect,"SELECT sum(biaya_spp) as total 	
																													FROM 
																															tb_pembayaranspp p,
																															detil_siswakelas ds,
																															tb_biayaspp b,
																															tb_kelas k
																													WHERE p.id_siswa = ds.id_siswa
																															AND ds.id_biayaspp = b.id_biayaspp
																															AND ds.id_kelas = k.id_kelas
																															
																															AND jatuh_tempo < '$tgl_sekarang'
																															AND tgl_pemspp is null
																															AND k.id_kelas = '$id_kelas' 
																															AND tahun_ajaran ='$th_ajaran'")
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
			<td colspan="5"><center>Total Tunggakan <?php echo $total['total'];?> </center></td>
		</tr>
	</tbody>
</table>