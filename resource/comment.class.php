<?
session_start();

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

class Comment
{
	private $data = array();
	
	public function __construct($row)
	{
		
		$this->data = $row;
	}
	
	public function markup()
	{
		$d = &$this->data;
		
		$link_open = '';
		$link_close = '';
		$d['dt'] = strtotime($d['dt']);

		include "config.php";
		$login = $_SESSION['login'];
		$password = $_SESSION['password'];
		$result = mysql_query("SELECT id,avatar FROM users WHERE login='$d[name]'",$db); 
		$myrow = mysql_fetch_array($result);
		$avatar = $myrow['avatar'];
		if (empty($avatar) or $avatar == ''){
			$avatar = 'avatars/net-avatara.jpg';
		}
		return '
		<div class="row row-special">
			<div class="comment">
				<div class="avatar">
					'.$link_open.'
					<img width=50 src="resource/'.$avatar.'" />
					'.$link_close.'
				</div>
				
				<div class="name">'.$link_open.$d['name'].$link_close.'</div>
				<div class="date" title="Added at '.date('H:i \o\n d M Y',$d['dt']).'">'.date('d M Y',$d['dt']).'</div>
				<p>'.$d['body'].'</p>
			</div></div>
		';
	}
	
	public static function validate(&$arr)
	{

		
		$errors = array();
		$data	= array();
		

		
		if(!($data['email'] = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL)))
		{
			$errors['email'] = 'Please enter a valid Email.';
		}
		
		if(!($data['url'] = filter_input(INPUT_POST,'url')))
		{
						
			$url = '';
		}

		
		if(!($data['body'] = filter_input(INPUT_POST,'body',FILTER_CALLBACK,array('options'=>'Comment::validate_text'))))
		{
			$errors['body'] = 'Please enter a comment body.';
		}
		
		if(!($data['name'] = filter_input(INPUT_POST,'name',FILTER_CALLBACK,array('options'=>'Comment::validate_text'))))
		{
			$errors['name'] = 'Please enter a name.';
		}
		
		if(!empty($errors)){
			
			
			
			$arr = $errors;
			return false;
		}
		
		
		
		foreach($data as $k=>$v){
			$arr[$k] = mysql_real_escape_string($v);
		}
		
	
		
		$arr['email'] = strtolower(trim($arr['email']));
		
		return true;
		
	}

	private static function validate_text($str)
	{
		
		
		if(mb_strlen($str,'utf8')<1)
			return false;
		
		
		
		$str = nl2br(htmlspecialchars($str));
		

		$str = str_replace(array(chr(10),chr(13)),'',$str);
		
		return $str;
	}

}

?>