	<?php
	
	$to = "it@sale-russia.com , oleg.kirianov@gmail.com";
									$headers = "Content-type: text/html; charset=utf-8". "\r\n";
									$headers .= "From: system@vh244.sweb.ru";
									$message = "<html><head></head><body><p><b>Жалоба</b><br/>Город: $city_name <br/>Акция: $offer_name (<a target=\"_blank\" href=\"" . $offer_link_view. "\">Открыть карточку</a>)<br/>Жалоба: $complain_text<br/>Отправлено: $complain_date<br/><br/><b>Пользователь</b><br/>Push_ID: $user_push_id<br/>Push_Token: $user_push_token<br/>IP: $ip<br/>User-Agent: $browser</p><p>Данное письмо сформировано автоматически и отвечать на него не нужно.</p></body></html>";
									
									$subject = "Скидки.РФ2, Жалоба на акцию в г. " . $city_name;
									
									
									$send = mail ($to, $subject, $message, $headers);
									
								
		?>								