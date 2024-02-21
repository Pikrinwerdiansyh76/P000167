<?php

	if($_GET['module']=='dashboard') { 
		include("appweb/Views/dashboard.php");
	}

	elseif($_GET['module']=='siswa') { 
		include("appweb/Views/siswa.php");
	}elseif($_GET['module']=='guru') { 
		include("appweb/Views/guru.php");
	}elseif($_GET['module']=='kelas') { 
		include("appweb/Views/kelas.php");
	}elseif($_GET['module']=='semester') { 
		include("appweb/Views/semester.php");
	}elseif($_GET['module']=='mapel') { 
		include("appweb/Views/mapel.php");
	}elseif($_GET['module']=='wali-kelas') { 
		include("appweb/Views/wali-kelas.php");
	}elseif($_GET['module']=='jadwal-mengajar') { 
		include("appweb/Views/jadwal-mengajar.php");
	}elseif($_GET['module']=='presensi') { 
		include("appweb/Views/presensi.php");
	}elseif($_GET['module']=='rekap-presensi') { 
		include("appweb/Views/rekap-presensi.php");
	}

	elseif($_GET['module']=='pengaturan') { 
		include("appweb/Views/settings.php");
	}elseif($_GET['module']=='pegawai') { 
		include("appweb/Views/employee.php");
	}else{
		echo "<script>window.location = '404';</script>";
	}

?>