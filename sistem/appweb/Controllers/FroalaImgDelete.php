<?php
	require "../../../../appweb/Config/SetWebsite.php";

	// get param
	$file_nameC	= $url_others."/HandleByFroala/";
	$file_nameA	= explode($file_nameC, $_GET['file_nm']);
	$file_name 	= $file_nameA[1];

	// file route
	$fileRoute	= "../../../../assets/files/others/HandleByFroala/";
	unlink($fileRoute.$file_name);
?>