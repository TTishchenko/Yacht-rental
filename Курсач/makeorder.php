<?include("config.php")?>


<?
$query = "INSERT INTO Person (name, surname, email) VALUES ('" . $db_link->real_escape_string($_REQUEST['info_name'])."', '" . $db_link->real_escape_string($_REQUEST['info_surname'])."', '" . $db_link->real_escape_string($_REQUEST['info_email'])."')";

if (DEBUG_SQL)
	echo "<pre>" . $query . "</pre>"; 

$db_link->query($query)
   or die ("Ошибка добавления клиента");

$client_id = $db_link->insert_id;

$query = "INSERT INTO Orders (yacht_id, person_id, date_begin, date_end, price) VALUES (".intval($_REQUEST["yacht_id"]).", ".intval($client_id).", '".$db_link->real_escape_string($_REQUEST['db'])."', DATE_ADD('".$_REQUEST['db']."', INTERVAL ".$_REQUEST['de']." WEEK), ".intval($_REQUEST['price']).")";

if (DEBUG_SQL)
	echo "<pre>" . $query . "</pre>"; 

$db_link->query($query)
   or die ("Ошибка добавления клиента");

//$row = $result->fetch_object())	
?>
	<div>
			Спасибо! Ваш заказ номер: <?=$db_link->insert_id?>	
	</div>

<!-- SELECT Yachts.name as name, Yachts.length as length, Yachts.price as price, Yachts.id as id, Ports.name as port_name, City.city as city_name, Company.company as company_name, Yachts.year as year, Yachts.crew as crew
	FROM Yachts, Ports, City, Company 
    WHERE Yachts.id = 1
	AND Yachts.port_id=Ports.id
	AND Ports.city_id=City.id
	AND Yachts.company_id=Company.id
103688-->







