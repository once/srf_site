<?php

 // Execute stored procedure
 
	include "config.php"; //Файл конфигурации БД
	
	$query = mysql_query("CALL disable_outdated_offers();");
	
	$query = mysql_query("CALL outdated_food_mark_deleted();");
	
	if ($query === false) {
		
		echo mysql_errno() . ' : ' . mysql_error();
		
	}
	
	mysql_close($db);
	
?>