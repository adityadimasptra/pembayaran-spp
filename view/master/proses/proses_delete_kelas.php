<?php 
	// koneksi database
	include '../../../koneksi/koneksi.php';
	 
	// mengambil data dari frm_biaya.php
	$id	= $_GET['id'];

	$query = mysqli_query($connect,"SELECT * FROM detil_siswakelas WHERE id_kelas='$id' ");
	$availabel = mysqli_num_rows($query);
	if ($availabel > 0 ){
		echo "<script>
						alert('Tidak dapat dihapus, Kelas telah digunakan!');
						window.location='../frm_kelas.php?halaman=1';
					</script>";
	}else{
	// menghapus data siswa
		$query_delete = mysqli_query($connect,"DELETE FROM tb_kelas WHERE id_kelas='$id'"); 
				echo "<script>
								alert('Kelas Berhasil dihapus');
								window.location='../frm_kelas.php?halaman=1';
							</script>";
	}
?>