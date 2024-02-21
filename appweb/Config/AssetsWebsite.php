<?php

    $stmtP = $pdo->query("
            SELECT id_pengaturan, judul, gambar, deskripsi
            FROM pengaturan");
    while($resultP = $stmtP->fetch(PDO::FETCH_ASSOC)){
    	
    	if ($resultP['id_pengaturan'] == 1) {
    		$icon		= $resultP['gambar'];
			$judulIcon	= $resultP['judul'];
    	}elseif ($resultP['id_pengaturan'] == 2) {
    		$logoDesktop		= $resultP['gambar'];
			$judulLogoDesktop	= $resultP['judul'];
    	}elseif ($resultP['id_pengaturan'] == 3) {
    		$logoMobile			= $resultP['gambar'];
			$judulLogoMobile	= $resultP['judul'];
    	}elseif ($resultP['id_pengaturan'] == 4) {
    		$nomorWhatsApp	= $resultP['deskripsi'];
    	}elseif ($resultP['id_pengaturan'] == 5) {
    		$nomorTelpSms	= $resultP['deskripsi'];
    	}elseif ($resultP['id_pengaturan'] == 6) {
    		$linkInstagram	= $resultP['deskripsi'];
    	}elseif ($resultP['id_pengaturan'] == 7) {
    		$linkFacebook	= $resultP['deskripsi'];
    	}elseif ($resultP['id_pengaturan'] == 8) {
    		$linkTikTok		= $resultP['deskripsi'];
    	}elseif ($resultP['id_pengaturan'] == 9) {
    		$linkYouTube	= $resultP['deskripsi'];
    	}elseif ($resultP['id_pengaturan'] == 10) {
    		$LinkedIn		= $resultP['deskripsi'];
    	}elseif ($resultP['id_pengaturan'] == 11) {
    		$email			= $resultP['deskripsi'];
    	}elseif ($resultP['id_pengaturan'] == 12) {
    		$googleMaps		= $resultP['deskripsi'];
    	}elseif ($resultP['id_pengaturan'] == 13) {
    		$linkGoogleMaps	= $resultP['deskripsi'];
    	}elseif ($resultP['id_pengaturan'] == 14) {
    		$alamat			= $resultP['deskripsi'];
    	}
    	
	}

?>