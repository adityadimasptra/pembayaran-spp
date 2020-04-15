<html>
	<head>
		<title>Halaman Kelas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../../style/istyle.css">
	</head>
	<body>
		<?php
			// menghubungkan koneksi database
			include '../../koneksi/koneksi.php';
			include '../function/paginasi.php';
			// menyalakan session
			session_start();
			if($_SESSION['status']!="login"){
				header("location:../../index.php?pesan=belum_login");
			}
			include '../sidenav.php';
		?>
		<div class="duduy" style="width:100%;padding:5px;background-color:; float:right; text-align:right;">
			<label><?php echo 'ADMIN '.$_SESSION['nm_admin'].' ('.$_SESSION['id_admin'].')'; ?></label>
			<a class="logout" href="../../logout.php" style="padding-left:px;" onclick="return confirm('Anda ingin Log Out?')">
				<button class="button-logout">Logout <i class="fa fa-power-off"></i></button>
			</a>
		</div>
		<div class="main">
			<a href="../home.php">
				<button class="button-kembali" style="float:left;">
					<i class="fa fa-arrow-circle-left"></i> Kembali
				</button>
			</a>
				<h1>&nbsp;Data Kelas</h1>
			<hr>
			<?php
				$carikode = mysqli_query($connect, "select max(id_kelas) from tb_kelas") or die (mysql_error());
					// menjadikannya array
					$datakode = mysqli_fetch_array($carikode);
					// jika $datakode
					if ($datakode) {
					 $nilaikode = substr($datakode[0], 1);
					 // menjadikan $nilaikode ( int )
					 $kode = (int) $nilaikode;
					 // setiap $kode di tambah 1
					 $kode = $kode + 1;
					 $kode_otomatis = "K".str_pad($kode, 4, "0", STR_PAD_LEFT);
					} else {
					 $kode_otomatis = "K0001";
					}
			?>
			<button class="button-link" style="margin:0px 80px 5px;" id="myBtnEntry" ><i class="fa fa-plus-square"></i> Tambah Kelas</button>
				<!-- The Modal Entry-->
			<div id="myModalEntry" class="modal">
			<!-- Modal content -->
				<div class="modal-content" style="width:30%;">
					<div class="modal-header">
						<span class="closeEntry" id="tutup">&times;</span>
						<h2>Tambah Kelas</h2>
					</div>
					<div class="modal-body">
						<div class="main-body">
						<form method="post" action="proses/proses_entry_kelas.php" >
								<div class="row2nd">
									<div class="col-1nd" style="margin-right:;>
										<label for="kd_pelanggan">ID Kelas</label>
									</div>
									<div class="col-2nd">
										<input type="text" maxlength="5" name="kode_kelas" value="<?php echo "$kode_otomatis"; ?>" readonly>
									</div>
								</div>
						
								<div class="row2nd">
									<div class="col-1nd" style="margin-right:;">
										<label for="nama_lengkap">Nama Kelas</label>
									</div>
									<div class="col-2nd">
										<input type="text" maxlength="4" name="nama_kelas" required>
									 </div>
								 </div>
								<input type="submit" style="float:right;" value="Simpan Data">
							</form>
						</div>
					</div>
				</div>

			</div>
			<!-- JavScriptModalEntry -->
			<script>
				// Get the modal
				var modalEntry = document.getElementById('myModalEntry');

				// Get the button that opens the modal
				var btnEntry = document.getElementById("myBtnEntry");

				// Get the <span> element that closes the modal
				var spanEntry = document.getElementsByClassName("closeEntry")[0];

				// When the user clicks the button, open the modal 
				btnEntry.onclick = function() {
						modalEntry.style.display = "block";
				}

				// When the user clicks on <span> (x), close the modal
				spanEntry.onclick = function() {
						modalEntry.style.display = "none";
				}
			</script>
			<table class="fixed-th" style="margin-left:100px; width:80%;">
				<thead>
					<tr>
						<th>no</th>
						<th>ID Kelas</th>
						<th>Nama Kelas</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$batas = 5;
					$posisi = cariPosisi($batas);
					
					$result = mysqli_query($connect,"SELECT * FROM tb_kelas order by nm_kelas desc");
					$jml_record = mysqli_num_rows($result);

					// mengambil data murid dari tabel tb_murid
					$cari = mysqli_query($connect,"SELECT * FROM tb_kelas order by nm_kelas asc LIMIT $posisi, $batas") or die (mysqli_error());
					$nomor = $posisi + 	1;
					// menampilkan data dari tabel tb_murid
					while($row=mysqli_fetch_array($cari,MYSQLI_ASSOC)){
					?>
						<tr>
							<td><?php echo $nomor++;?></td>
							<td><?php echo $row['id_kelas']; ?></td>
							<td><?php echo $row['nm_kelas']; ?></td>
							<td>
								<a href="proses/proses_delete_kelas.php?id=<?php echo $row['id_kelas']; ?>" onclick="return confirm('Yakin Hapus?')">
									<button class="button-merah"><i class="fa fa-trash fa-lg"></i></button>
								</a>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<p style='padding-left:10%;'>Jumlah Data : <?php echo $jml_record;?></p>
			<div class="paginasi-bar">
				<div class="paginasi">
					<?php 
						//paginasi
						$jml_halaman = jmlHalaman($jml_record,$batas);
						$link = linkHal(@$_GET['halaman'],$jml_halaman);
						echo $link;				
					?>
				</div>
			</div>
		</div>
		<script>
		/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;
		
		for (i = 0; i < dropdown.length; i++) {
			dropdown[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var dropdownContent = this.nextElementSibling;
				if (dropdownContent.style.display === "block") {
					dropdownContent.style.display = "none";
				} else {
					dropdownContent.style.display = "block";
				}
			});
		}
		</script>
	</body>
</html> 