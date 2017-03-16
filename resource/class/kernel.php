<?
$commentaries 	= 1;
$search			= $rowsite['Search'];
$urllink 		= $_SERVER['REQUEST_URI'];

/* Простые переменные */
$title 			= $rowsite['Name'];
$logo 			= $rowsite['Logo'];
$logo1			= "<img class='logosite' src='$logo'>";
$description 	= $rowsite['Description'];
define('SITE_DESC', $description);
$about			= $rowsite['About'];
define('SITE_ABOUT', $about);
/* ~Простые переменные~ */

if(!empty($logo)){define('SITE_TITLE', $logo1);}
else{define('SITE_TITLE', $title);}

/* Переменные только для раздела Блог */
if (substr($_SERVER['REQUEST_URI'], 0, 9) == '/post.php'){
	require 'config.php';
	 
	$_GET['id'] = htmlspecialchars($_GET['id']); 
	$_GET['id'] = intval($_GET['id']);	
	if(empty($_GET['id'])) $_GET['id'] = 1; 
	$resultBlog = mysql_query("SELECT * FROM blog WHERE id = '".$_GET['id']."'"); 
	$rowBlog = mysql_fetch_array($resultBlog); 
	if (empty($rowBlog['name'])){
		echo '<meta http-equiv="refresh" content="0;URL=404.php">';
		exit();
	} 
	$blogname		= $rowBlog['name'];
	define('BLOG_TITLE', $blogname);
	$blogdate		= $rowBlog['date'];
	define('BLOG_DATE', $blogdate);
	$blogbody		= stripslashes($rowBlog['body']);
	define('BLOG_BODY', $blogbody);
	$blogkey		= $rowBlog['metakeywords'];
	define('BLOG_KEY', $blogkey);
}
/* ~Переменные только для раздела Блог~ */

/* Переменные только для раздела Страницы */
if (substr($_SERVER['REQUEST_URI'], 0, 9) == '/page.php'){
	require 'config.php'; 
	$_GET['id'] = htmlspecialchars($_GET['id']); 
	$_GET['id'] = intval($_GET['id']);
	if(empty($_GET['id'])) $_GET['id'] = 1; 
	$resultBlog = mysql_query("SELECT * FROM pages WHERE id = '".$_GET['id']."'"); 
	$rowBlog = mysql_fetch_array($resultBlog); 
	if (empty($rowBlog['Name'])){
		echo '<meta http-equiv="refresh" content="0;URL=404.php">';
		exit();
	} 
	$pagename		= $rowBlog['Name'];
	define('PAGE_TITLE', $pagename);
	$pagebody		= stripslashes($rowBlog['body']);
	define('PAGE_BODY', $pagebody);
	$pagekey		= $rowBlog['metakeywords'];
	define('PAGE_KEY', $pagekey);
}
/* ~Переменные только для раздела Страницы~ */

