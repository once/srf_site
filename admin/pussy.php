<?

$password = md5("Qwe198910");
$password = strrev($password);// для надежности добавим реверс
$password = $password."b3p6f";

echo $password;