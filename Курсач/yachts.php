<?include("config.php")?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="style/reset.css">
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/order.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<script>
            function select_city ()   {
                //запрос списка
                $("#city_select").load("/getcities.php", {
                  country_id: $("#countries option:selected").val()
                }, function(msg){});
            }
            function search_result ()   {
            	//показ значка загрузки
                //$(".b-loading").show();

                //запрос списка
                $("#search_result").load("/getyachts.php", {
                  city_id: $("#city_select option:selected").val(),
                  db: $("#date_begin option:selected").val(),
                  de: $("input[name='cdur']:checked"). val()
                }, function(msg){
                    //прячем значок загрузки
                    //$(".b-loading").hide();

                    $("#form_info").show();

                    //$('#foundCount').html('Найдено <strong>'+$('#objListCounts').val()+'</strong> запросов');
                });
            }
            function make_order (yacht_id, price)   {
                //запрос списка
                $("#search_result").load("/makeorder.php", {
                	yacht_id: yacht_id,
                	db: $("#date_begin option:selected").val(),
                  	de: $("input[name='cdur']:checked"). val(),
                  	price: price * $("input[name='cdur']:checked"). val(),
                  	info_name: $("#info_name").val(),
                  	info_surname: $("#info_surname").val(),
                  	info_email: $("#info_email").val(),
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

		<h1>Яхты</h1>

		<form>
			Дата
			<select name="date_begin" id="date_begin">
				<option value="2019-09-20">2019-09-20</option>
				<option value="2019-09-27">2019-09-27</option>
				<option value="2019-10-04">2019-10-04</option>
				<option value="2019-10-11">2019-10-11</option>
				<option value="2019-10-18">2019-10-18</option>
				<option value="2019-10-25">2019-10-25</option>
				<option value="2019-11-01">2019-09-06</option>
				<option value="2019-11-08">2019-09-13</option>
			</select>
			<p><b>Продолжительность аренды:</b>
				<input type="radio" name="cdur" checked value="1"> 7 days
				<input type="radio" name="cdur" value="2"> 14 days
			</p>

			Страна
			<select name="countries" id="countries" onchange="select_city();">
				<option value="">Выбрать страну</option>
				<?
				$query = "SELECT * FROM Country";
				$result = $db_link->query($query)
				   or die ("Ошибка во время получения из БД списка марин.");

				while ($row = $result->fetch_object())	{
			 		echo "<option value='".$row->id."'>".stripslashes($row->country)."</option>";
				}
				$result->close();
				?>
			</select>

			Город
			<select name="city_select" id="city_select"></select>
			<br>
			<a href="javascript:void(0);" onclick="search_result();">Поиск</a>
			<!-- <input type="submit" value="Поиск"> -->


			<div id="form_info" style="display: none;">
				<p><b>Name:</b>
						<input type="text" id="info_name" name="info_name" size="20">
					</p>
					<p><b>Surname:</b>
						<input type="text" id="info_surname" name="info_surname" size="20">
					</p>
					<p><b>Email:</b>
						<input type="text" id="info_email" name="info_email" size="20">
					</p>
			</div>

		</form>
	</section>

	<section id="search_result"></section>
	<footer>
		<p>&#169;TTishchenko</p>
	</footer>

</body>
</html>