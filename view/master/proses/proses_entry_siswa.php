<?php 
	// koneksi database
	include '../../../koneksi/koneksi.php';
	 
	// buat variable siswa dari frm_entry_siswa.php
	$nisn								= $_POST['nisn_entry'];
	$nama_siswa 				= $_POST['nm_siswa_entry'];
	$jenkel 						= $_POST['jenkel_entry'];
	$tempat_lahir 			= $_POST['tempat_lahir_entry'];
	$tgl_lahir_siswa		= $_POST['tgl_lahir_siswa_entry'];
	$agama							= $_POST['agama_entry'];
	$alamat_siswa				= $_POST['alamat_siswa_entry'];
	$telp_siswa 				= $_POST['telp_siswa_entry'];
	// buat variable ortu dari frm_entry_siswa.php
	$nama_orangtua 			= $_POST['nama_orangtua_entry'];
	$tgl_lahir_orangtua	= $_POST['tgl_lahir_orangtua_entry'];
	$pekerjaan					= $_POST['pekerjaan_entry'];
	$alamat_kantor			= $_POST['alamat_kantor_entry'];
	$penghasilan				= $_POST['penghasilan_entry'];
	$alamat_orangtua		= $_POST['alamat_orangtua_entry'];
	$telp_orangtua 			= $_POST['telp_orangtua_entry'];

	if($nisn =='' || $nama_siswa =='' || $jenkel =='' || $tempat_lahir =='' || $tgl_lahir_siswa =='' || $agama =='' || $alamat_siswa =='' || $telp_siswa=='' || $nama_orangtua =='' || $tgl_lahir_orangtua =='' || $pekerjaan =='' || $alamat_kantor =='' || $penghasilan =='' || $alamat_orangtua=='' || $telp_orangtua==''){
			echo "<script>
							alert('Form Tidak Lengkap');
							window.location='../frm_siswa.php?halaman=1';
						</script>";
		}else{
			// menginput data siswa ke database)
			mysqli_query($connect,"INSERT INTO tb_siswa(																								
																									nisn,
																									nm_siswa,
																									jenis_kelamin,
																									tempat_lahir,
																									tgl_lahir_siswa,
																									agama,
																									alamat_siswa,
																									telp_siswa,
																									nm_orangtua,
																									tgl_lahir_orangtua,
																									pekerjaan,
																									alamat_kantor,
																									penghasilan,
																									alamat_orangtua,
																									telp_orangtua) 
																					VALUES(
																							'$nisn',
																							UPPER('$nama_siswa'),
																							UPPER('$jenkel'),
																							UPPER('$tempat_lahir'),
																							'$tgl_lahir_siswa',
																							UPPER('$agama'),
																							UPPER('$alamat_siswa'),
																							'$telp_siswa',
																							UPPER('$nama_orangtua'),
																							'$tgl_lahir_orangtua',
																							UPPER('$pekerjaan'),
																							UPPER('$alamat_kantor'),
																							'$penghasilan',
																							UPPER('$alamat_orangtua'),
																							'$telp_orangtua')") or die (mysqli_error());
			echo "<script>
							alert('Siswa Berhasil ditambahkan');
							window.location='../frm_siswa.php?halaman=1';
						</script>";
		} 
?>