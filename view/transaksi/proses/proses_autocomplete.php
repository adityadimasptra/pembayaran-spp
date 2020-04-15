<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname ='db_kkp';

// Proses koneksi ke database
$connect = mysqli_connect($host, $user, $pass, $dbname);

// cek koneksi
if(mysqli_connect_errno()){
    echo "Koneksi Gagal : ". mysqli_connect_error();
}
//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
	if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = mysqli_query ($connect,"SELECT * FROM tb_siswa WHERE nm_siswa LIKE '%$query%' ");
		$siswa = array();
    while ($row = mysqli_fetch_array($sql)) {
        $siswa[] = array (
            'label' => $row['nm_siswa'],
            'value' => $row['nisn']
        );
    }
    //RETURN JSON ARRAY
    $hasil = json_encode ($siswa);
    echo json_encode ($siswa);
}

?>