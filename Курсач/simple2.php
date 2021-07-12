<?include("config.php")?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="style/reset.css">
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/yachts.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<script>
    function getreport ()   {
        //запрос списка
        $("#search_result").load("/simple_getyachts.php", {
          port_id: $("#port_select option:selected").val(),
          l: $("#l_select").val()
        }, function(msg){});
    }
    function getreport2 ()   {
        //запрос списка
        $("#search_result").load("/simple_getyachts.php", {
          crew: $("#crew_select").val(),
          len: $("#len_select").val()
        }, function(msg){});
    }
            
</script>
<body>
	<header>
		<div>
			<a href="index.html">
				<h1>Yacht rental</h1>
			</a>
		</div>
	</header>
	<section>

		<h1>Все яхты из определенной марины > определенной длинны</h1>
		<form>
			Марина
			<select name="port_select" id="port_select">
				<?
					$query = "SELECT * FROM Ports";
					$result = $db_link->query($query)
					   or die ("Ошибка во время получения из БД списка марин.");

					while ($row = $result->fetch_object())	{
				 		echo "<option value='".$row->id."'>".stripslashes($row->name)."</option>";
					}
					$result->close();
				?>
			</select>
			Длина
			<input type="text" name="l_select" id="l_select">

		</form>
		<br>
		<a href="javascript:void(0);" onclick="getreport();">Поиск</a>
		<br><br>

		<!-------------------------------------->

		<h1>Все яхты с > определенного кол-во людей и > определенной длины</h1>
		<form>
			Кол-во людей
			<input type="text" name="crew_select" id="crew_select">
			Длина
			<input type="text" name="len_select" id="len_select">

		</form>
		<br>
		<a href="javascript:void(0);" onclick="getreport2();">Поиск</a>
	</section>

	<section id="search_result"></section>
	<footer>
		<p>&#169;TTishchenko</p>
	</footer>
</body>
</html>