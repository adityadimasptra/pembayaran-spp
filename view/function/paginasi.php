<html>
<head>
	<link rel="stylesheet" type="text/css" href="../../style/istyle.css">
	<link rel="stylesheet" href="../../style/font-awesome/css/font-awesome.min.css">
</head>
<?php
    function cariPosisi($batas){
        $halaman = @$_GET['halaman'];
        if(empty($halaman)){
            $position = 0;
            $halaman = 1;
        }else{
            $position = ($halaman - 1) * $batas;
        }
        return $position;
    }
     
    function jmlHalaman($jmlData,$batas){
        $jmlHal = ceil($jmlData/$batas);
        return $jmlHal;
    }
     
    Function linkHal($halamanAktif,$jumlahHalaman){ 
        $link_halaman = "";
				
        // Link First dan Previous
        $prev = $halamanAktif-1;
        if($halamanAktif < 2){
            $link_halaman .= "";
        }else{
            $link_halaman .= "<a href='?halaman=1'>First</a><a href='?halaman=$prev'><i class='fa fa-arrow-left'></i></a>";
        }
         
        // link halaman 1,2,3,...
        // Angka awal
				$angka = "";
				
        for($i=$halamanAktif-2; $i<($halamanAktif); $i++){
					if ($i <1){
						continue;
					}
					$angka .= "<a href='?halaman=$i'>$i</a> ";
        }
         
        // Angka tengah
        $angka .= "<a href='?halaman=$halamanAktif' class='active'>$halamanAktif</a> ";
        for($i=$halamanAktif+1; $i<($halamanAktif+3); $i++){
					if($i > $jumlahHalaman) {
						break;
					}
					$angka .= "<a href='?halaman=$i'>$i</a>";
        }
         
        // Gabung Link
        $link_halaman .= $angka;
         
        // Link Next dan Last
        if($halamanAktif < $jumlahHalaman){
            $next = $halamanAktif+1;
            $link_halaman .= "<a href='?halaman=$next'><i class='fa fa-arrow-right'></i></a><a href='?halaman=$jumlahHalaman'>Last</a>";
        }else{
            $link_halaman .="";
        }
        return $link_halaman;
    }
?>
</html>