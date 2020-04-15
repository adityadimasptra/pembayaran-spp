<?php 
// koneksi database
include '../../../koneksi/koneksi.php';
 
// mengambil data dari frm_update_siswa.php
$nisn	= $_GET['nisn'];
$th_ajaran	= $_GET['th_ajaran'];

// menghapus data siswa
$cek_pembayaran = mysqli_query($connect,"SELECT * FROM tb_pembayaranspp WHERE nisn = '$nisn'");
$available_pembayaran = mysqli_num_rows($cek_pembayaran);

if($available_pembayaran > 0){
	echo "<script>
					alert('Gagal, karena siswa sedang aktif kelas');
					window.location='../frm_detsiswa.php?halaman=1';
				</script>";
}else{
	$query_delete = mysqli_query($connect,"DELETE FROM detil_siswakelas WHERE nisn='$nisn' AND tahun_ajaran ='$th_ajaran'");
	echo "<script>
					alert('Berhasil, dihapus');
					window.location='../frm_detsiswa.php?halaman=1';
				</script>";
}

// mengalihkan halaman kembali ke index.php

?>