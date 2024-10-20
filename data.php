<?php 
	// Koneksi Database
	$konek = mysqli_connect("localhost","root","","grafiksensor");

	// Baca data dari tb_sensor
	// Var tanggal (semua data)
	// Tanggal Sumbu X dan Suhu Sumbu Y

									// select 'var tanggal'
	$tanggal = mysqli_query($konek, "SELECT tanggal FROM tb_sensor ORDER BY ID ASC");
	// baca informasi suhu untuk semua data
	$suhu = mysqli_query($konek, "SELECT suhu FROM tb_sensor ORDER BY ID ASC");
 ?>

 <!-- Tampilan Grafik -->
 <div class="panel panel-primary">
	<div class="panel-heading">
		Grafik Sensor
	</div> 	

	<div class=panel-body>
		<!-- canvas grafik -->
		<canvas id="Chart"></canvas>

		<!-- Gambar Grafik -->
		<script type="text/javascript">
			//baca id tempat grafik ditelakkan
			var canvas = document.getElementById('Chart');
			//Tempat Data untuk grafik
			var data = {
				labels : [
				<?php 
					while($data_tanggal = mysqli_fetch_array($tanggal))
					{
						echo '"'.$data_tanggal['tanggal'].'",';
					}
				 ?>
				],
				datasets : [{
					label : "Suhu",
					data : [
						<?php 
							while($data_suhu = mysqli_fetch_array($suhu)){
								echo $data_suhu['suhu'].',';
							}
						 ?>
					]
				}]
			};


			//opsi grafik
			var option = {
				showLines : true,
				animation : {duration : 0}
			};

			//cetak grafik -> canvas
			var LineChart = Chart.Line(canvas, {
				data : data,
				option : option
			});

		</script>
	</div>
 </div>