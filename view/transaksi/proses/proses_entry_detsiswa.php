<?php 
// koneksi database
include '../../../koneksi/koneksi.php';

// menyalakan session
session_start();
if($_SESSION['status']!="login"){
	header("location:../index.php?pesan=belum_login");
}
		
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$id_kelas			= $_POST['kelas'];
	$tahun_ajaran	= $_POST['th_ajaran'];
	$id_biayaspp	= $_POST['id_biayaspp'];
	$nisn					= $_POST['nisn'];
	$awal_tempo		= date('Y').'-07-10';
	$tgl_sekarang = date("Y-m-d");
	//$tgl_sekarang	= '2017-07-10';
	//Array untuk Bulan
	$bulan = array(	
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	);
	
	//prosses simpan
	if($id_kelas =='' || $id_biayaspp =='' || $nisn =='' ){
		echo "<script>alert('Form Tidak Lengkap')</script>";
	}else{
		$cek_siswa = mysqli_query($connect, "SELECT * FROM tb_siswa WHERE nisn='$nisn'") or die (mysqli_error($connect));
		$cek_status = mysqli_query($connect, "SELECT * 	FROM detil_siswakelas 
																										WHERE nisn='$nisn' 
																										AND id_kelas ='$id_kelas' 
																										AND tahun_ajaran='$tahun_ajaran'") or die(mysqli_error($connect));
		$available_siswa = mysqli_num_rows($cek_siswa);
		$available_status = mysqli_num_rows($cek_status);
		
		if($available_siswa > 0){
			if($available_status > 0){
				echo "<script>
								alert('Siswa sudah terdaftarkan');
								window.location='../frm_entry_detsiswa.php';
							</script>";
			}else{
				$simpan_detsiswa = mysqli_query($connect, "INSERT INTO detil_siswakelas (id_kelas, nisn, id_biayaspp, tahun_ajaran, status)
																	VALUES('$id_kelas','$nisn','$id_biayaspp','$tahun_ajaran','AKTIF')");
				if(!$simpan_detsiswa){
				echo "<script>
								alert('Gagal disimpan');
								window.location='../frm_entry_detsiswa.php';
							</script>";
				}else{					
					//buat tagihan
					$j=0;
					while($j<12){
						
						//kode pemspp
						$sekarang = 'T'.date("ydm");
						$carikode = mysqli_query($connect, "SELECT MAX(no_pemspp) as lastkode FROM tb_pembayaranspp WHERE no_pemspp LIKE '$sekarang%'") or die (mysql_error());
						// menjadikannya array
						$datakode = mysqli_fetch_array($carikode);
						$lastkode = $datakode['lastkode'];
						$nilaikode = substr($lastkode, 7, 8);
						$nextkode = $nilaikode + 1;
						$no_pemspp = $sekarang.sprintf('%08s',$nextkode);
						
						//buat jatuh tempo tgl 10
						$jatuh_tempo = date("Y-m-d", strtotime("+$j month", strtotime($awal_tempo)));
						//buat bulan tagihan
						$bln = $bulan[date('m', strtotime($jatuh_tempo))]." ".date('Y', strtotime($jatuh_tempo));
						//tagihan untuk bulan juli
						$tagihan_awal = mysqli_query($connect,"SELECT * FROM tb_pembayaranspp WHERE nisn ='$nisn' AND id_kelas ='$id_kelas'") or die (mysqli_error($connect));
						$cek_tawal = mysqli_num_rows($tagihan_awal);
						if($cek_tawal < 1){
							$tambah_tawal = mysqli_query($connect,"INSERT INTO tb_pembayaranspp(no_pemspp,
																																								nisn, 
																																								id_kelas, 
																																								id_biayaspp, 
																																								bulan,
																																								jatuh_tempo,
																																								tgl_pemspp,
																																								keterangan,
																																								id_admin)
																																		VALUES ('$no_pemspp',
																																						'$nisn',
																																						'$id_kelas',
																																						'$id_biayaspp',
																																						'$bln',
																																						'$jatuh_tempo',
																																						'$awal_tempo',
																																						'LUNAS',
																																						'$_SESSION[id_admin]')") or die (mysqli_error($connect));
						}else{
							$buat_tagihan = mysqli_query($connect,"INSERT INTO tb_pembayaranspp(no_pemspp,
																																								nisn, 
																																								id_kelas, 
																																								id_biayaspp, 
																																								bulan,
																																								jatuh_tempo,
																																								keterangan)
																																		VALUES ('$no_pemspp',
																																						'$nisn',
																																						'$id_kelas',
																																						'$id_biayaspp',
																																						'$bln',
																																						'$jatuh_tempo',
																																						'BELUM LUNAS')") or die (mysqli_error($connect));
						}
						$j++;
					}
					
					echo "<script>
								alert('Berhasil Ditambahkan');
								window.location='../frm_entry_detsiswa.php';
							</script>";
				}	
			}			
		}else{
			echo "<script>
							alert('Siswa tidak ditemukan');
							window.location='../frm_entry_detsiswa.php';
						</script>";
		}
	}
}

// mengalihkan halaman kembali ke index.php
?>