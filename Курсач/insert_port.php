<?include("config.php")?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?

if (isset($_POST['port_name'])) {

	$query = "INSERT INTO ports (name) VALUES ('" . $db_link->real_escape_string($_POST['port_name'])."')";
	print($query);

	if(!$db_link->query($query))
		echo "<p>ошибка создания записи";

} else {
	echo "<p>Необходимо ввести название";
}

?>
	<a href="ports.php">вернуться к форме ввода</a>

</body>
</html>