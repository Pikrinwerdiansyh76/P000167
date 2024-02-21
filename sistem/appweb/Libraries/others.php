<?php

	date_default_timezone_set("Asia/Jakarta");

	function indoTgl($indoTgl){
		$tanggal 	= substr($indoTgl,8,2);
		$bulan 		= getBulan(substr($indoTgl,5,2));
		$tahun 		= substr($indoTgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;	 
	}

	function indoBln($indoBln){
		$bulan 		= getBulan(substr($indoBln,5,2));
		$tahun 		= substr($indoBln,0,4);
		return $bulan.' '.$tahun;	 
	}

	function indoTglWithTime($indoTgl){
		$time 		= substr($indoTgl,10,9);
		$tanggal 	= substr($indoTgl,8,2);
		$bulan 		= getBulan(substr($indoTgl,5,2));
		$tahun 		= substr($indoTgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun.' '.$time;	 
	}

	function indoTglWithDay($indoTgl){
		$hari 		= getHari(substr($indoTgl,11,1));
		$tanggal 	= substr($indoTgl,8,2);
		$bulan 		= getBulan(substr($indoTgl,5,2));
		$tahun 		= substr($indoTgl,0,4);
		return $hari.', '.$tanggal.' '.$bulan.' '.$tahun;	 
	}

	function getHari($hri){
		switch ($hri){
			case 0: 
				return "Minggu";
				break;
			case 1:
				return "Senin";
				break;
			case 2:
				return "Selasa";
				break;
			case 3:
				return "Rabu";
				break;
			case 4:
				return "Kamis";
				break;
			case 5:
				return "Jumat";
				break;
			case 6:
				return "Sabtu";
				break;
		}
	}

	function getHari2($hri){
		switch ($hri){
			case "Sun": 
				return "Minggu";
				break;
			case "Mon":
				return "Senin";
				break;
			case "Tue":
				return "Selasa";
				break;
			case "Wed":
				return "Rabu";
				break;
			case "Thu":
				return "Kamis";
				break;
			case "Fri":
				return "Jumat";
				break;
			case "Sat":
				return "Sabtu";
				break;
		}
	}

	function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Jan";
				break;
			case 2:
				return "Feb";
				break;
			case 3:
				return "Mar";
				break;
			case 4:
				return "Apr";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Jun";
				break;
			case 7:
				return "Jul";
				break;
			case 8:
				return "Agu";
				break;
			case 9:
				return "Sep";
				break;
			case 10:
				return "Okt";
				break;
			case 11:
				return "Nov";
				break;
			case 12:
				return "Des";
				break;
		}
	}

	function getBulan2($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}

	function rp($angka){
	  	$rupiah=number_format($angka,0,',','.');
	  	return $rupiah;
	}

	function rpInt($s) {
		$s 	= str_replace('.', '', $s); // Hilangkan karakter yang telah disebutkan di array $d
		$s 	= explode(",", $s);
        $s 	= $s[0];
	    return $s;
	}

	function telp($s) {
	    $c = array (' ');
		$d = array ('-',',','.','~','+');

	    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
	    
	    $s = strtolower(str_replace($c, '', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
	    return $s;
	}

	function whatsApp($s) {
        $s = $s;
        $s = preg_replace('/0/', '62', $s, 1); // outputs 'here is the solution'

        return $s;
    }

	function seo($text){
		// megubah karakter non huruf dengan strip
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // ubah semua huruf menjadi huruf kecil
        $text = strtolower($text);
        // hapus karakter yang tidak diinginkan
        $text = preg_replace('~[^-\w]+~', '', $text);
        
        return $text;
	}

	function seo2($s) {
	    $c = array (' ');
	    $d = array ('/','.','image',);

	    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
	    
	    $s = strtolower(str_replace($c, '', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
	    return $s;
	}

	function seo3($s) {
	    $c = array (' ');
	    $d = array ('/','video');

	    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
	    
	    $s = strtolower(str_replace($c, '', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
	    return $s;
	}

	function createUsername($s) {
	    $c = array (' ');
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','“','”');

	    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
	    
	    $s = strtolower(str_replace($c, '', $s));
	    return $s;
	}