<?php
session_start();
if (empty($_SESSION['loginadmin']) or empty($_SESSION['passwordadmin'])) 
{
exit ("Доступ на эту страницу разрешен только зарегистрированным пользователям. Если вы зарегистрированы, то войдите на сайт под своим логином и паролем<br><a href='../index.php'>Главная страница</a>");
}

unset($_SESSION['passwordadmin']);
unset($_SESSION['loginadmin']); 
unset($_SESSION['idadmin']);

setcookie("autoadmin", "", time()+9999999);
exit("<html><head><meta http-equiv='Refresh' content='0; URL=index.php'></head></html>");

?><meta http-equiv="content-type" content="text/html; charset=utf-8" />