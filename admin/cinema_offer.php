<?
session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Скидки.РФ</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet" />
		<script src="js/jquery.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="css/ie7.css" /><![endif]-->
		<!--<script type="text/javascript" src="../resource/ckfinder/ckfinder.js"></script>-->
	<script type="text/javascript">

function BrowseServer()
{
	
	var finder = new CKFinder();
	finder.basePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
	finder.selectActionFunction = SetFileField;
	finder.id = 'offer_thumb'; // выбираем миниатюру
	finder.popup();

}

function BrowseServer1()
{
	var finder = new CKFinder();
	finder.basePath = '../';
	finder.selectActionFunction = SetFileField1;
	finder.id = 'offer_swiper'; // выбираем изображение для свайпера в оффере
	finder.popup();

}

// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField( fileUrl )
{
	document.getElementById( 'xFilePath' ).value = fileUrl;
		RefreshThumbs();
}

function SetFileField1( fileUrl )
{
	document.getElementById( 'xFilePath1' ).value = fileUrl;
		RefreshThumbs();
}
function RefreshThumbs () {
	
$("#xImg").attr("src",$("#xFilePath").val());
$("#xImg1").attr("src",$("#xFilePath1").val());
	
}

function validateOfferForm() {
	
	if (validatePlacementDate() && validateAdvertiser()) {
		
		console.log('validateForm true');
		return true;
		
	}
	else {
		
		console.log('validateForm false');
		return false;
		
	}
	
	
	
	
}

function validatePlacementDate () {
	
	/*if ($('input[name="placement_date"]').val() != '') {
		
		return true;
	}
	else {
		alert ("Не указан Срок размещения акции!");
		return false;	
	}*/
	return true;
}
function validateAdvertiser () {
	
	if ($('select[name="advertiser_id"]').val() != 0) {
		
		return true;
	}
	else {
		alert ("Не указан Рекламодатель!");
		return false;	
	}
}
	</script>

	</head>
	<!--
		Note: Set the body element's class to "left-sidebar" to position the sidebar on the left.
		Set it to "right-sidebar" to, you guessed it, position it on the right.
	-->
	<body class="left-sidebar">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Content -->
					<div id="content">
						<div id="content-inner">
					
							<!-- Post -->
								<article class="is-post is-post-excerpt">
									<? require("login.php");?>
									<header>
										<h2><a>Кино</a></h2>
										
									</header>
									<? 
