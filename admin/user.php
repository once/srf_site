<?
session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Скидки.РФ</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
	</head>
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
										<h2><a>Все пользователи</a></h2>
									</header>
												<? 
function show_form(){ 
       
        require '../config.php'; 

        $result = mysql_query("SELECT * FROM users WHERE id = '".$_GET['id']."';", $db); 
        $row = mysql_fetch_array($result); 
?> 
<body role="application">
<form action="" method="post"> 

<table cellspacing="10">
<tr><td><a style="font-size:20px;text-decoration:none;" >Логин: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="login" value="<?=htmlspecialchars(stripslashes($row['login']));?>"  class="enter" size="50" required> </td></tr><tr></tr>
<tr><td><a style="font-size:20px;text-decoration:none;" >E-Mail: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="email" value="<?=htmlspecialchars(stripslashes($row['email']));?>"  class="enter" size="50"></td></tr><tr></tr>
<tr><td><a style="font-size:20px;text-decoration:none;" >Пароль: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="password" value=""  class="enter" size="50"></td></tr><tr></tr>
<tr><td><a style="font-size:20px;text-decoration:none;" >Привелегии:</a></td><td>
<select name="permission">
<option selected value="">Обычный пользователь</option>
<option value="admin">Администратор</option>
</select></td></tr>
<tr><td><a style="font-size:20px;text-decoration:none;" >Выслать письмо на E-Mail:</a></td><td>
<input  type="checkbox" name="mail" style="!important" value="1"></td></tr>
</table>
<br>
      <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
      <input class="submit" type="submit" value="Отправить" name="edit"> 
  
</form> </body>
<? 
} 
function complete(){ 
      require '../config.php'; 
$login= $_POST['login'];

$password = md5($_POST['password']);//шифруем пароль
		$password = strrev($password);// для надежности добавим реверс
		$password = $password."b3p6f";
		
      $result = mysql_query("SELECT * FROM users WHERE id = '".$_POST['id']."';", $db); 
      $row = mysql_fetch_array($result); 
      if(empty($row['id'])) {
      // проверка на существование пользователя с таким же логином
$result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
$myrow = mysql_fetch_array($result);
if (!empty($myrow['id'])) {

exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин."); //останавливаем выполнение сценариев

}
            $query = "INSERT INTO users 
                     (login, 
                      email,
                      password,
                      permission,
                      avatar,
                      activation,
                      date
                      ) 
                                      VALUES 
                            (
                           	 	'".mysql_real_escape_string($_POST['login'])."',
						   	 	'".mysql_real_escape_string($_POST['email'])."',
						   	 	'$password',
						   	 	'".mysql_real_escape_string($_POST['permission'])."',
						   	 	'../images/lwt.png',
						   	 	'1',
						   	 	NOW()
                              )"; }
      else 
      if(!empty($_POST['password'])){
            $query = "UPDATE users SET 
                                     login = '".mysql_real_escape_string($_POST['login'])."',
                                     email = '".mysql_real_escape_string($_POST['email'])."',
                                     password = '$password',
                                     permission = '".mysql_real_escape_string($_POST['permission'])."'                     WHERE id = '".$_POST['id']."';"; }
       else {
	               $query = "UPDATE users SET 
                                     login = '".mysql_real_escape_string($_POST['login'])."',
                                     email = '".mysql_real_escape_string($_POST['email'])."',
                                    
                                     permission = '".mysql_real_escape_string($_POST['permission'])."'                     WHERE id = '".$_POST['id']."';"; 
       }

      mysql_query($query, $db); 
      if ($_POST['mail']==1){
	      $headers = "Content-type:text/plane; Charset=utf-8\r\n"; 
$subject = "Регистрация на ".$_SERVER['SERVER_NAME']."";//тема сообщения
$message = "Здравствуйте! Вас успешно зарегистрировали на ".$_SERVER['SERVER_NAME']."\nВаш логин: ".$login."\nВаш пароль: ".$_POST['password']."\n
С уважением,\n
Администрация ".$_SERVER['SERVER_NAME']."";//содержание сообщение
mail($email, $subject, $message);//отправляем сообщение
      }
      echo "<meta http-equiv='Refresh' content='0; URL=user.php'>"; 
} 
function show_pages() { 
?> 
<script language='JavaScript1.1' type='text/javascript'> 
<!-- 
function Delete(N) 
{ 
     if(confirm("Удалить пользователя?")) 
     { 
                 parent.location='?del='+N; 
     } 
     else 
     { 
       return false; 
     } 
} 
--> 
</SCRIPT> 
<? 
        require '../config.php'; 
        echo ' 
 <a href="?id=new"><h3><input style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" type="submit" value="Новый пользователь" ></h3></a><br>'; 
        echo ' 
<table cellspacing="10" cellpadding="3" > 
<tr> 
  <td> 
   Логин
  </td> 
  <td>
  E-Mail
  </td>
  <td>
  Тип
  </td>
  <td>
  Активирован
  </td>
    <td>
  Дата регистрации
  </td>
    <td>
  Удалить
  </td>
</tr>'; 
        $result = mysql_query("SELECT * FROM users ORDER BY login ASC;", $db); 
        while($row = mysql_fetch_array($result)){ 
        if($row['permission']=="admin"){$type="Администратор";}
        if(empty($row['permission'])){$type="Пользователь";}
        if($row['activation']=="1"){$activ="Да";}
        if($row['activation']=="0"){$activ="Нет";}
               echo ' 
<tr> 
  <td> 
     <a href="?id='.$row['id'].'">'.stripslashes($row['login']).'</a> 

  <td>
  <a href=mailto:'.stripslashes($row['email']).'>'.stripslashes($row['email']).'</a>
  </td>
  <td>
  '.$type.'
  </td>
    <td>
  '.$row['date'].'
  </td>
      <td>
  '.$activ.'
  </td>
  <td> 
     <a href="#" OnClick="Delete('.$row['id'].')">Удалить</a> 
  </td> 
</tr>'; 
        } 
        echo ' 
</table>'; 

} 
function delete_pages(){ 
        require '../config.php'; 
        $query = "DELETE FROM users WHERE id = '".$_GET['del']."';"; 
        mysql_query($query, $db); 
        echo '<h3>Пользователь удален</h3>'; 
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
						<center><a href="index.php"><img width="150" src="../images/lwt.png"></a></center>
						<!-- Nav -->
							<nav id="nav">
								<ul>
								<li><a href="post.php">Товары и услуги</a></li>
									<li><a href="food_offer.php">Продукты</a></li>
									<!--<li><a href="alco_offer.php">Алкоголь</a></li>-->
									<li><a href="news_offer.php">Новости</a></li>
									<li><a href="event_offer.php">События</a></li>
									<li><a href="cinema_offer.php">Кино</a></li>
									<li><a href="money_offer.php">Деньги</a></li>
									
									
									
									<!--<li><a href="categories.php">Разделы</a></li>-->
									<!--<li><a href="page.php">Страницы</a></li>
									<li><a href="sidebar.php">Сайдбар</a></li>
									<li><a href="theme.php">Темы</a></li>
									<li><a href="link.php">Ссылки</a></li>
									<li><a href="comment.php">Комментарии</a></li>-->
									<li><a href="advertisers.php">Рекламодатели</a></li>
									
									<li><a href="foods_distributors.php">Торговые сети</a></li>
										<li><a href="offercategories.php">Категории</a></li>
									<li><a href="cities.php">Города</a></li>
									<li class="current_page_item"><a href="user.php">Пользователи</a></li>
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
</html>