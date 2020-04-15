<?php 
	// koneksi database
	include '../../../koneksi/koneksi.php';
	 
	// buat variable siswa dari frm_entry_siswa.php
	$nisn					= $_POST['nisn_update'];
	$nama_siswa 			= $_POST['nm_siswa_update'];
	$jenkel 				= $_POST['jenkel_update'];
	$tempat_lahir 			= $_POST['tempat_lahir_update'];
	$tgl_lahir_siswa		= $_POST['tgl_lahir_siswa_update'];
	$agama					= $_POST['agama_update'];
	$alamat_siswa			= $_POST['alamat_siswa_update'];
	$telp_siswa 			= $_POST['telp_siswa_update'];
	// buat variable ortu dari frm_entry_siswa.php
	$nama_orangtua 			= $_POST['nama_orangtua_update'];
	$tgl_lahir_orangtua		= $_POST['tgl_lahir_orangtua_update'];
	$pekerjaan				= $_POST['pekerjaan_update'];
	$alamat_kantor			= $_POST['alamat_kantor_update'];
	$penghasilan			= $_POST['penghasilan_update'];
	$alamat_orangtua		= $_POST['alamat_orangtua_update'];
	$telp_orangtua 			= $_POST['telp_orangtua_update'];

	if($nisn =='' || $nama_siswa =='' || $jenkel =='' || $tempat_lahir =='' || $tgl_lahir_siswa =='' || $agama =='' || $alamat_siswa =='' || $telp_siswa=='' || $nama_orangtua =='' || $tgl_lahir_orangtua =='' || $pekerjaan =='' || $alamat_kantor =='' || $penghasilan =='' || $alamat_orangtua=='' || $telp_orangtua==''){
			echo "<script>
							alert('Form Tidak Lengkap');
							window.location='../frm_siswa.php?halaman=1';
						</script>";
		}else{
	// menginput data murid ke database
			mysqli_query($connect,"UPDATE tb_siswa SET 	nm_siswa = UPPER('$nama_siswa'),
																									jenis_kelamin = UPPER('$jenkel'),
																									tempat_lahir = UPPER('$tempat_lahir'), 
																									tgl_lahir_siswa = '$tgl_lahir_siswa',
																									agama = UPPER('$agama'),
																									alamat_siswa = UPPER('$alamat_siswa'),
																									telp_siswa = '$telp_siswa',
																									nm_orangtua = UPPER('$nama_orangtua'),
																									tgl_lahir_orangtua = '$tgl_lahir_orangtua',
																									pekerjaan = UPPER('$pekerjaan'),
																									alamat_kantor = UPPER('$alamat_kantor'),
																									penghasilan = '$penghasilan',
																									alamat_orangtua = UPPER('$alamat_orangtua'),
																									telp_orangtua = '$telp_orangtua' 
																							WHERE nisn='$nisn'");

			// mengalihkan halaman kembali ke index.php
			echo "<script>
							alert('Siswa Berhasil diupdate');
							window.location='../frm_siswa.php?halaman=1';
						</script>";
		}
	 
?>