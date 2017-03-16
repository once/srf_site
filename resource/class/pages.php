<?
if (substr($_SERVER['REQUEST_URI'], 0, 18) == '/'){
	include "themes/$dir/$template_index";
	echo "<title>".$rowsite['Name']."</title>";
}
if (substr($_SERVER['REQUEST_URI'], 0, 10) == '/index.php'){
	include "themes/$dir/$template_index";
	echo "<title>".$rowsite['Name']."</title>";
}
if (substr($_SERVER['REQUEST_URI'], 0, 8) == '/404.php'){
	include "themes/$dir/$template_404";
	echo "<title>".$rowsite['Name']." - Страница не найдена</title>";
}
if (substr($_SERVER['REQUEST_URI'], 1, 8) == "$template_post"){
	include "themes/$dir/$template_post";
	echo "<title>".$rowsite['Name']." - ".$rowBlog['name']."</title>";
}
if (substr($_SERVER['REQUEST_URI'], 0, 9) == '/page.php'){
	include "themes/$dir/$template_page";
	echo "<title>".$rowsite['Name']." - ".$rowBlog['Name']."</title>";
}
if (substr($_SERVER['REQUEST_URI'], 0, 15) == '/categories.php'){
	include "themes/$dir/$template_categaries";
	$cat_id = $_GET['id'];
	$sqlcat = mysql_query("SELECT * FROM categories WHERE id=$cat_id");
	$rowcat = mysql_fetch_array($sqlcat);
	echo "<title>".$rowsite['Name']." - $rowcat[name]</title>";
}
if (substr($_SERVER['REQUEST_URI'], 0, 15) == '/forgotpass.php'){
	include "themes/$dir/$template_forgotpass";
	echo "<title>".$rowsite['Name']." - Восстановление пароля</title>";
}
if (substr($_SERVER['REQUEST_URI'], 0, 17) == '/registration.php'){
	include "themes/$dir/$template_registration";
	echo "<title>".$rowsite['Name']." - Регистрация</title>";
}
if (substr($_SERVER['REQUEST_URI'], 0, 13) == '/userpage.php'){
	include "themes/$dir/$template_userpage";
	echo "<title>".$rowsite['Name']."</title>";
}
if (substr($_SERVER['REQUEST_URI'], 0, 10) == '/users.php'){
	require "themes/$dir/$template_users";
	echo "<title>".$rowsite['Name']." - Пользователи сайта</title>";
}
/*
if (substr($_SERVER['REQUEST_URI'], 0, 11) == '/search.php'){
	require "themes/$dir/$template_search";
	echo "<title>".$rowsite['Name']." - Поиск</title>";
	}
*/

?>