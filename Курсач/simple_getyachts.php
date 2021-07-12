<?include("config.php")?>

<?
if (($_REQUEST["port_id"] > 0) and ($_REQUEST["l"] > 0))
	$query = "SELECT * FROM Yachts WHERE port_id = ".intval($_REQUEST["port_id"])." AND length > ".intval($_REQUEST["l"]);
elseif (($_REQUEST["crew"] > 0) and ($_REQUEST["len"] > 0)) {
	$query = "SELECT * FROM Yachts WHERE crew > ".intval($_REQUEST["crew"])." AND length > ".intval($_REQUEST["len"]);
}

if (DEBUG_SQL)
	echo "<pre>" . $query . "</pre>"; 

$result = $db_link->query($query)
   or die ("Ошибка во время получения из БД списка яхт.");

?>

<table border="1" width="50%" align="center">
	<tr><th>Image</th><th>Yacht_ID</th><th>Yacht_name</th><th>Length</th><th>Crew</th><th>Price</th></tr>
<?
while ($row = $result->fetch_object())	{
?>

	<tr align="center">
		<td><img src="/img/<?=$row->id?>.jpg" alt=""></td>
		<td><?=$row->id?></td>
		<td><?=$row->name?></td>
		<td><?=$row->length?></td>
		<td><?=$row->crew?></td>
		<td><?=$row->price?>$</td>
	</tr>
	<?
}
		//echo "<option value='".$row->id."'>".stripslashes($row->name)."</option>";
$result->close();

?>
</table>

