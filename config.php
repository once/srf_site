<? 
/*
Loutskiy CMS 6 Lucid Lynx;
Developer: Loutskiy WebTechnologies;
License: FREE GNU GPL;
Date: 11 October 2013;
Country: Russia Federation;
Copyright © Loutskiy WebTechnologies. All right reserved!
*/
/*
Loutskiy CMS 6 Lucid Lynx;
Разработчик: Loutskiy WebTechnologies;
Лицензия: FREE GNU GPL;
Дата: 11 Октября 2013;
Страна: Российская Федерация;
Copyright © Loutskiy WebTechnologies. Все права защищены!
*/
?>
<?php
/*
DB MySQL
*/
$HOST 		= 'localhost';				//Server (By Default localhost)
$USER 		= 'olegkirian';				//User
$PASS 		= 'Skidrf2016';				//Password
$DBN 		= 'olegkirian';				//DB Name

$OFFERS_SECTION_ID = "1";
$FOODS_SECTION_ID = "8";
$FOOD_CATEGORY_ID = "15";
$ALCOHOL_CATEGORY_ID = "16";

$db = mysql_connect ($HOST, $USER, $PASS);
mysql_select_db ($DBN, $db);

mysql_query('SET NAMES utf8;');

/*
End
*/
?>