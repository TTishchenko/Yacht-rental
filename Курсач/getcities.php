<?include("config.php")?>

<?

echo "<option value=''>Выбрать город</option>";

$query = "SELECT * FROM City WHERE country_id = ". $_REQUEST["country_id"];



$result = $db_link->query($query)
   or die ("Ошибка во время получения из БД списка марин.");

while ($row = $result->fetch_object())	{
		echo "<option value='".$row->id."'>".stripslashes($row->city)."</option>";
}
$result->close();

?>
	