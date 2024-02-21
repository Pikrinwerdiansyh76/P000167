<?php

	function cekSlug($database, $slug){
		require "../../../appweb/Config/Db.php";

		try{
			$stmt   = $pdo->prepare("
						SELECT slug
	                    FROM $database
	                    WHERE slug = ? LIMIT 1");

            $stmt->bindValue(1, $slug);
            $stmt->execute();

            $rows	= $stmt->rowCount();
            if ($rows>0) {
            	$_SESSION['_msg__'] = 'GagalSlug';
				echo "<script>window.location(history.back(0))</script>";
				die();
	    		exit();
            }
		}catch(PDOException $e){
			$_SESSION['_msg__'] = 'Gagal';
			echo "<script>window.location(history.back(0))</script>";
			die();
    		exit();
		}
	}

	function seoTitle($t_title, $t_seo){
		global $title;

		if (empty($t_title) || $t_title===NULL || $t_title===0) {
            $my_title 	= preg_replace('/<[^<]+?>/', ' ', $t_seo);
            $title    	= substr($my_title, 0,156);
        }else{
            $title  	= htmlspecialchars(substr($t_title, 0,156));
        }

        return $title;
	}

	function seoKeyword($t_keyword, $t_seo){
		global $keyword;

		if (empty($t_keyword) || $t_keyword===NULL || $t_keyword===0) {
            $my_keyword	= preg_replace('/<[^<]+?>/', ' ', $t_seo);
            $keyword 	= substr($my_keyword, 0,256);
        }else{
            $keyword 	= htmlspecialchars(substr($t_keyword, 0,256));
        }

        return $keyword;
	}

	function seoDescription($t_description, $t_seo){
		global $description;

		if (empty($t_description) || $t_description===NULL || $t_description===0) {
            $my_description	= preg_replace('/<[^<]+?>/', ' ', $t_seo);
            $description  	= substr($my_description, 0,400);
        }else{
            $description 	= htmlspecialchars(substr($t_description, 0,400));
        }

        return $description;
	}