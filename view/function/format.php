<?php 

// membuat function tanggal dd-mm-yyyy
function tanggal($tgl){
	
	$hasil_tanggal = date('d-m-Y', strtotime($tgl));
	return $hasil_tanggal;
	
}
//membuat format rupiah dengan PHP
function rupiah($angka){

	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}

function usia($tgllahir){
	$tgl_sekarang = date('Y');
	$umur =  $tgl_sekarang - date('Y', strtotime($tgllahir));
	return $umur;
}
?>