<?php 
	// koneksi database
	include '../../../koneksi/koneksi.php';
	 
	// buat variable siswa dari frm_entry_siswa.php
	$no_spt						= $_GET['nospt'];
	$tgl_sekarang		= date('Y-m-d');
	//$tgl_sekarang = date('2018-12-10');
	
	//auto no_speringatan
	$sekarang = 'SPO'.date("ydm");
	$carikode = mysqli_query($connect, "SELECT MAX(no_spanggilan) as lastkode FROM sp_orangtua WHERE no_spanggilan LIKE '$sekarang%'") or die (mysqli_error($connect));
	// menjadikannya array
	$datakode = mysqli_fetch_array($carikode);
	$lastkode = $datakode['lastkode'];
	$nilaikode = substr($lastkode, 9, 8);
	$nextkode = $nilaikode + 1;
	$autono_sporangtua = $sekarang.sprintf('%08s',$nextkode);
																														
	$cek_sporangtua = mysqli_query($connect,"SELECT * FROM sp_orangtua WHERE no_speringatan='$no_spt'") or die (mysqli_error($connect));
	$available = mysqli_num_rows($cek_sporangtua);

	if($no_spt ==''){
			echo "<script>
							alert('Gagal Simpan');
							window.location='../frm_sp_orangtua.php?halaman=1';
						</script>";
		}else{
			if($available > 0 ){
			echo "<script>
							alert('Surat Panggilan Orangtua Sudah Pernah Dibuat');
							window.location='../frm_sp_orangtua.php?halaman=1';
						</script>";
				
			}else{
				// menginput surat peringatan tunggakan ke sp_tunggakan
					mysqli_query($connect,"INSERT INTO sp_orangtua(																								
																							no_spanggilan,
																							no_speringatan,
																							tgl_spanggilan) 
																					VALUES(
																						'$autono_sporangtua',
																						'$no_spt',
																						'$tgl_sekarang')") or die (mysqli_error($connect));
			}
			
			echo "<script>
							alert('Surat Panggilan Orangtua Berhasil Dibuat');
							window.location='../frm_sp_orangtua.php?halaman=1';
						</script>";
		} 
?>