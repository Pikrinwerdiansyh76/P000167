<?php

	function tambahSitemap($database, $id_sub_sitemap, $loc, $priority, $link){

		require "../../../appweb/Config/Db.php";
		global $count;
		global $insertId;

		try{
			$stmt = $pdo->prepare("INSERT INTO $database
							(id_sub_sitemap,loc,lastmod,priority)
							VALUES(:id_sub_sitemap,:loc,now(),:priority)" );
					
			$stmt->bindParam(":id_sub_sitemap", $id_sub_sitemap, PDO::PARAM_STR);
			$stmt->bindParam(":loc", $loc, PDO::PARAM_STR);
			$stmt->bindParam(":priority", $priority, PDO::PARAM_STR);
				
			$count = $stmt->execute();
					
			$insertId = $pdo->lastInsertId();
					
		}catch(PDOException $e){
			$_SESSION['_msg__'] = 'Gagal';
			echo "<script>window.location(history.back(0))</script>";
			die();
    		exit();
		}

	}

	function editSitemap($database, $id_sitemap, $id_sub_sitemap, $loc, $priority, $link){

		require "../../../appweb/Config/Db.php";
		global $count;
		global $id_sitemap;

		try {
			$sql = "UPDATE $database
					SET id_sub_sitemap	= :id_sub_sitemap,
						loc   			= :loc,
						lastmod 	 	= now(),
						priority 		= :priority
					WHERE id_$database 	= :id_sitemap
				";
						  
			$statement = $pdo->prepare($sql);

			$statement->bindParam(":id_sitemap", $id_sitemap, PDO::PARAM_INT);
			$statement->bindParam(":id_sub_sitemap", $id_sub_sitemap, PDO::PARAM_STR);
			$statement->bindParam(":loc", $loc, PDO::PARAM_STR);
			$statement->bindParam(":priority", $priority, PDO::PARAM_STR);

			$count = $statement->execute();
					
		}catch(PDOException $e){
			$_SESSION['_msg__'] = 'Gagal';
			echo "<script>window.location(history.back(0))</script>";
			die();
    		exit();
		}

	}

	function hapusSitemap($database, $id_sitemap){

		require "../../../appweb/Config/Db.php";
		global $count;

		try{
			$del 	= $pdo->query("DELETE FROM $database WHERE id_$database='$id_sitemap'");
			$count 	= $del->execute();
		}catch (PDOException $e) {
			$_SESSION['_msg__'] = 'Gagal';
			echo "<script>window.location(history.back(0))</script>";
			die();
    		exit();
		}

	}