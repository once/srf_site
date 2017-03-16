<? 
/*
Loutskiy OPEN CMS v6;
Author and Developer: Loutskiy Mikhail;
License: FREE GNU GPL;
Date: 4 July 2013;
Country: Russia Federation;
Copyright © Loutskiy Web Technology. All right reserved!
*/
?>
<?php
if ($rowBlog['comments'] != 1){
	
	}
else {
if($commentaries == 1){

	if (substr($_SERVER['REQUEST_URI'], 0, 9) == '/post.php'){
		$resultBlog = mysql_query("SELECT * FROM blog WHERE id = '".$_GET['id']."'"); 
		$rowBlog = mysql_fetch_array($resultBlog); 
	}
	if (substr($_SERVER['REQUEST_URI'], 0, 9) == '/page.php'){
 	}
	error_reporting(E_ALL^E_NOTICE);
	
	include "config.php";
	include "resource/comment.class.php";
	
	
	
	$urls= $_SERVER['REQUEST_URI'];
	$comments = array();
	$result = mysql_query("SELECT * FROM comments WHERE url='$urls' ORDER BY id ASC");
	
	while($row = mysql_fetch_assoc($result))
	{
		$comments[] = new Comment($row);
	}
	
	echo '	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
	<div id="main">
	<br>';
	
	foreach($comments as $c){
		echo $c->markup();
	}
	
	?>
	<style>
	textarea {
	  resize: none;
	}
	</style>
	<?php
	
	if (empty($_SESSION['login']) or empty($_SESSION['id']))
	{
	echo "
	<div id='addCommentContainer'>
		<p>Добавить коментарий</p>
		<form id='addCommentForm' method='post' action=''>
	    	<div>
	        	<label for='name'>Ваше имя:</label>
	        	<input type='text' name='name' id='name' value='' />
	            
	            <label for='email'>Ваш e-mail (не виден для пользователей):</label>
	            <input type='text' name='email' id='email' value='' />
	            
	            
	            <input type='hidden' name='url' id='url' value=".$_SERVER['REQUEST_URI']." />
	            
	            <label for='body'>Текст комментария</label>
	            <textarea name='body' maxlength='200' id='body' cols='50' rows='5'></textarea>
	            
	            <input type='submit' id='submit' value='Отправить' />
	        </div>
	    </form>
	</div>
	";
	}
	else
	   {
	   
	    echo "<div id='addCommentContainer'>
		<p>Добавить коментарий</p>
		<form id='addCommentForm' method='post' action=''>
	    	<div>
	        	
	        	<input type='hidden' name='name' id='name' value=".$_SESSION['login']." />
	            
	            
	            <input type='hidden' name='email' id='email' value='comment@".$_SERVER['SERVER_NAME']."' />
	            
	            
	            <input type='hidden' name='url' id='url' value=".$_SERVER['REQUEST_URI']." />
	            
	            <label for='body'>Текст комментария</label>
	
	            <textarea  name='body' maxlength='200' id='body' cols='50' rows='5'></textarea>
	            
	            <input type='submit' id='submit' value='Отправить' />
	        </div>
	    </form>
	</div>
	";
	   }
	   echo '	</div>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="resource/script.js"></script>
	</body>
	</html>';
} }
	?>
	
	
	

