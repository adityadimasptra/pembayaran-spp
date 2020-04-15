<?php 
	// koneksi database
	include '../../../koneksi/koneksi.php';
	 
	// buat variable siswa dari frm_entry_siswa.php
	$nisn						= $_GET['nisn'];
	$tahun_ajaran 	= $_GET['th_ajaran'];
	$id_kelas 			= $_GET['kelas'];
	$no_pemspp 			= $_GET['no_pemspp'];
	$tgl_sekarang		= date('Y-m-d');
	//$tgl_sekarang = date('2018-12-10');
	
	//auto no_speringatan
	$sekarang = 'SPT'.date("ydm");
	$carikode = mysqli_query($connect, "SELECT MAX(no_speringatan) as lastkode FROM sp_tunggakan WHERE no_speringatan LIKE '$sekarang%'") or die (mysqli_error($connect));
	// menjadikannya array
	$datakode = mysqli_fetch_array($carikode);
	$lastkode = $datakode['lastkode'];
	$nilaikode = substr($lastkode, 9, 8);
	$nextkode = $nilaikode + 1;
	$autono_tunggakan = $sekarang.sprintf('%08s',$nextkode);
	
	$detil_tunggakan = mysqli_query($connect, "SELECT no_pemspp, bulan, jatuh_tempo, tahun_ajaran, biaya_spp FROM 
																													tb_pembayaranspp p,
																													detil_siswakelas ds,
																													tb_biayaspp b,
																													tb_kelas k,
																													tb_siswa s
																													WHERE
																													p.nisn = ds.nisn
																													
																													AND ds.id_biayaspp = b.id_biayaspp
																													AND ds.nisn = s.nisn
																													AND ds.id_kelas = k.id_kelas
																													
																													AND jatuh_tempo < '$tgl_sekarang'
																													AND tgl_pemspp is null
																													AND k.id_kelas = '$id_kelas'
																													AND	s.nisn = '$nisn'
																													AND tahun_ajaran = '$tahun_ajaran'
																													") or die (mysqli_error($connect));
	$cek_tunggakan = mysqli_num_rows($detil_tunggakan);
																													
	$cek_suratperingatan = mysqli_query($connect,"SELECT * FROM sp_tunggakan WHERE no_pemspp='$no_pemspp'") or die (mysqli_error($connect));
	$available = mysqli_num_rows($cek_suratperingatan);

	if($nisn =='' || $tahun_ajaran =='' || $id_kelas ==''){
			echo "<script>
							alert('Gagal Simpan');
							window.location='../frm_sp_tunggakan.php?halaman=1';
						</script>";
		}else{
			if($available > 0 ){
			echo "<script>
							alert('Surat Peringatan Sudah Pernah Dibuat');
							window.location='../frm_sp_tunggakan.php?halaman=1';
						</script>";
				
			}else{
				if($cek_tunggakan >=2){
					while($data = mysqli_fetch_array($detil_tunggakan)){
				
					// menginput surat peringatan tunggakan ke sp_tunggakan
					mysqli_query($connect,"INSERT INTO sp_tunggakan(																								
																							no_speringatan,
																							no_pemspp,
																							tgl_speringatan) 
																					VALUES(
																						'$autono_tunggakan',
																						'$data[no_pemspp]',
																						'$tgl_sekarang')") or die (mysqli_error($connect));
					}
				}else{
					echo "<script>
									alert('Surat Peringatan dibuat Minimal lebih dari 1 bulan');
									window.location='../frm_sp_tunggakan.php?halaman=1';
								</script>";
				}
				
			}
			
			echo "<script>
							alert('Surat Peringatan Berhasil Dibuat');
							window.location='../frm_sp_tunggakan.php?halaman=1';
						</script>";
		} 
?>