function show_form(){ 
        require '../config.php'; 
        $result = mysql_query("SELECT * FROM blog WHERE id = '".$_GET['id']."';", $db); 
        $row = mysql_fetch_array($result); 
?> 
<body role="application">
<script type="text/javascript" src="../resource/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../resource/ckfinder/ckfinder.js"></script>
<form action="" method="post"> 

<table cellpadding="10">

<tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Название : </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="name" value="<?=htmlspecialchars(stripslashes($row['name']));?>"  class="enter" size="50" required></td></tr>
	
<!--<tr><td><a style="font-size:20px;text-decoration:none;" >Категория:</a> </td><td>
<select name="offer_cat_id">
<? $sqlc = mysql_query("SELECT * FROM offercategories WHERE deleted=0 ORDER BY disp_order ASC");
while($rowc = mysql_fetch_array($sqlc)){
	if ($row['offer_cat_id'] == $rowc['id']) {
		echo "<option selected=\"selected\" value=$rowc[id]>$rowc[name]</option>";
	}
	else {
		echo "<option value=$rowc[id]>$rowc[name]</option>";
	}
}
?>
</select>
</td></tr>-->
<tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Ссылка на внешний сайт : </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="ext_link" value="<?=htmlspecialchars(stripslashes($row['ext_link']));?>"  class="enter" size="50"></td></tr>
<tr><td><a style="font-size:20px;text-decoration:none;" >Рекламодатель:</a> </td><td>
<select name="advertiser_id">
<?if (($row['advertiser_id'] == '') ||($row['advertiser_id'] == 0)){
		echo "<option value=0>(не определен)</option>";
	} 
?>
<?
	if (($_GET['city']) && ($_GET['city'] > 0)) {
			
				$cityfilter = "AND a.city_id=".$_GET['city'];
		}
		else {
				$cityfilter ="";
		}
		
		
 $sqlc = mysql_query("SELECT a.id AS adv_id, a.name AS adv_name, c.name AS city_name FROM advertisers a LEFT JOIN cities c ON c.id = a.city_id WHERE a.deleted=0 ".$cityfilter." ORDER BY a.name ASC");
while($rowc = mysql_fetch_array($sqlc)){
	if ($row['advertiser_id'] == $rowc['adv_id']) {
		echo "<option selected=\"selected\" value=$rowc[adv_id]>$rowc[adv_name] ($rowc[city_name])</option>";
	}
	
	else {
		echo "<option value=$rowc[adv_id]>$rowc[adv_name] ($rowc[city_name])</option>";
	}
}
?>
</select>
</td></tr>



    <tr><td><a style="font-size:20px;text-decoration:none;" >Миниатюра : </a></td><td>	<img  id="xImg" src="" class="srf_icon_preview"/>		<input id="xFilePath" style="padding:5px; background-color:#e6e6e6;font-size:15px;" name="img" type="text" size="50" value="<?=htmlspecialchars(stripslashes($row['img']));?>" />
		<input type="button" value="Выбрать" onclick="BrowseServer();" /></td>
</tr>

      <tr><td colspan="2"> <br>   <textarea name="body" class="ckeditor" cols="70" id="editor2" rows="10"> 
               
                <?=stripslashes($row['body']);?> 
      </textarea><br> </td></tr><tr></tr>
	  <tr><td colspan="2"><img  id="xImg1" src="" class="srf_thumb_preview"/></td></tr>
<tr><td><a style="font-size:20px;text-decoration:none;" >Изображение 1 : </a></td><td>		<input id="xFilePath1" style="padding:5px; background-color:#e6e6e6;font-size:15px;" name="img1" type="text" size="50" value="<?=htmlspecialchars(stripslashes($row['img1']));?>" />
		<input type="button" value="Выбрать" onclick="BrowseServer1();" /></td>
</tr>
	 
	 
	  <tr><td><a style="font-size:20px;text-decoration:none;" >Краткое описание (в списке):</a></td> 
      <td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="metadescription" class="enter" size="75" value="<?=htmlspecialchars(stripslashes($row['metadescription']));?>"> </td></tr>
      <tr><td> <a style="font-size:20px;text-decoration:none;" >Ключевые слова для поиска:</a></td><td>     <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="metakeywords" class="enter" size="75" value="<?=htmlspecialchars(stripslashes($row['metakeywords']));?>"></td></tr> <tr></tr>
     
                   
			 <tr><td><a style="font-size:20px;text-decoration:none;" >Позиция в общем списке:</td> <td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="order_section" class="enter" size="5" value="<?=htmlspecialchars(stripslashes($row['order_section']));?>"> (Введите цифрами) </td></tr>
			 <!--<tr><td><a style="font-size:20px;text-decoration:none;" >Позиция в категории:</td> <td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="order_category" class="enter" size="5" value="<?=htmlspecialchars(stripslashes($row['order_category']));?>"> (Введите цифрами) </td></tr>-->
<tr></tr>
<!--<tr>
<td><a style="font-size:20px;text-decoration:none;" >Доступность по адресам:</td> 
<td> 

<ul>

<? $sqlc = mysql_query("SELECT address FROM blog_addresses WHERE advertiser_id = '".$row['advertiser_id']. "'  ORDER BY id ASC");

while($rowc = mysql_fetch_array($sqlc)){
	
	echo '<li>' . $rowc['address'].' </li>';
}
?>
</ul>
 </td>
</tr>-->
<tr></tr>
  <tr><td><a style="font-size:20px;text-decoration:none;" >Срок размещения:</a></td> 
      <td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="date" name="placement_date" class="enter" size="25" value="<?=htmlspecialchars(stripslashes($row['placement_date']));?>"> </td></tr>
             <tr><td><a style="font-size:20px;text-decoration:none;" >Скрыть:</a> </td><td><input  type="checkbox" name="draft" style="!important" value="1" <? if($row['draft'] == "1"){ 
	echo("checked");
} ?>></td></tr><tr></tr>

 <tr><td><a style="font-size:20px;text-decoration:none;" >Кем создано:</a> </td><td><? echo $row['author'];?></td></tr>
 <tr><td><a style="font-size:20px;text-decoration:none;" >Кем изменено:</a> </td><td><? echo $row['modifiedby'];?></td></tr>

             <tr></tr>
			 <tr><td style="vertical-align:middle;"><a style="font-size:20px;text-decoration:none;" >Комментарий:</a></td> 
      <td><hr/> <textarea rows="6" cols="70" style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="comment" ><?=htmlspecialchars(stripslashes($row['comment']));?></textarea> </td></tr>

      </table>
		<script type="text/javascript">

// This is a check for the CKEditor class. If not defined, the paths must be checked.
if ( typeof CKEDITOR == 'undefined' )
{
	document.write(
		'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
		'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
		'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
		'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
		'value (line 32).' ) ;
}
else
{
	var editor = CKEDITOR.replace( 'editor2' );
	

	// Just call CKFinder.setupCKEditor and pass the CKEditor instance as the first argument.
	// The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
	CKFinder.setupCKEditor( editor, '../resource/ckfinder/' ) ;

	// It is also possible to pass an object with selected CKFinder properties as a second argument.
	// CKFinder.setupCKEditor( editor, { basePath : '../', skin : 'v1' } ) ;
}
	RefreshThumbs();
		</script>
<br>
<?
function russian_date(){
$date=explode(".", date("d.m.Y"));
switch ($date[1]){
case 1: $m='января'; break;
case 2: $m='февраля'; break;
case 3: $m='марта'; break;
case 4: $m='апреля'; break;
case 5: $m='мая'; break;
case 6: $m='июня'; break;
case 7: $m='июля'; break;
case 8: $m='августа'; break;
case 9: $m='сентября'; break;
case 10: $m='октября'; break;
case 11: $m='ноября'; break;
case 12: $m='декабря'; break;
}
$alldate = $date[0].'&nbsp;'.$m.'&nbsp;'.$date[2];
echo '<input type="hidden" name="date" value='.$alldate.'>';
}
russian_date(); ?>


      <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
	  <input type="hidden" name="city_id" value="<?=$_GET['city'];?>"> 
      <input class="submit" type="submit"  onclick="javascript: return validateOfferForm();" value="Сохранить" name="edit"> 
  
</form> </body>
<? 
} 
function complete(){ 
    
	$extlink_corr = '';
	// Check if links contain http or https. They SHOULD conatin it
	if (strlen($_POST['ext_link']) > 0) {	
			if ((strpos($_POST['ext_link'],'http://') !== false) || (strpos($_POST['ext_link'],'https://') !== false)) {
				 
				$extlink_corr = $_POST['ext_link'];
			 }
			 else {
				 
				 $extlink_corr = 'http://' . $_POST['ext_link'];
				}
	}
	 //// 
      require '../config.php'; 

      $section_id = "9"; // Кино
	  
      $result = mysql_query("SELECT * FROM blog WHERE id = '".$_POST['id']."';", $db); 

     
      $row = mysql_fetch_array($result); 

      if(empty($row['id'])) 
            $query = "INSERT INTO blog 
                     (offer_cat_id,
					  advertiser_id,
					  name,
                      img,
                      body, 
                      metakeywords,                      
                      metadescription,
                      img1,
					  
					  
					  order_section,
					  order_category,
                      date,
					  author,
                      draft,
					  ext_link,
					  placement_date,
					  comment,
                      cat_id
                      ) 
                                      VALUES 
                            ('".mysql_real_escape_string($_POST['offer_cat_id'])."', 
                             '".mysql_real_escape_string($_POST['advertiser_id'])."', 
							 
							 
							 '".trim(mysql_real_escape_string($_POST['name']))."', 
							 '".mysql_real_escape_string($_POST['img'])."', 
                             '".mysql_real_escape_string($_POST['body'])."',
                             '".mysql_real_escape_string($_POST['metakeywords'])."',
                             '".mysql_real_escape_string($_POST['metadescription'])."',
                             '".mysql_real_escape_string($_POST['img1'])."',
						
						
							 '".mysql_real_escape_string($_POST['order_section'])."', 
							 '".mysql_real_escape_string($_POST['order_category'])."', 
                             '".mysql_real_escape_string($_POST['date'])."',
							  '".mysql_real_escape_string($_SESSION['loginadmin'])."',
                             '".mysql_real_escape_string($_POST['draft'])."',
							 '".mysql_real_escape_string($extlink_corr)."',
							 '".(($_POST['placement_date'] == NULL) ? 'NULL' : mysql_real_escape_string($_POST['placement_date']))."',
							 '".mysql_real_escape_string($_POST['comment'])."', 
                             '".$section_id."'
                             )"; 
      else 
            $query = "UPDATE blog SET 
                                     offer_cat_id = '".mysql_real_escape_string($_POST['offer_cat_id'])."', 
									 advertiser_id = '".mysql_real_escape_string($_POST['advertiser_id'])."', 
									 
									 name = '".trim(mysql_real_escape_string($_POST['name']))."', 
                                     img = '".mysql_real_escape_string($_POST['img'])."', 
                                     body = '".mysql_real_escape_string($_POST['body'])."', 
                                     metakeywords = '".mysql_real_escape_string($_POST['metakeywords'])."', 
                                     metadescription = '".mysql_real_escape_string($_POST['metadescription'])."',
									 img1 = '".mysql_real_escape_string($_POST['img1'])."', 
						
                        
									 order_section = '".mysql_real_escape_string($_POST['order_section'])."', 
									 order_category = '".mysql_real_escape_string($_POST['order_category'])."', 
									 modifiedby = '".mysql_real_escape_string($_SESSION['loginadmin'])."',
                                     draft = '".mysql_real_escape_string($_POST['draft'])."',
									 ext_link = '".mysql_real_escape_string($extlink_corr)."',
									 placement_date = '".(($_POST['placement_date'] == NULL) ? 'NULL' : mysql_real_escape_string($_POST['placement_date']))."',
									 comment = '".mysql_real_escape_string($_POST['comment'])."',
                                     cat_id = '".$section_id."'
                     WHERE id = '".$_POST['id']."';"; 

      mysql_query($query, $db); 

      
	  
	  echo "<meta http-equiv='Refresh' content='0; URL=cinema_offer.php?city=".$_POST['city_id']."'>"; 
} 
function show_pages() { 
?> 
<script language='JavaScript1.1' type='text/javascript'> 
<!-- 
function Delete(N) 
{ 
     if(confirm("Удалить запись киноафиши?")) 
     { 
                 
				 parent.location='?del='+N + '&scroll=' + window.scrollY + "&city=" + getParameterByName('city');
     } 
     else 
     { 
       return false; 
     } 
} 
--> 
</SCRIPT> 
<? 
        require '../config.php'; ?>
        <h3><a class="modifiable-link" href="?id=new"><input style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" type="submit" value="Добавить запись киноафиши" ></a></h3><br>
		<div class="city-selector-container">
		<p><b>Город:</b> <select class="city-selector" name="advertiser_id">
		<option value="0">Все города</option>
<?

$sqlc = mysql_query("SELECT id, name FROM cities WHERE deleted=0 ORDER BY name ASC");
while($rowc = mysql_fetch_array($sqlc)){
	
		echo "<option value=$rowc[id]>$rowc[name]</option>";
	
	
}
?>
</select> </p>

</div>

		<? 
		
if (($_GET['city']) && ($_GET['city'] > 0)) {
			
				$cityfilter = "AND a.city_id=".$_GET['city'];
		}
		else {
				$cityfilter ="";
		}

		
		// Sorting
		$default_sort_field="placement_date";
		$default_sort_order="desc";
		
		$sortfield =  $_GET["sortfield"];
		$sortorder = $_GET["sortorder"];
		
		$sortlink = '&sortfield='.$default_sort_field.'&sortorder='.$default_sort_order;
	    $sorticon = '&utrif;';
							
		if ($sortfield && $sortorder) {
			if (($sortorder == 'desc') || ($sortorder == 'asc')) {
					$sortstring = $sortfield." ".$sortorder.",";
					
					if ($sortorder == 'asc') {
							$sortlink = '&sortfield='.$sortfield.'&sortorder=desc';
							$sorticon = '&utrif;';
					}
					elseif ($sortorder == 'desc') {
						
							$sortlink = '&sortfield='.$sortfield.'&sortorder=asc';
							$sorticon = '&dtrif;';
					}
					
			}
			
		}
		 $result = mysql_query("SELECT b.id as id, b.draft as draft, b.name as name, b.date as date,b.date1,b.placement_date, b.protected, a.name as adv_name, a.id as advid, a.draft as adv_draft, c.name as city_name, b.author,b.modifiedby FROM blog b LEFT JOIN advertisers a ON b.advertiser_id=a.id LEFT JOIN cities c ON c.id = a.city_id WHERE b.deleted=0 AND cat_id=9 ".$cityfilter." ORDER BY ".$sortstring." b.id DESC", $db); 
		
		$result_hidden_offers = mysql_query("SELECT b.id FROM blog b LEFT JOIN advertisers a ON b.advertiser_id=a.id LEFT JOIN cities c ON c.id = a.city_id WHERE b.draft=1 AND b.deleted=0 AND cat_id=9 ".$cityfilter." ORDER BY ".$sortstring." b.id DESC", $db); 
		$result_hidden_by_adv = mysql_query("SELECT b.id FROM blog b LEFT JOIN advertisers a ON b.advertiser_id=a.id LEFT JOIN cities c ON c.id = a.city_id WHERE (b.draft=1 OR a.draft=1) AND b.deleted=0 AND cat_id=9 ".$cityfilter." ORDER BY ".$sortstring." b.id DESC", $db); 
		
		
		$num_rows_total = mysql_num_rows($result);	
		$num_rows_hidden_offers = mysql_num_rows($result_hidden_offers);	
		$num_rows_hidden_by_adv = mysql_num_rows($result_hidden_by_adv);	
		$num_rows_active = $num_rows_total - $num_rows_hidden_offers;
		$num_rows_active_actual = $num_rows_total - $num_rows_hidden_by_adv;
		
		echo '<div class="count-container"><span class="count-total">Всего: <b>'.$num_rows_total.'</b></span><span class="count-active">Активных:  <b>' .$num_rows_active.'</b></span> (фактически <b>'.$num_rows_active_actual.'</b>)<span class="count-hidden">Скрытых:  <b>' .$num_rows_hidden_offers.' </b></span> (фактически <b>'.$num_rows_hidden_by_adv.'</b>)</div>';		
		
		
        echo ' 
<table cellspacing="10" cellpadding="13" style="border-spacing: 2px; border-collapse:inherit;"> 
<tr class="table-head"> 
 <td style="width:50px;">ID</td>
  <td> 
   Название
  </td>
    <td>
  Рекламодатель
  </td>
    <td>
  Город
  </td>
  <td>
  Статус
  </td>
    <td>Статус рекламодателя</td>
  <td ><a href="/admin/cinema_offer.php?city='.$_GET['city'].$sortlink.'">Срок размещения '.$sorticon.'</a></td>
   <td>Кем создано</td>
 <td>
 Создано
  </td>
  <td>Кем изменено</td>
   <td>
 Изменено
  </td>
  
  <td>
  Удалить
  </td>
</tr>'; 

        while($row = mysql_fetch_array($result)){ 
        if ($row['draft'] == 0){$status = "Активно";  $status_style_class = "status-active";}
        if ($row['draft'] == 1){$status = "Скрыто"; $status_style_class = "status-hidden";}
		if ($row['adv_draft'] == 0){$adv_status = "Активен"; $adv_status_style_class = "status-active";}
        if ($row['adv_draft'] == 1){$adv_status = "Скрыт";$adv_status_style_class = "status-hidden";}
               echo ' 
<tr> 
<td>'.stripslashes($row['id']).'</td>
  <td> 
     <a class="modifiable-link" href="?id='.$row['id'].'">'.stripslashes($row['name']).'</a> 
  </td> 
  <td><a class="modifiable-link" href="advertisers.php?id='.$row['advid'].'" target="_blank">'.$row['adv_name'].'</a></td>
  <td>'.$row['city_name'].'</td>
  <td class="'.$status_style_class.'">'.$status.'</td>
    <td class="'.$adv_status_style_class.'">'.$adv_status.'</td>
  <td>'.(($row['placement_date'] == '0000-00-00') ? '':date_format(date_create($row['placement_date']), 'd.m.Y')) .'</td>
  <td>
  '.stripslashes($row['author']).'
  </td>  
    <td> 
     <a>'.stripslashes($row['date']).'</a> 
  </td> 
  <td>
  '.stripslashes($row['modifiedby']).'
  </td>  
   <td> 
     <a>'.date('d.m.Y',strtotime(stripslashes($row['date1']))).'</a> 
  </td> 
  <td> 
     <a href="#" OnClick="Delete('.$row['id'].')">Удалить</a> 
  </td> 
</tr>'; 

        } 
        echo ' 
</table>'; 
?>
<script language='JavaScript1.1' type='text/javascript'>
function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

(function SetScrollTop () {
	
	var scroll_to = getParameterByName('scroll');
	if ((typeof(scroll_to) != "undefined") && (scroll_to > 0)) {
		window.scrollTo(0,scroll_to);
	}
})();




$('.city-selector').change(function() {
	
	
	parent.location= parent.location.protocol + '//' + parent.location.host + parent.location.pathname+"?city=" + this.value;
});
</script>

<?
} 
function delete_pages(){ 
        require '../config.php'; 
        $query = "UPDATE blog SET deleted='1' WHERE id = '".$_GET['del']."';"; 
        mysql_query($query, $db); 
        echo '<h3>Запись удалена</h3>'; 
} 
if($_GET['del']) delete_pages(); 
if($_POST['edit']) complete(); 
if($_GET['id']) show_form(); 
else show_pages(); 
?> 

								</article>
						</div>
					</div>

		<!-- Sidebar -->
					<div id="sidebar">
						<!-- Logo -->
						<center><a class="modifiable-link"  href="index.php"><img width="150" src="../images/lwt.png"></a></center>
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li ><a class="modifiable-link" href="post.php">Товары и услуги</a></li>
									<li><a class="modifiable-link" href="food_offer.php">Продукты</a></li>
									<!--<li><a class="modifiable-link" href="alco_offer.php">Алкоголь</a></li>-->
									<li><a class="modifiable-link" href="news_offer.php">Новости</a></li>
									<li><a class="modifiable-link" href="event_offer.php">События</a></li>
									<li  class="current_page_item"><a class="modifiable-link" href="cinema_offer.php">Кино</a></li>
									<li><a class="modifiable-link" href="money_offer.php">Деньги</a></li>
									
										
									<!--<li><a href="categories.php">Разделы</a></li>-->
									<!--<li><a href="page.php">Страницы</a></li>
									<li><a href="sidebar.php">Сайдбар</a></li>
									<li><a href="theme.php">Темы</a></li>
									<li><a href="link.php">Ссылки</a></li>
									<li><a href="comment.php">Комментарии</a></li>-->
									<li><a class="modifiable-link" href="advertisers.php">Рекламодатели</a></li>
									
									<li><a class="modifiable-link" href="foods_distributors.php">Торговые сети</a></li>
									<li><a class="modifiable-link" href="offercategories.php">Категории</a></li>
									<li><a  class="modifiable-link" href="cities.php">Города</a></li>
									<li><a href="user.php">Пользователи</a></li>
									<li><a href="pref.php">Настройки</a></li>
									<li><a href="exit.php">Выход</a></li>
								</ul>
							</nav>
							<!-- Version -->
							<!--<section class="is-text-style1">
								<div class="inner">
									<p><? include("info.php"); ?>
										<strong>Версия:</strong> <?=$bundle?>
									</p>
								</div>
							</section>-->
						<!-- Copyright -->
							<div id="copyright">
								<p>
									<?=$year.$copyright.$company?><br />
								</p>
							</div>
					</div>
			</div>
	</body>
	<script language='JavaScript1.1' type='text/javascript'>
	function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}


	var city_selected = getParameterByName('city');

if ((typeof(city_selected) != "undefined") && (city_selected > 0)) {
	$('.city-selector').val(city_selected);	
	
	var par_prefix ="";
	$("a.modifiable-link").each(function() {
		if (this.href.indexOf("?") == -1) {
			par_prefix = "?";
			
		}
		else {
			par_prefix = "&";
		}
		this.href=this.href + par_prefix+"city=" + city_selected;
	});
}
</script>
</html>
