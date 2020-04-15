<?php 
// koneksi database
include '../../../koneksi/koneksi.php';
 
// mengambil data dari frm_update_siswa.php
$nisn	= $_GET['nisn'];

// menghapus data siswa
$cek_detsiswa = mysqli_query($connect,"SELECT * FROM detil_siswakelas WHERE nisn = '$nisn'");
$available_detsiswa = mysqli_num_rows($cek_detsiswa);
if($available_detsiswa > 0){
	echo "<script>
					alert('Gagal, karena siswa tersebut masih dalam data Siswa Kelas');
					window.location='../frm_siswa.php?halaman=1';
				</script>";
}else{
	$query_delete = mysqli_query($connect,"DELETE FROM tb_siswa WHERE nisn='$nisn'");
	echo "<script>
					alert('Berhasil, dihapus');
					window.location='../frm_siswa.php?halaman=1';
				</script>";
}

// mengalihkan halaman kembali ke index.php
 
?>