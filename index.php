<?php

	require('assets/functions.php');
	require('assets/zip_class.php');
	
	# Minimal amount of faces to donwload by default
	define('TEMP_DURATION',240);
	clearTemp();
	$temp_folder='quidams_'.hash('sha1',microtime());
	@mkdir('temp/'.$temp_folder);
	$prevpic='';
	if (!empty($_GET['nb'])){
		$_GET['nb']=filter_var($_GET['nb'],FILTER_SANITIZE_NUMBER_INT);
		// download
		for ($i=0;$i<=$_GET['nb'];$i++){
			do{
				$pic=file_get_contents('https://thispersondoesnotexist.com/');
			}while($pic==$prevpic);
			file_put_contents('temp/'.$temp_folder.'/face'.$i.'.jpg', $pic);
			$prevpic=$pic;
		}

		// create zip
		$zip=new zip();
		$zip->create('temp/'.$temp_folder.'/','temp/'.$temp_folder.'.zip','temp/');

		// download link
		$zip->download();

	}
	
?><!DOCTYPE html>
<html>
<head>
	<title>Quidams</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
	<section><form action="index.php" method="GET">
	<h1>Combien de visages ?</h1><h2>How many faces ?</h2>
	<input type="range" name="nb" min="1" max="1000" value="10" oninput="this.nextElementSibling.innerHTML=this.value"><h3>10</h3>
	<button type="submit">Zip !</button>

</form></section>

</body>
</html>

