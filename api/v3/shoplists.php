<?php header('Access-Control-Allow-Origin: *'); 

$action = $_GET['action'];

if (!$action) die ("No action specified");

switch ($action) {

	case 'test':

		echo "user_id: " . $_POST['user_id'];
		
		$list_data  = json_decode(json_encode($_POST['list']), false);   // double encode as we need object from array!
		print_r($list_data);
		echo "list id: " . $list_data->id;

		break;
	case 'put':
		
		$user_id = $_POST['user_id'];
		$list_data  = json_decode(json_encode($_POST['list']), false);   // double encode as we need object from array!

		putShoppingList($user_id, $list_data);
		break;

	case 'get':
		$list_id = $_GET['listid'];
		if (!$list_id) die ("No list ID specified");
		getShoppingList ($list_id);
		break;

	default:
		die ("Unknown action specified");		
		break;
}


				


	function putShoppingList ($user_id, $list_data) {

		include "../../config.php"; //Файл конфигурации БД

		/* есть ли уже список с таким ИД от этого пользователя?
		если да - апдейтим его - удаляем все item-ы, записываем новые
		если нет - создаем новый список*/


		$sql = mysql_query("SELECT * FROM shoppinglists WHERE owner_id ='".$user_id. "' AND owner_list_id = " . $list_data->id. ";", $db);
		$row = mysql_fetch_array($sql);

		if (!empty($row['id'])) {

			// такой список уже был опубликован этим пользователем
			
			$existing_list_id = $row['id'];
	   	    
	  		mysql_query("DELETE FROM shoppinglist_items WHERE list_id = " . $existing_list_id, $db);   

	  		mysql_query("UPDATE shoppinglists SET name = '" . $list_data->name . "' WHERE id = " . $existing_list_id, $db);   


		}
		else {

			$query_sql = "INSERT INTO shoppinglists (owner_id, owner_list_id, name) VALUES ('$user_id', '$list_data->id', '$list_data->name');";
			
			$query = mysql_query($query_sql, $db);
  			
  			$existing_list_id = mysql_insert_id($db);
  		}


  			for ($i=0; $i < count($list_data->items); $i++) {
								
				$item_list_id  = $existing_list_id;

				$item_id_in_list  = $list_data->items[$i]->id;
				$item_type  = ($list_data->items[$i]->type == "offer") ? 2 : 1;
				$item_offer_id  = $list_data->items[$i]->offer_id;
				$item_name  = $list_data->items[$i]->name;
				$item_crossed_out = $list_data->items[$i]->crossedOut ;
				$item_quantity = $list_data->items[$i]->quantity;
				$item_price_new= $list_data->items[$i]->price_new;

				$sql = "INSERT INTO shoppinglist_items (list_id, id_in_list, type, offer_id, name, crossed_out, quantity, price_new) VALUES ('$item_list_id', '$item_id_in_list', '$item_type', '$item_offer_id', '$item_name', '$item_crossed_out', '$item_quantity', '$item_price_new');";
				$query = mysql_query($sql, $db);
				
  			}

			mysql_close($db);

			echo '{"list_id":'.$existing_list_id.'}';

	}


	function getShoppingList ($list_id) {

		include "../../config.php"; //Файл конфигурации БД
		
		$server_name = "http://".$_SERVER['SERVER_NAME'];
	
		// Get List data
		$list_data = array();
		
		$query = mysql_query("SELECT * FROM shoppinglists WHERE id =".$list_id. " LIMIT 1;", $db);
		
		if (mysql_num_rows($query) != 1) die("Cannot read list ID ". $list_id . " from DB");

		$row = mysql_fetch_array($query);

		for ($i=0; $i < mysql_num_fields($query); $i++) {
				
			$list_data[mysql_field_name($query, $i)] = $row[$i];
		}



		// Get Items data
		$items_array = array();		

		$query = mysql_query("SELECT * FROM shoppinglist_items WHERE list_id =".$list_id. ";", $db);

		while($row = mysql_fetch_array($query))
		{
			$item_data = array();

			$item_data["id"] = $row["id_in_list"];
			$item_data["crossedOut"] = ($row["crossed_out"] == 0) ? false : true;
			$item_data["quantity"] = (int)$row["quantity"];

			if ($row["type"] == 1) { // simple item

				$item_data["type"] = "simple";
				$item_data["name"] = $row["name"];
				$item_data["price_new"] = (double)$row["price_new"];

			}
			elseif ($row["type"] == 2) { // offer item

				$item_data["type"] = "offer";
				$item_data["offer_id"] = $row["offer_id"];				

				$offer_query = mysql_query("SELECT f.name, CONCAT ('".$server_name."',f.img) AS img, f.system_date_to, f.price_old, f.price_new, f.advertiser_id, fd.name AS advertiser FROM food_offers f LEFT JOIN foods_distributors fd ON fd.id = f.advertiser_id WHERE f.id = '".$row["offer_id"]."' LIMIT 1;", $db);

				$offer_row = mysql_fetch_array($offer_query);

				for ($j=0; $j < mysql_num_fields($offer_query); $j++) {
				
					$item_data[mysql_field_name($offer_query, $j)] = $offer_row[$j];
				}

				$item_data["price_old"] = (double)$offer_row["price_old"];
				$item_data["price_new"] = (double)$offer_row["price_new"];
				
			}

			array_push($items_array, $item_data);
		}
			
		$list_data['items'] = $items_array;
		
		mysql_close($db);

		echo '{
			"list":';
			echo json_encode($list_data);
		echo '}';
		
	}




?>

