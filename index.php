<!DOCTYPE html>
<html>
<head>
	<title>Grafik Sensor</title>

	<!-- Panggil file Bootstrap -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<script type="text/javascript" src="assets/js/jquery-3.4.0.min/js"></script>
	<script type="text/javascript" src="assets/js/mdb.min.js"></script>
	<script type="text/javascript" src="jquery-latest.js"></script>


	<!-- Pemanggil Data Grafik -->
	<script type="text/javascript">
		var refreshid = setInterval(function(){
			$('#respongrafik').load('data.php');
		}, 1000);
	</script>


</head>
<body>

	<!-- Tempat tampilan grafik  -->
	<div class="container" style="text-align: center;">

		<h3>Grafik Sensor DHT11 Secara Realtime</h3>
		<p>Data yang ditampilkan adalah 5 Data terakhir</p>

	</div>


	<!-- Div Grafik -->
	<div class="container">
	<div class="container" id="respongrafik" style="width: 100%; text-align: center;"></div>
	</div>

	<!-- Tampilan Grambar -->
	<div class="container" style="text-align: center;">
		<img src="assets/img/wkwkw.PNG">
	</div>

</body>
</html>