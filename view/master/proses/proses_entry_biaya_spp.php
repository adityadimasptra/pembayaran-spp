<?php
// koneksi database
include '../../../koneksi/koneksi.php';
 
// mengambil data dari frm_biaya_spp.php
$id_biayaspp	= $_POST['id_biayaspp_entry'];
$angkatan			= $_POST['angkatan_entry'];
$biaya_spp		= $_POST['biaya_spp_entry'];

// menginput data biaya ke database)
$query = mysqli_query($connect,"SELECT * FROM tb_biayaspp WHERE angkatan ='$angkatan'");
$query_biaya = mysqli_num_rows($query);
if($query_biaya > 0){
	echo "<script>
					window.alert('Belum ada Angkatan!');
					window.location='../frm_siswa.php?halaman=1';
				</script>";
}else{
	mysqli_query($connect,"INSERT INTO tb_biayaspp(id_biayaspp, angkatan, biaya_spp) 
													VALUES('$id_biayaspp',	
																('$angkatan'),
																('$biaya_spp'))") or die (mysqli_error());
		echo "<script>
						window.alert('Biaya SPP Berhasil Ditambahkan!');
						window.location='../frm_biaya_spp.php?halaman=1';
					</script>";
}

?>