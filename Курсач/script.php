<?include("config.php")?>

<?
//24 года
$r = 0;
for ($y = 24; $y > 0; $y--) {

	$year = 2019 - $y;

	for ($m = 12; $m > 0; $m--) {

		for ($d = 30; $d > 0; $d--) {

			for ($b = 12; $b > 0; $b--) {
				
				$query = "INSERT INTO Orders_test (yacht_id, person_id, date_begin, date_end, price) VALUES (".$b.", ".$b.", '".$year."-".$m."-".$d."', '".$year."-".$m."-".$d."', 50)";
				echo ++$r;
				echo ". ";
				echo $query;
				echo "<br>";
				$db_link->query($query)
					or die ("Ошибка");
			}

		}
	}	
}

// $result = $db_link->query($query)
//    or die ("Ошибка во время получения из БД списка марин.");

// while ($row = $result->fetch_object())	{
// 		echo "<option value='".$row->id."'>".stripslashes($row->city)."</option>";
// }
// $result->close();

?>
	