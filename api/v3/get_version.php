<?php header('Access-Control-Allow-Origin: *');?>

<?php
	
	$last_version = "3.14";
	
	// platform
	// city
			
	if(!$_GET['platform'] || !$_GET['city']) {
		echo 'Required parameters not specified.';
		die();
	}
	
	$platform = $_GET['platform'];
	$city = $_GET['city'];
	
	$version =0;
	
	
	switch ($city) {
		
		case 1 :    // Архангельск
			$app_id_android = "com.jumbocapital.skidki29";
			$app_id_ios = "id963072344";
			break;
		case 3 : // Вологда
			$app_id_android = "com.srf.vologda";
			$app_id_ios = "id980231140";
			break;
			
		case 7 : // Рязань
			$app_id_android = "com.srf.ryazan2";
			$app_id_ios = "id1143168220";
			break;
			
		case 8 : // Белгород
			$app_id_android = "com.srf.belgorod";
			$app_id_ios = "id1148343244";
			break;
			
		case 9 : // Тула
			$app_id_android = "com.srf.tula";
			$app_id_ios = "id1159476617";
			break;
		
		case 10 : // Ставрополь
			$app_id_android = "com.srf.stavropol";
			$app_id_ios = "id1161225196";
			break;
		
		default: 
			break;
		
		
	}
	
		switch ($platform) {
		
		case "android":
			$version = $last_version;
			$market_url = "https://play.google.com/store/apps/details?id=" . $app_id_android;
			break;
		case "ios":
			$version = $last_version;
			$market_url = "itms-apps://itunes.apple.com/app/" . $app_id_ios;
			break;
			
		default:
		
			$version = $last_version;
			$market_url = "https://play.google.com/store/apps/details?id=" . $app_id_android;
			break;
	}

		
	echo "{
	\"version\": $version, \"link\": \"$market_url\" } ";
		
	
	