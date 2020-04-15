<?php
include '../koneksi/koneksi.php';
$nm_kelas = $_GET['nm_kelas'];
$sql = mysqli_query($connect, "SELECT * FROM tb_kelas where nm_kelas='$nm_kelas'");
$kelas = mysqli_fetch_array($sql);
$data = array{
	'id_kelas'  => $kelas['id_kelas']
};
echo json_encode($data);

?>