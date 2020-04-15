<?php
// koneksi database
include '../../../koneksi/koneksi.php';
 
// mengambil data dari frm_murid.php
$id_kelas			= $_POST['kode_kelas'];
$nm_kelas			= $_POST['nama_kelas'];

// menginput data murid ke database)
$query = mysqli_query($connect,"SELECT * FROM tb_kelas WHERE nm_kelas='$nm_kelas'");
$query_kelas = mysqli_num_rows($query);
if($query_kelas > 0){
	echo "<script>
					window.alert('Kelas sudah Ada!');
					window.location='../frm_kelas.php?halaman=1';
				</script>";
}else{
	mysqli_query($connect,"INSERT INTO tb_kelas(id_kelas, nm_kelas) 
						VALUES('$id_kelas',	
							UPPER('$nm_kelas'))") or die (mysqli_error());
	echo "<script>
					window.alert('Kelas Berhasil Ditambahkan!');
					window.location='../frm_kelas.php?halaman=1';
				</script>";
}

?>