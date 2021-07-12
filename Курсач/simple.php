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
                $("#search_result").load("/simple_getorders.php", {
                  yacht_id: $("#yacht_select option:selected").val()
                }, function(msg){});
            }
            function getreport2 ()   {
                //запрос списка
                $("#search_result").load("/simple_getorders.php", {
                  sum: $("#price_select").val()
                }, function(msg){});
            }
            function getreport3 ()   {
                //запрос списка
                $("#search_result").load("/simple_getorders.php", {
                  per_id: $("#person_select option:selected").val()
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
		<h1>Все заказы определенной яхты за текущий месяц</h1>
		<form>
			Яхта
			<select name="yacht_select" id="yacht_select">
				<?
					$query = "SELECT * FROM Yachts";
					$result = $db_link->query($query)
					   or die ("Ошибка во время получения из БД списка марин.");

					while ($row = $result->fetch_object())	{
				 		echo "<option value='".$row->id."'>".stripslashes($row->name)."</option>";
					}
					$result->close();
					?>
			</select>
		</form>
		<br>
		<a href="javascript:void(0);" onclick="getreport();">Поиск</a>
		<br>
		<br>

			<!-------------------------------------->

		<h1>Все заказы за текущий месяц > определенной суммы</h1>
		<form>
			Сумма
			<input type="text" name="price_select" id="price_select">$
		</form>
		<br>
		<a href="javascript:void(0);" onclick="getreport2();">Поиск</a>
		<br>
		<br>

		<!-------------------------------------->

		<h1>Все заказы человека за год</h1>
		<form>
			Человек
			<select name="person_select" id="person_select">
				<?
					$query = "SELECT * FROM Person";
					$result = $db_link->query($query)
					   or die ("Ошибка во время получения из БД списка людей.");

					while ($row = $result->fetch_object())	{
				 		echo "<option value='".$row->id."'>".stripslashes($row->name)." ".stripslashes($row->surname)."</option>";
					}
					$result->close();
					?>
			</select>
		</form>
		<br>
		<a href="javascript:void(0);" onclick="getreport3();">Поиск</a>
	</section>

	<section id="search_result"></section>
	<footer>
		<p>&#169;TTishchenko</p>
	</footer>
</body>
</html>