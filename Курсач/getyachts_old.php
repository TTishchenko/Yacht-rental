<?include("config.php")?>

<?
$query = "SELECT * FROM Yachts WHERE port_id IN (SELECT id FROM Ports WHERE city_id = ".intval($_REQUEST["city_id"]).")";
$result = $db_link->query($query)
   or die ("Ошибка во время получения из БД списка марин.");

while ($row = $result->fetch_object())	{
?>
	<div>
			<img src="img/y1.png" alt="">
			<p>Brand: Hanse<br>
			Name: <?=stripslashes($row->name)?><br>
			Port: Marina Kastela<br>
			Cabins: 5<br>
			Person: 10<br>
			Lenght: <?=stripslashes($row->length)?><br>
			Shower: 3<br>
			Production year: 2017
			</p>
			<a href="">Заказать</a>
		</div>
<?

		//echo "<option value='".$row->id."'>".stripslashes($row->name)."</option>";
}
$result->close();

?>

<!--  -->

