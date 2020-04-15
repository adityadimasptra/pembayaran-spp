<?php 
// koneksi database
include '../../../koneksi/koneksi.php';
 
// mengambil data dari frm_update_siswa.php
$id_biayaspp	= $_POST['id_biayaspp_update'];
$angkatan			= $_POST['angkatan_update'];
$biaya_spp 		= $_POST['biaya_spp_update'];

if($id_biayaspp =='' || $angkatan =='' || $biaya_spp =='' ){
			echo "<script>
							alert('Form Tidak Lengkap');
							window.location='../frm_biaya_spp.php?halaman=1';
						</script>";
		}else
		{
			// Update data biaya spp ke database
		mysqli_query($connect,"UPDATE tb_biayaspp set biaya_spp='$biaya_spp' WHERE id_biayaspp='$id_biayaspp'");

		// mengalihkan halaman kembali ke index.php
		echo "<script>
							alert('Data Berhasil di Update');
							window.location='../frm_biaya_spp.php?halaman=1';
						</script>";
		}

 
?>