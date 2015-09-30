<?php
	require_once("function.php");
	//data.php
	//siia pääseb ligi sisseloginud kasutaja
	//kui kasutaja ei ole sisseloginud, siis suunan data.php lehele
	//kui kasutaja on issse loginud; siisi suunan data.php lehele
	if(!isset($_SESSION["logged_in_user_id"])){
		header("Location: login.php");
	}

	//kasutaja tahab välja logida
	if(isset($_GET["logout"])){
		//aadressireal on olemas muutuja logout
		
		//kustutame kõik session muutujad ja peatame sessiooni
		session_destroy();
		
		header("Location: login.php");
	}
	
?>
<p>Tere,  <?php echo $_SESSION["logged_in_user_email"];?>
	<a href="?logout=1"> Logi välja </p> 