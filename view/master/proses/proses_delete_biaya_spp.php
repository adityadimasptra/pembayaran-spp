<?php 
	// koneksi database
	include '../../../koneksi/koneksi.php';
	 
	// mengambil data dari frm_biaya_spp.php
	$id	= $_GET['id'];

	// Cek biaya spp di dalam siswa kelas
	$query = mysqli_query($connect,"SELECT * FROM detil_siswakelas WHERE id_biayaspp='$id' ");
	$availabel = mysqli_num_rows($query);
	if ($availabel > 0 ){
		echo "<script>
						alert('Tidak dapat dihapus, Biaya SPP telah digunakan!');
						window.location='../frm_biaya_spp.php?halaman=1';
					</script>";
	}else{
		// menghapus data biaya spp
		$query_delete = mysqli_query($connect,"DELETE FROM tb_biayaspp WHERE id_biayaspp='$id'");
		echo "<script>
						alert('Berhasil, dihapus');
						window.location='../frm_biaya_spp.php?halaman=1';
					</script>";
	} 
?>