/* Функции */
function menu(){
	echo '<li class="first"><a href="index.php">'.TEMPLATE_FIRST.'</a></li>'; 
	$resultMenu = mysql_query("SELECT * FROM categories WHERE disp=1 ORDER BY ord ASC LIMIT 8"); 
    while($rowMenu = mysql_fetch_array($resultMenu)){ 
    echo '<li class="first"><a href="categories.php?id='.$rowMenu['id'].'"">'.$rowMenu['name'].'</a></li>';
	} 
	$resultMenu2 = mysql_query("SELECT * FROM pages WHERE disp=1 ORDER BY ord ASC LIMIT 8"); 
    while($rowMenu2 = mysql_fetch_array($resultMenu2)){ 
    	echo '<li class="first"><a href="page.php?id='.$rowMenu2['id'].'"">'.$rowMenu2['Name'].'</a></li>';
	} 
}
function blog(){
	include "resource/pag.php";
	echo $paginate;
	while($row = mysql_fetch_array($result)){
	$cat_id = $row['cat_id'];
	$sqlcat = mysql_query("SELECT * FROM categories WHERE id=$cat_id LIMIT 1");
	$rowcat = mysql_fetch_array($sqlcat);
	$cat = $rowcat['name'];
		$string = $row['body'];
		$string = iconv("UTF-8","windows-1251", $string);
		$string = strip_tags($string);
		$string = mb_substr($string, 0, 450);
		$string = rtrim($string, "!,.-");
		$string = iconv("windows-1251", "UTF-8", $string);
	
		echo '<div class="box"><a style="font-size:30px;" href="post.php?id='.$row['id'].'"">'.$row['name'].'</a><br><a style="color:grey;font-size:13px;">'.TEMPLATE_DATE.': '.$row['date'].' | '.TEMPLATE_CATEGORY.': <a href=categories.php?id='.$cat_id.'>'.$cat.'</a></a><p><img class="minipic" src='.$row['img'].'>'.$string.'...</p><p align="right"><a>'.TEMPLATE_KEY.':</a><a style="color:black;"> '.$row['metakeywords'].'</a> | <a href="post.php?id='.$row['id'].'"">'.TEMPLATE_MORE.'</a></p><hr></div>';
	} 
	echo $paginate;
}
function categories($cat_id){
	include "config.php";
	
	$sql = mysql_query("SELECT PageCount FROM site LIMIT 1");
	$row = mysql_fetch_array($sql);
	$tableName="blog";		
	$targetpage = $_SERVER['REQUEST_URI']; 
	$limit = $row['PageCount']; 
	if (empty($limit) or $limit == '' or $limit == '0'){
		$limit = 10;
	}
	$query = "SELECT COUNT(*) as num FROM $tableName WHERE cat_id=$cat_id";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	$stages = 3;
	$page = mysql_escape_string($_GET['page']);
	if($page){
		$start = ($page - 1) * $limit; 
	}else{
		$start = 0;	
		}	
	
    // Get page data
	$query1 = "SELECT * FROM $tableName WHERE cat_id=$cat_id ORDER BY id DESC LIMIT $start, $limit";
	$result = mysql_query($query1);
	
	// Initial page num setup
	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	
	$paginate = '';
	if($lastpage > 1)
	{	
	

	
	
		$paginate .= "<div class='paginate'>";
		// Previous
		if ($page > 1){
			$paginate.= "<a href='$targetpage&page=$prev'>".TEMPLATE_PRE."</a>";
		}else{
			$paginate.= "<span class='disabled'>".TEMPLATE_PRE."</span>";	}
			

		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<span class='current'>$counter</span>";
				}else{
					$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage&page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage&page=$lastpage'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='$targetpage&page=1'>1</a>";
				$paginate.= "<a href='$targetpage&page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage&page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage&page=$lastpage'>$lastpage</a>";		
			}
			// End only hide early pages
			else
			{
				$paginate.= "<a href='$targetpage&page=1'>1</a>";
				$paginate.= "<a href='$targetpage&page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a href='$targetpage&page=$next'>".TEMPLATE_NEXT."</a>";
		}else{
			$paginate.= "<span class='disabled'>".TEMPLATE_NEXT."</span>";
			}
			
		$paginate.= "</div>";		
	
	
}
echo $paginate;
	while($row = mysql_fetch_array($result)){
	$cat_id = $row['cat_id'];
	$sqlcat = mysql_query("SELECT * FROM categories WHERE id=$cat_id LIMIT 1");
	$rowcat = mysql_fetch_array($sqlcat);
	$cat = $rowcat['name'];
		$string = $row['body'];
		$string = iconv("UTF-8","windows-1251", $string);
		$string = strip_tags($string);
		$string = mb_substr($string, 0, 450);
		$string = rtrim($string, "!,.-");
		$string = iconv("windows-1251", "UTF-8", $string);
		echo '<div class="box"><a style="font-size:30px;" href="post.php?id='.$row['id'].'"">'.$row['name'].'</a><br><a style="color:grey;font-size:13px;">'.TEMPLATE_DATE.': '.$row['date'].' | '.TEMPLATE_CATEGORY.': <a href=categories.php?id='.$cat_id.'>'.$cat.'</a></a><p><img class="minipic" src='.$row['img'].'>'.$string.'...</p><p align="right"><a>'.TEMPLATE_KEY.':</a><a style="color:black;"> '.$row['metakeywords'].'</a> | <a href="post.php?id='.$row['id'].'"">'.TEMPLATE_MORE.'</a></p><hr></div>';
	} 
	echo $paginate;

}
function login(){
	$sqlusers = mysql_query("SELECT * FROM site WHERE id=1 LIMIT 1");
	$rowusers = mysql_fetch_array($sqlusers);
	if ($rowusers['users'] == "1"){
		include "resource/login.php";
	} 
}
function sidebar(){
	$resultSidebar = mysql_query("SELECT * FROM sidebar ORDER BY ord"); 
    while($rowSidebar = mysql_fetch_array($resultSidebar)){ 
    	echo '<div class="box"><h3>'.$rowSidebar['Name'].'</h3>'.$rowSidebar['body'].'</div>';
    } 
}
function links(){
	$resultLinks = mysql_query("SELECT * FROM links ORDER BY ord"); 
	while($rowLinks = mysql_fetch_array($resultLinks)){ 
		echo '<li class="first"><a href="'.$rowLinks['url'].'">'.$rowLinks['Name'].'</a></li>';
    } 
}
function footer(){
	$sqlsite = mysql_query("SELECT * FROM site");
	$rowsite = mysql_fetch_array($sqlsite);
	echo date('Y') ." ". $rowsite['Footer'] ."<br>";
	include "resource/footer.php";
}
function forgotpass(){
	include "resource/send_pass.php";
}
function registration(){
	include "resource/reg.php";
}
function users(){
	include "resource/all_users.php";
}
function userpage(){
	include "resource/page.php";
}
function plugin_header($urllink){
	$sqlplhead = mysql_query("SELECT * FROM plugins WHERE type=1 AND activ=1");
	while($rowplhead = mysql_fetch_array($sqlplhead)){
		$dir = $rowplhead['dir'];
		include "plugins/$dir/info.php";
	}
}
function plugin_sidebar($urllink){
	$sqlplsb = mysql_query("SELECT * FROM plugins WHERE type=2 AND activ=1");
	while($rowplsb = mysql_fetch_array($sqlplsb)){
		$dir = $rowplsb['dir'];
		include "plugins/$dir/info.php";
	}	
}
function plugin_footer($urllink){
	$sqlplft = mysql_query("SELECT * FROM plugins WHERE type=3 AND activ=1");
	while($rowplft = mysql_fetch_array($sqlplft)){
		$dir = $rowplft['dir'];
		include "plugins/$dir/info.php";
	}		
}
function plugin_bodyu($urllink){
	$sqlbodyu = mysql_query("SELECT * FROM plugins WHERE type=4 AND activ=1");
	while($rowbodyu = mysql_fetch_array($sqlbodyu)){
		$dir = $rowbodyu['dir'];
		include "plugins/$dir/info.php";
	}
}
function plugin_bodyd($urllink){
	$sqlbodyd = mysql_query("SELECT * FROM plugins WHERE type=5 AND activ=1");
	while($rowbodyd = mysql_fetch_array($sqlbodyd)){
		$dir = $rowbodyd['dir'];
		include "plugins/$dir/info.php";
	}	
}
function plugin_kernel($urllink){
	$sqlkernel = mysql_query("SELECT * FROM plugins WHERE system=1 AND activ=1");
	while($rowkernel = mysql_fetch_array($sqlkernel)){
		$dir = $rowkernel['dir'];
		include "plugins/$dir/info.php";
	}		
}
plugin_kernel($urllink);
/* ~Функции~ */