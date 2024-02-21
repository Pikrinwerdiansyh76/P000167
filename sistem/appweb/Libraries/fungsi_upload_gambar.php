<?php

function fileWajib($name_file){
	if(empty($name_file)){
		$_SESSION['_msg__'] = 'fileWajib';
		echo "<script>window.location(history.back(-1))</script>";
		exit();
		die();
	}

}

function cekFile($type_file){
	if ($type_file!="image/webp" AND $type_file!="image/jpg" AND $type_file!="image/jpeg" AND $type_file!="image/png" AND $type_file!="image/gif"){
		$_SESSION['_msg__'] = 'cekFile';
		echo "<script>window.location(history.back(-1))</script>";
		exit();
		die();
	}
}

function cekUkuranFile2mb($file_size){
	if($file_size>2000000 OR $file_size<=0){
		$_SESSION['_msg__'] = 'CekSize';
		echo "<script>window.location(history.back(-1))</script>";
		exit();
		die();
	}
}

function uploadGambarAsli($name_file, $type_file, $location_file, $location_upload){
	
	//direktori gambar
	$vfile_upload 	= $location_upload.$name_file;

	// Simpan gambar dalam ukuran sebenarnya
	move_uploaded_file($location_file, $vfile_upload);
}

function uploadGambarAsliWithSmall($name_file, $type_file, $location_file, $location_upload, $location_upload_small){
	
	//direktori gambar
	$vfile_upload 		= $location_upload.$name_file;
	$vfile_upload_small = $location_upload_small.$name_file;

	// Simpan gambar dalam ukuran sebenarnya
	move_uploaded_file($location_file, $vfile_upload);
	move_uploaded_file($location_file, $vfile_upload_small);

	//identitas file asli
	if ($type_file=="image/jpeg" ){
		$im_src = imagecreatefromjpeg($vfile_upload);
	}elseif ($type_file=="image/jpg" ){
		$im_src = imagecreatefromjpg($vfile_upload);
	}elseif ($type_file=="image/png" ){
		$im_src = imagecreatefrompng($vfile_upload);
	}elseif ($type_file=="image/gif" ){
		$im_src = imagecreatefromgif($vfile_upload);
    }elseif ($type_file=="image/wbmp" ){
		$im_src = imagecreatefromwbmp($vfile_upload);
    }elseif ($type_file=="image/webp" ){
		$im_src = imagecreatefromwebp($vfile_upload);
    }

	// Simpan gambar dalam ukuran yang di maksud
	$src_width 	= imageSX($im_src);
	$src_height = imageSY($im_src);

	$dst_width 	= $src_width;
	$dst_height = $src_height;

	$im = imagecreatetruecolor($dst_width,$dst_height);
	
	// Turn off transparency blending (temporarily)
	imagealphablending($im, false);
	// Create a new transparent color for image
	$color = imagecolorallocatealpha($im, 0, 0, 0, 127);
	// Completely fill the background of the new image with allocated color.
	imagefill($im, 0, 0, $color);
	// Restore transparency blending
	imagesavealpha($im, true);
	//0, 0, 0, 0 letak gambar
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	if ($type_file=="image/jpeg" ){
		imagejpeg($im,$vfile_upload);
    }elseif ($type_file=="image/jpg" ){
		imagejpg($im,$vfile_upload);
    }elseif ($type_file=="image/png" ){
		imagepng($im,$vfile_upload);
    }elseif ($type_file=="image/gif" ){
		imagegif($im,$vfile_upload);
    }elseif ($type_file=="image/wbmp" ){
		imagewbmp($im,$vfile_upload);
    }elseif ($type_file=="image/webp" ){
		imagewebp($im,$vfile_upload);
    }

    if ($dst_width<576) {
    	$dst_width 	= $dst_width;
		$dst_height = $dst_height;
    }elseif ($dst_width>576 && $dst_width<768) {
    	$dst_width 	= $dst_width/2;
		$dst_height = $dst_height/2;
    }elseif ($dst_width>768 && $dst_width<992) {
    	$dst_width 	= $dst_width/3;
		$dst_height = $dst_height/3;
    }elseif ($dst_width>992 && $dst_width<1200) {
    	$dst_width 	= $dst_width/3.5;
		$dst_height = $dst_height/3.5;
    }elseif ($dst_width>1200 && $dst_width<1400) {
    	$dst_width 	= $dst_width/4;
		$dst_height = $dst_height/4;
    }elseif ($dst_width>1400) {
    	$dst_width 	= $dst_width/5;
		$dst_height = $dst_height/5;
    }

	$im2 = imagecreatetruecolor($dst_width,$dst_height);
	
	// Turn off transparency blending (temporarily)
	imagealphablending($im2, false);
	// Create a new transparent color for image
	$color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
	// Completely fill the background of the new image with allocated color.
	imagefill($im2, 0, 0, $color);
	// Restore transparency blending
	imagesavealpha($im2, true);
	//0, 0, 0, 0 letak gambar
	imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	if ($type_file=="image/jpeg" ){
		imagejpeg($im2,$vfile_upload_small);
    }elseif ($type_file=="image/jpg" ){
		imagejpg($im2,$vfile_upload_small);
    }elseif ($type_file=="image/png" ){
		imagepng($im2,$vfile_upload_small);
    }elseif ($type_file=="image/gif" ){
		imagegif($im2,$vfile_upload_small);
    }elseif ($type_file=="image/wbmp" ){
		imagewbmp($im2,$vfile_upload_small);
    }elseif ($type_file=="image/webp" ){
		imagewebp($im2,$vfile_upload_small);
    }
  
	imagedestroy($im_src);
	imagedestroy($im);
	imagedestroy($im2);
}