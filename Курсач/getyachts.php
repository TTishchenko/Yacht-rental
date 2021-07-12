<?include("config.php")?>

<?
$query = "
	SELECT Yachts.name as name, Yachts.length as length, Yachts.price as price, Yachts.id as id, Ports.name as port_name, City.city as city_name, Company.company as company_name, Yachts.year as year, Yachts.crew as crew
	FROM Yachts, Ports, City, Company WHERE 
	Yachts.port_id IN 
	(SELECT id FROM Ports WHERE city_id = ".intval($_REQUEST['city_id']).")
	AND 
	Yachts.id NOT IN
	(SELECT yacht_id FROM Orders WHERE date_begin < DATE_ADD('".$_REQUEST['db']."', INTERVAL ".$_REQUEST['de']." WEEK) AND date_end > '".$_REQUEST['db']."')
	AND Yachts.port_id=Ports.id
	AND Ports.city_id=City.id
	AND Yachts.company_id=Company.id
";

if (DEBUG_SQL)
	echo "<pre>" . $query . "</pre>"; 

$result = $db_link->query($query)
   or die ("Ошибка во время получения из БД списка марин.");

while ($row = $result->fetch_object())	{
?>
	<div class="a">
			<img src="/img/<?=$row->id?>.jpg" alt="">
			<p>Brand: <?=stripslashes($row->company_name)?><br>
			Name: <?=stripslashes($row->name)?><br>
			Port: <?=stripslashes($row->port_name)?><br>
			City: <?=stripslashes($row->city_name)?><br>
			Crew: <?=$row->crew?><br>
			Lenght: <?=$row->length?><br>
			Production year: <?=$row->year?><br>
			Price: <?=$row->price?>$<br>
			<a href="javascript:void(0);" onclick="make_order(<?=$row->id?>, <?=$row->price?>);">Заказать</a>
			</p>
			
		</div>
<?

		//echo "<option value='".$row->id."'>".stripslashes($row->name)."</option>";
}
$result->close();

?>

<!-- a.start < b.end AND a.end > b.start 

SELECT * FROM yachts, ports WHERE yachts.port IN (SELECT id FROM ports WHERE City_id =1) and yachts.id not in (select yacht FROM orders where date_begin < '2019-09-27' AND date_end > '2019-09-13') and yachts.port=ports.id
-->