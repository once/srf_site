<?
/*
	Loutskiy CMS 6 - Free public Content Manager System for sites.
    Copyright (C) 2013  Loutskiy WebTechnologies

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
session_start()?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?
$configfile = "config.php";
if (file_exists($configfile)){ }
else {
	die(include("resource/install/index.php"));
}
include "config.php";
$sqlthemes = mysql_query("SELECT * FROM themes WHERE active=1");
$rowthemes = mysql_fetch_array($sqlthemes);
$dir = $rowthemes['dir'];
$sqlsite = mysql_query("SELECT * FROM site");
$rowsite = mysql_fetch_array($sqlsite);
if ($rowsite['Close'] == "1"){
	die(include("resource/close.php"));
}
$sqllinks = mysql_query("SELECT * FROM links ORDER BY ord");
$rowlinks = mysql_fetch_array($sqllinks);
$sqlsidebar = mysql_query("SELECT * FROM sidebar ORDER BY ord");
$rowsidebar = mysql_fetch_array($sqlsidebar);
$ipguest = $_SERVER["REMOTE_ADDR"];
$browserguest = $_SERVER['HTTP_USER_AGENT'];
$page = $_SERVER['REQUEST_URI'];
$query = mysql_query("INSERT INTO statistic (ip, browser, page) values ('$ipguest', '$browserguest', '$page')");
if (empty($rowsite['Favicon'])){
	$rowsite['Favicon'] = 'images/favicon.png';
}
if (empty($rowsite['iOS'])){
	$rowsite['iOS'] = 'images/lwt.png';
}
$dir = $rowthemes['dir'];
require_once "resource/class/kernel.php";
$sites = array(
    "en" => "themes/$dir/lang/en.php",
    "ru" => "themes/$dir/lang/ru.php",
	"de" => "themes/$dir/lang/de.php",
);

$lang = $rowsite['Language'];
if (empty($lang) or $lang == ''){
	$lang = 'en';
}
if (!in_array($lang, array_keys($sites))){
    $lang = 'en';
}
include($sites[$lang]);
if ($lang == "en") $language = "themes/$dir/lang/en.php";
if ($lang == "ru") $language = "themes/$dir/lang/ru.php";
if ($lang == "de") $language = "themes/$dir/lang/de.php";
include "themes/$dir/info.php";
include "resource/class/head.php";
?>
