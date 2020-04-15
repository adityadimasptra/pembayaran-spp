<?php
//CREDENTIALS FOR DB
include '../../koneksi/koneksi.php';

//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = mysqli_query($connect, "SELECT * FROM tb_siswa s, detil_siswakelas ds WHERE s.nisn = ds.nisn AND nm_siswa LIKE '%{$query}%'") or die(mysqli_error($connect));
    $array = array();
    while ($row = mysqli_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['nisn'],
            'value' => $row['nisn'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
    if(isset($_POST['simpan'])){
        echo "<p>".json_encode ($array)."</p>";
    }
}

?>