
function validateDates(){
	
	var min_date_from = "2016-01-01";
	var max_date_from = "2030-01-01";
	var min_date_to = "2016-01-01";
	var max_date_to = "2030-01-01";
			
	var date_from = new Date($('input[name="system_date_from"]').val());
	var date_to = new Date($('input[name="system_date_to"]').val());
		
	if (!validateDateField(date_from, new Date(min_date_from), new Date(max_date_from))) {
		alert("Поле Акция С должно быть в диапазоне с " + min_date_from + " по " + max_date_from);
		return false;
	}
		
	if (!validateDateField(date_to, new Date(min_date_to), new Date(max_date_to))) {
		alert("Поле Акция ПО должно быть в диапазоне с " + min_date_to + " по " + max_date_to);
		return false;
	}
	
	return true;
	
	function validateDateField(field, min, max) {
			
		if (field instanceof Date && isFinite(field)) {
			
			if ((field < min) || (date_from > max)) {
								
				return false;
			}
			else {
				
				return true;
			}
			
			
		}
		else {
			
			// если поле не является датой, значит оно вообще не задано и мы его не проверяем
			return true;
		}
	}
	
	
}

function validateField (field_type, field_name, field_title) {
	
	
	var field_val = $(field_type+'[name="'+ field_name +'"]').val();
	
	if (field_val && field_val !=0) {
		
		return true;
	}
	else {
		
		alert ("Не заполнено поле " + field_title + " !");
		return false;	
	}
}
