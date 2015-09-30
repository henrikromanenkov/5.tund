<?php
	//siia tulevad funktsioonid. kõik mis seotud AB'iga
	
	// Loon andmebaasi ühenduse
	require_once("../../config_global.php");
	$database = "if15_henrrom";
	
	
	//võtab andmed ja sisestab andmebaasi
	function createUser($user_email, $hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare('INSERT INTO user_sample (email, password) VALUES (?, ?)');
		// asendame küsimärgid. ss - s on string email, s on string password
		$stmt->bind_param("ss", $user_email, $hash);
		$stmt->execute();
		$stmt->close();
		$mysqli->close();
	}

	function loginUser($log_email, $hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $hash);
		//muutujad tulemustele
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
		//kontrolli, kas tulemus leiti
		if($stmt->fetch()){
			//ab'i oli midagi
			echo "Email ja parool õiged, kasutaja id=".$id_from_db;	
		}else{
			//ei leidnud
			echo "wrong credentials";
		}			
		$stmt->close();
		$mysqli->close();	
	}
	
?>