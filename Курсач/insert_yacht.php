<?include("config.php")?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?

if (isset($_POST['yacht_name'])) {

	$query = "INSERT INTO Yachts (name, length, port, description) VALUES ('" . $db_link->real_escape_string($_POST['yacht_name'])."', ".intval($_POST["yacht_length"]).", ".intval($_POST["yacht_port"]).", '".$db_link->real_escape_string($_POST['yacht_desc'])."')";
	print($query);

	if(!$db_link->query($query))
		echo "<p>ошибка создания записи";

} else {
	echo "<p>Необходимо ввести название";
}

?>
	<a href="yachts.php">вернуться к форме ввода</a>

</body>
</html>