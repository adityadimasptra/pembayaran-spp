<?php
	
session_start();
if(isset($_SESSION['status'])){
	include '../../../koneksi/koneksi.php';
	if($_GET['nisn'] !='' && $_GET['no']!=''){
		//deklarasi variabel
		$nisn = $_GET['nisn'];
		$no_spp 	= $_GET['no'];
		$sekarang = date("Y-m-d");
		
		//proses pembayaran spp
		$query_bayar = mysqli_query($connect,"UPDATE tb_pembayaranspp SET tgl_pemspp='$sekarang',
																																			keterangan='LUNAS',
																																			id_admin ='$_SESSION[id_admin]'
																																	WHERE no_pemspp='$no_spp' AND nisn='$nisn'");
		header('location:../frm_pembayaran_spp.php?nisn='.$nisn);
	}
}else{
	echo "<script>alert.('Maaf anda harus login terlebih dahulu')</script>";
}

?>
