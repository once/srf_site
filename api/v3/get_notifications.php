<?php header('Access-Control-Allow-Origin: *'); ?>
<?

$server_name = "http://".$_SERVER['SERVER_NAME'];
	
$platform = "undefined";

if(!$_GET['userid']) {
	echo 'No userid specified';
	die();
	
}

// we use Push ID (like ae133e5e-0ec2-42fc-9767-5e9a74eab1a9) as user id

$userid = $_GET['userid'];

if($_GET['limit']) {
	$limit = "LIMIT " . $_GET['limit'];
}
else {
	$limit = "";

}

if($_GET['platform']) {

	if ($platform != "") $platform = $_GET['platform'];
}
else {
	$platform = "undefined";

}

	include "../../config.php"; //Файл конфигурации БД
	
	
	
	//$strSQL = "SELECT b.id, b.name, b.date, CONCAT ('".$server_name."',b.img) as img, b.discount_size,NULLIF(b.system_date_to,0) as system_date_to, a.name as adv_name, b.pr_cat, b.exclusive, UNIX_TIMESTAMP(b.date1) AS modify_date FROM app_users au LEFT JOIN notifications n ON au.id = n.user_id LEFT JOIN blog b ON n.offer_id = b.id LEFT JOIN advertisers a ON a.id = b.advertiser_id WHERE au.push_id = '".$userid."' AND n.active=1 AND b.deleted=0 AND ((DATE_ADD(b.system_date_to, INTERVAL 1 DAY) > NOW()) OR (ISNULL(b.system_date_to) or b.system_date_to = '0000-00-00')) AND (platform='".$platform."' OR platform='all') " . $limit .  " ;";	
	
	$strSQL = "SELECT b.id, b.name, b.date, CONCAT ('".$server_name."',b.img) as img, b.discount_size,NULLIF(b.system_date_to,0) as system_date_to, a.name as adv_name, b.pr_cat, b.exclusive, UNIX_TIMESTAMP(b.date1) AS modify_date FROM notifications n LEFT JOIN blog b ON n.offer_id = b.id LEFT JOIN advertisers a ON a.id = b.advertiser_id WHERE n.user_push_id = '".$userid."' AND n.active=1 AND b.deleted=0 AND ((DATE_ADD(b.system_date_to, INTERVAL 1 DAY) > NOW()) OR (ISNULL(b.system_date_to) or b.system_date_to = '0000-00-00')) AND (platform='".$platform."' OR platform='all') " . $limit .  " ;";	
	
	
	
	$objQuery = mysql_query($strSQL);
	$intNumField = mysql_num_fields($objQuery);
	$resultArray = array();
	while($obResult = mysql_fetch_array($objQuery))
	{
		$arrCol = array();
		for($i=0;$i<$intNumField;$i++)
		{
			$arrCol[mysql_field_name($objQuery,$i)] = $obResult[$i];
		}
		array_push($resultArray,$arrCol);
	}
	

	
	mysql_close($db);
	
	echo '{
  "notifications":';
	echo json_encode($resultArray);
	
	echo '}';
?>