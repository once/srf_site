<?
include("../config.php");
$mess = $_POST['mess'];
$check = $_POST['block'];
$query = mysql_query("UPDATE site SET
Close = '$check',
CloseMess = '$mess' WHERE id=1");
echo("<html><head><meta http-equiv='Refresh' content='0; URL=close.php'></head></html>");
?>