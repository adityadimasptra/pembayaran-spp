<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname ='db_kkp';

// Proses koneksi ke database
$connect = mysqli_connect($host, $user, $pass, $dbname);

// cek koneksi
if(mysqli_connect_errno()){
	echo "Koneksi Gagal : ". mysqli_connect_error();
}
?>