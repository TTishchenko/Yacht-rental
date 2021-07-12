<?include("config.php")?>

<?
if ($_REQUEST["yacht_id"] > 0)
	$query = "SELECT * FROM Orders WHERE yacht_id = ".intval($_REQUEST["yacht_id"])." AND (MONTH(date_begin) = MONTH(NOW()) OR MONTH(date_end) = MONTH(NOW())) AND (YEAR(date_begin) = YEAR(NOW()) OR YEAR(date_end) = YEAR(NOW()))";
elseif ($_REQUEST["sum"] > 0) {
	$query = "SELECT * FROM Orders WHERE price > ".intval($_REQUEST["sum"])." AND (MONTH(date_begin) = MONTH(NOW()) OR MONTH(date_end) = MONTH(NOW()))";
}
elseif ($_REQUEST["per_id"] > 0) {
	$query = "SELECT * FROM Orders WHERE person_id = ".intval($_REQUEST["per_id"])." AND (YEAR(date_begin) = YEAR(NOW()) OR YEAR(date_end) = YEAR(NOW()))";
}

if (DEBUG_SQL)
	echo "<pre>" . $query . "</pre>"; 

$result = $db_link->query($query)
   or die ("Ошибка во время получения из БД списка заказов.");

?>
<!-- <img src="/img/<?=intval($_REQUEST["yacht_id"])?>.jpg" alt=""> -->

<table border="1" width="50%" align="center">
	<tr><th>Order_ID</th><th>From</th><th>Till</th><th>Price</th></tr>
<?
while ($row = $result->fetch_object())	{
?>

	<tr align="center">
		<td><?=$row->id?></td>
		<td><?=$row->date_begin?></td>
		<td><?=$row->date_end?></td>
		<td><?=$row->price?>$</td>
	</tr>
	<?
}
		//echo "<option value='".$row->id."'>".stripslashes($row->name)."</option>";
$result->close();

?>
</table>

