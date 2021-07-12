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
            function getorder ()   {
                //запрос списка
                $("#search_result").load("/getorder.php", {
                  order_id: $("#order").val(),
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
		<h1>Детали заказа</h1>
		<form>
			<p><b>Номер заказа:</b>
				<input type="text" id="order" name="order" size="20">
			</p>
		</form>
		<br>
		<a href="javascript:void(0);" onclick="getorder();">Поиск</a>
	</section>
	
	<section id="search_result"></section>
	<footer>
		<p>&#169;TTishchenko</p>
	</footer>

</body>
</html>