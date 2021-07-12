<?include("config.php")?>

<?
$query = "SELECT Orders.id as id, Orders.date_begin as date_begin, Orders.date_end as date_end, Orders.price as price, Person.name as name, Person.surname as surname, Person.email as email, Yachts.name as yacht_name, Yachts.id as yacht_id, Ports.name as port_name, Company.company as company_name 
FROM Orders, Person, Yachts, Ports, Company
WHERE Orders.id = ".intval($_REQUEST['order_id'])." AND
Orders.person_id = Person.id AND
Orders.yacht_id = Yachts.id AND
Yachts.company_id = Company.id AND
Yachts.port_id = Ports.id";

if (DEBUG_SQL)
	echo "<pre>" . $query . "</pre>"; 

$result = $db_link->query($query)
   or die ("Ошибка во время получения из БД данных заказа");

$row = $result->fetch_object();
?>
	<div>
			<p>Order_ID: <?=$row->id?><br>
			From: <?=$row->date_begin?><br>
			Till: <?=$row->date_end?><br>
			Name: <?=stripslashes($row->name)?><br>
			Surname: <?=stripslashes($row->surname)?><br>
			Email: <?=stripslashes($row->email)?><br></p>
			<img src="/img/<?=$row->yacht_id?>.jpg" alt="">
			<p>Brand: <?=stripslashes($row->company_name)?><br>
			Name: <?=stripslashes($row->yacht_name)?><br>
			Port: <?=stripslashes($row->port_name)?><br>
			Price: <?=$row->price?>$
			</p>
			
		</div>
<?

		//echo "<option value='".$row->id."'>".stripslashes($row->name)."</option>";
$result->close();

?>
