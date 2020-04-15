<?php 
// koneksi database
include '../../../koneksi/koneksi.php';
	
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$tahun_ajaran	= $_POST['th_ajaran'];
	$id_kelas			= $_POST['kelas'];
	$id_biayaspp	= $_POST['id_biayaspp'];
	$nisn					= $_POST['nisn'];
	$status				= $_POST['status'];
	
	//prosses simpan
	if($id_kelas =='' || $id_biayaspp =='' || $nisn =='' || $tahun_ajaran =='' ){
		echo "<script>alert('Form Tidak Lengkap')</script>";
	}else{
		$cek_siswa = mysqli_query($connect, "	SELECT * 
																					FROM detil_siswakelas 
																					WHERE nisn='$nisn' 
																					AND id_kelas='$id_kelas'
																					AND id_biayaspp ='$id_biayaspp'
																					AND tahun_ajaran = '$tahun_ajaran'") or die (mysqli_error($connect));
		
		$available_siswa = mysqli_num_rows($cek_siswa);
		
		if($available_siswa > 0){
				$update_detsiswa = mysqli_query($connect, "	UPDATE detil_siswakelas 
																										SET status = '$status'
																										WHERE nisn ='$nisn'
																										AND id_kelas ='$id_kelas'
																										AND id_biayaspp ='$id_biayaspp'
																										AND tahun_ajaran = '$tahun_ajaran'") or die (mysqli_error($connect));
				echo "<script>
							alert('Siswa berhasil di update');
							window.location='../frm_detsiswa.php?halaman=1';
						</script>";
				if(!$update_detsiswa){
				echo "<script>
								alert('Gagal disimpan');
								window.location='../frm_detsiswa.php?halaman=1';
							</script>";
				}	
		}else{
			echo "<script>
							alert('Siswa tidak ditemukan');
							window.location='../frm_detsiswa.php?halaman=1';
						</script>";
		}
	}
}

// mengalihkan halaman kembali ke index.php
?>