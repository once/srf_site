<?
include"config.php";
$sqlsite = mysql_query("SELECT * FROM site WHERE id=1 LIMIT 1");
$rowsite = mysql_fetch_array($sqlsite);
if ($rowsite['Close'] == "1"){
	echo $rowsite['CloseMess'];
}
else {
	echo'<head>
<meta http-equiv="refresh" content="0;URL=index.php" />
</head>';
}
?>