<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'koneksi/koneksi.php';
	
// mengambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// menyesuaikan data username dan password user
$ea=mysqli_query($connect,"SELECT nm_admin, id_admin FROM tb_admin where username='$username'");
$querylogin = mysqli_query($connect,"SELECT * FROM tb_admin WHERE username='$username' AND password='$password'");
// menghitung jumlah data dari $querylogin
$data = mysqli_fetch_array($ea);
$cek = mysqli_num_rows($querylogin);
	if($cek > 0){
		$_SESSION['username'] = $username;	
		$_SESSION['status'] 	= "login";
		$_SESSION['nm_admin'] = $data['nm_admin'];
		$_SESSION['id_admin'] = $data['id_admin'];
		header("location:view/home.php");
	}else{
		header("location:index.php?pesan=gagal");	
	}
?>