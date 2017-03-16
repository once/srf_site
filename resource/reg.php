<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h2>Регистрация</h2>
<form action="resource/save_user.php" method="post" enctype="multipart/form-data">
  <p>
    <label>Ваш логин *:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
  </p>

  <p>
    <label>Ваш пароль *:<br></label>
    <input name="password" type="password" size="15" maxlength="15">
  </p>
  
  <p>
    <label>Ваш E-mail *:<br></label>
    <input name="email" type="text" size="15" maxlength="100">
  </p>
  <p>
    <label>Выберите аватар. Изображение должно быть формата jpg, gif или png:<br></label>
    <input type="FILE" name="fupload">
  </p>

<p>Введите код с картинки *:<br>

<p><img src="resource/code/my_codegen.php"></p>
<p><input type="text" name="code"></p>
<p>
<input type="submit" name="submit" value="Зарегистрироваться">
</p></form>
Звездочками (*) обозначены поля, обязательные для заполнения.

</body>
</html>
