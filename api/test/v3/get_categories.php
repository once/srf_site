<?php header('Access-Control-Allow-Origin: *'); ?>
<?
	include "../../../config_test.php"; //Файл конфигурации БД
				
	$strSQL = "SELECT oc.id, oc.name, oc.icon, c.id_name AS section_id, oc.disp_order, oc.parent_id FROM offercategories oc LEFT JOIN categories c ON c.id = oc.section_id WHERE draft=0 AND deleted=0 ORDER BY disp_order ASC;";	
	
	
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
  "categories":';
	echo json_encode($resultArray);
	echo '}';
?>