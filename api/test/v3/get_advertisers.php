<?php 

	header('Access-Control-Allow-Origin: *');

	if($_GET['city'] && $_GET['city'] != 0) {
		$cityselector = " AND fd.city_id=".$_GET['city'];
	}
	else {
		$cityselector= "";

	}
	$server_name = "http://".$_SERVER['SERVER_NAME'];

	include "../../../config_test.php"; //Файл конфигурации БД
	
	$strSQL = "SELECT fd.id, fd.name, NULL as icon,  CONCAT ('".$server_name."',fd.img) as img, 'foods' as section_id, fd.disp_order FROM foods_distributors fd WHERE fd.draft=0 AND fd.deleted=0 ".$cityselector." ORDER BY fd.disp_order ASC;";	
	
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
  "advertisers":';
	echo json_encode($resultArray);
	echo '}';
?>