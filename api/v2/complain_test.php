<?php header('Access-Control-Allow-Origin: *'); ?>
<?

include "../../config.php"; //Файл конфигурации БД

$ip = $_SERVER["REMOTE_ADDR"];
$browser = $_SERVER['HTTP_USER_AGENT'];
$user_push_id = $_POST['user_id'];
$user_push_token = $_POST['user_token'];
$city = $_POST['city'];
$offer_type = $_POST['offer_type'];
$offer_id = $_POST['offer_id'];
$complain_id = $_POST['complain_id'];
$complain_text = $_POST['complain_text'];

$complain_date= date('d.m.Y H:m');   // берем текущую дату и время регистрации

switch ($offer_type) {
	
	case 'offers':
	$table_name = 'blog';
	$adv_table = 'advertisers';
	$offer_link = '/admin/post.php';
	break;
	
	case 'foods' :
	$table_name = 'food_offers';
	$adv_table = 'foods_distributors';
	$offer_link = '/admin/food_offer.php';
	break;
	
	case 'alcohol':
	$table_name = 'food_offers';
	$adv_table = 'foods_distributors';
	$offer_link = '/admin/alco_offer.php';
	break;
	
	case 'events':
	$table_name = 'blog';
	$adv_table = 'advertisers';
	$offer_link = '/admin/event_offer.php';
	break;
	
	case 'news':
	$table_name = 'blog';
	$adv_table = 'advertisers';
	$offer_link = '/admin/news_offer.php';
	break;
	
	case 'money':
	$table_name = 'blog';
	$adv_table = 'advertisers';
	$offer_link = '/admin/money_offer.php';
	break;
	
	case 'cinema':
	$table_name = 'blog';
	$adv_table = 'advertisers';
	$offer_link = '/admin/cinema_offer.php';
	break;
	
	default:
	
	echo 'Unknown offer_type';
	die();
	
	break;
	
	

}
				
			// offer name, priority category, advertiser's email
			$result = mysql_query("SELECT t1.name,t1.pr_cat, t2.email FROM ". $table_name ." t1 LEFT JOIN ".$adv_table. " t2 ON t2.id = t1.advertiser_id WHERE t1.id = '".$offer_id."';", $db); 
			$row = mysql_fetch_array($result); 
			$offer_name = $row['name'];
			$offer_pr_cat = $row['pr_cat'];
			$offer_advertiser_email = trim($row['email']);
 
			// city name 
			 $result = mysql_query("SELECT name,name2 FROM cities WHERE id = '".$city."';", $db); 
			 $row = mysql_fetch_array($result); 
			 $city_name = $row['name'];
			 $city_name2 = $row['name2'];  // В родительном падеже
 
			// offer link
			$offer_link_view = "https://" . $_SERVER["SERVER_NAME"] . $offer_link . '?id='.$offer_id;
 
 

$query = mysql_query("INSERT INTO complains (user_ip_addr, user_agent, user_push_id, user_push_token, city,offer_type, offer_id, complain_id, complain_text) values ('$ip', '$browser', '$user_push_id','$user_push_token','$city','$offer_type','$offer_id','$complain_id','$complain_text');");

mysql_close($db);

	
/*
- Продукты + алкоголь+ события+ товары и услуги (Стандарт) - Оператор + Саппорт
- товары и услуги (Приоритет + ТОР) - Антон + суппорт
- Товары и услуги (Все) - рекламодателю (если есть е-меил)

1-Стандарт
2-Приоритет
3-Топ
*/
if ($offer_type == 'offers') {
			
				if (($offer_pr_cat == '3') || ($offer_pr_cat == '2')) {
					// Антон sales@sale-russia.com + Саппорт
					$to = "it@sale-russia.com";
				}
				else {
					// Оператор + Саппорт
					$to = "it@sale-russia.com";
				}
			
			if ($offer_advertiser_email) {	
			
									$headers = "Content-type: text/html; charset=utf-8". "\r\n";
									$headers .= "From: it@sale-russia.com";
									$message = "<html><head></head><body><p>Уважаемый рекламодатель, пользователи мобильного приложения <b>Скидки $city_name2</b> выявили несоответствие в вашем объявлении.<br/><br/>Акция: $offer_name<br/>Жалоба: $complain_text<br/>Отправлено: $complain_date<br/><br/>Просим <b>связаться с персональным менеджером</b> для корректировки данных.</p><p>Данное письмо сформировано автоматически и отвечать на него не нужно.</p><p>С уважением,<br/>Команда <b>СКИДКИ.РФ</b><br/>+7 (902) 700-60-60<br/><a href=\"mailto:sales@sale-russia.com\">sales@sale-russia.com</a></body></html>";

									$subject = "Скидки ".$city_name2.", Жалоба на акцию в мобильном приложении.";
									
									$send = mail ("it@sale-russia.com", $subject, $message, $headers);
									
									if ($send != 'true') {
											ReportEmailSendingProblem($offer_advertiser_email);
									}
			
			}
			
}
elseif ($offer_type == 'foods') {
	// Саппорт + Мария
	$to = "it@sale-russia.com";
	
}
else {
	// Оператор + Саппорт
	$to = "it@sale-russia.com";
}


									
									$headers = "Content-type: text/html; charset=utf-8". "\r\n";
									$headers .= "From: it@sale-russia.com";
									$message = "<html><head></head><body><p><b>Жалоба</b><br/>Город: $city_name <br/>Акция: $offer_name (<a target=\"_blank\" href=\"" . $offer_link_view. "\">Открыть карточку</a>)<br/>Жалоба: $complain_text<br/>Отправлено: $complain_date<br/><br/><b>Пользователь</b><br/>Push_ID: $user_push_id<br/>Push_Token: $user_push_token<br/>IP: $ip<br/>User-Agent: $browser</p><p>Данное письмо сформировано автоматически и отвечать на него не нужно.</p></body></html>";
									
									$subject = "Скидки.РФ, Жалоба на акцию в г. " . $city_name;
									
									
									$send = mail ($to, $subject, $message, $headers);
									
									if ($send != 'true') {
											ReportEmailSendingProblem($to);
									}
										
											
	function ReportEmailSendingProblem($to) {
		
												$to2 = "it@sale-russia.com";
												$headers2 = "Content-type: text/plain; charset=utf-8";
												$subject2 = "Возникла проблема отправки email с жалобой.";
												$message2 = "Возникла проблема отправки email с жалобой на адреса: " . $to;
												$send2 = mail ($to2, $subject2, $message2, $headers2);
		
	}									

?>
