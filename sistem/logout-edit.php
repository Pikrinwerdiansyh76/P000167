<?php

	session_start();

	// Jika berhasil
    unset($_SESSION['_alert__']);
	unset($_SESSION['_msg__']);
	unset($_SESSION['_session__']);
	unset($_SESSION['_id_akun__']);
	unset($_SESSION['_nama__']);
	unset($_SESSION['_avatar__']);
	unset($_SESSION['_level__']);
	session_unset();
	session_destroy();
	
	session_start();
	$_SESSION['_msg__'] = "Back";
    echo "<script>window.location = 'masuk';</script>";
    die();
    exit();