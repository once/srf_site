<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Loutskiy CMS 6 Lucid Lynx</title>
<?
$lang = $_GET['lang'];
$sites = array(
    "en" => "lang/en.php",
    "ru" => "lang/ru.php",
	"de" => "lang/de.php",
);

$lang = $language;
// проверяем язык
if (!in_array($lang, array_keys($sites))){
    $lang = 'ru';
}
// перенаправление на субдомен
include($sites[$lang]);
if ($lang == "en") $language = "en.php";
if ($lang == "ru") $language = "ru.php";
if ($lang == "de") $language = "de.php";
?>
<?php 
function crdb()
{
include("../../config.php");
	 mysql_query("INSERT INTO `site` (`id`, `Name`, `Description`, `Footer`, `Keywords`, `About`, `Close`, `CloseMess`, `users`, `Language`, `Favicon`, `ThemeActiv`, `RSS`, `PageCount`, `iOS`, `Logo`, `Search`, `Soc`, `EmailText1`, `EmailText2`, `EmailText3`) VALUES
(1, 'My Site', 'My personal blog', 'Copyright &copy; My Site.', 'site, blog, website', '<p>Welcome on my site!</p>\r\n', 0, '<p>Закрыт</p>\r\n', 1, 'ru', '', 'default', 0, 10, '', '', 0, 0, '', '', '')");
mysql_query("INSERT INTO `blog` (`id`, `cat_id`, `body`, `name`, `metakeywords`, `metadescription`, `date`, `img`, `comments`, `date1`, `draft`) VALUES
(1, 1, '<p>Добро пожаловать в Loutskiy CMS 6 Lucid Lynx. Это ваш первый пост. Вы можете его отредактировать или удалить. Для этого зайдите в вашу Админ-панель, которая распологается по адресу <a href='admin/'>http://ваш_сайт.ru/admin</a>, а затем перейдите в раздел &quot;Записи&quot;.</p>\r\n', 'Hello, World!', 'hello, world', 'Моя первая запись в блоге', '12 августа 2013', '/content/images/pic03.jpg', 1, '2013-08-12 21:46:02', 0);");


mysql_query("INSERT INTO `pages` (`id`, `body`, `Name`, `metakeywords`, `metadescription`, `disp`, `ord`, `comments`) VALUES
(1, '<p><img alt='' src='/content/images/pic03.jpg' style='float:left; height:189px; margin:7px; width:368px' />Это ваша первая статичная страница. Вы можете ее отредактировать или удалить.&nbsp;Для этого зайдите в вашу Админ-панель, которая распологается по адресу <a href='admin/'>http://ваш_сайт.ru/admin</a>, а затем перейдите в раздел &quot;Страницы&quot;.</p>\r\n', 'Страница', 'страница', 'Моя первая страница в блоге', 1, 2, 0);");

   function delete($arg){
											  $d=opendir($arg);
											  while($f=readdir($d)){
											    if($f!="."&&$f!=".."&&$f!="finish.php"){
											      if(is_dir($arg."/".$f))
											        delete($arg."/".$f);
											      else 
											        unlink($arg."/".$f);
											    }
											  }
											  
											}
											delete("../install");
	 	return "<meta http-equiv='refresh' content='0; url=../../index.php'>";
	 	
	}
if($_POST['button'] == LANG_CREATE2)
{
 $err = crdb();
}
?>
<link rel="icon" href="/images/favicon.ico" type="image/x-icon">
<link href="style.css" rel="stylesheet" type="text/css">
<p align="center"><img width="200" src="/images/lwt.png"></p>
<form method="post" action="">
  <div class="centers">
    <!--<p align="left">Поля отмеченные звёздочкой (<span class='red'>*</span>), обязательны к заполнению.</p>--><br>
    <br>
     <table align="center" width="483" border="0" cellpadding="5" cellspacing="5">
      <tr>
        <td colspan="2" align="center"><?=LANG_TEXT?></td>
      </tr>
	  <tr><td><? include"../license.html"?></td></tr>
      <tr>
      
        <td align="center" colspan="2"><label>
          <input type="submit" name="button" id="button" value="<?=LANG_CREATE2?>" class="buts">
        </label></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><span class='red'><?php echo $err; ?></span></td>
      </tr>
    </table>
  </div>
</form>
<p style="color:white;" align="center" >2013 Copyright © <a style="color:white;" href="http://loutskiy.ru">Loutskiy WebTechnologies</a>. All rights reserved!</p>
