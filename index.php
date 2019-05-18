<html>
<head>
	<title>Submission 1</title>
	<style type="text/css">
		body{ background-color: #f0ffff; 
			border-top: solid 10px #000;
			color: #333; font-size: .85em;
			margin: 70;
			font-family: "Segoe UI", Verdana, Helvetica, San-Serif;
		}
		.form-style label{
			display: grid;
			margin: 3px 9px 3px 9px;
		}
		.form-style input[type=text]{
			border-radius: 5px;
			border:1px solid #DCDCDC;
			-webkit-border-radius:5px;
			padding: 5px 10px;
			width: 40%;
		}
		.form-style input[type=submit]{
			border-radius: 3px;
			padding: 5px 10px;
			width: 90%;
			margin-top: 10px;
		}
		.form-style fieldset {
			max-width: 650px;
			border-radius: 5px;
			-webkit-border-radius:10;
			-moz-border-radius:10;
		}
		h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
		h1{font-size: 2em;}
		h2{font-size: 1.75em;}
		h3{font-size: 1.2em;}
		table {
			margin-top: 0.75em;
			border-collapse: collapse;
		}
		th {font-size: 1em;
		 text-align: left;
		 border: none;
		 padding-left: 0;
		}
		td {
			padding: 0.30em 2em 0.30em 0em 0.30em; 
			border: none;
		}
		#footer{
			clear: both;
			position: absolute;
			height: 50px
			margin-top:auto;
			text-align: center;
		}
	</style>
</head>
<body>
	<h3>Submission 1 Azure WebApp & SQl Database</h3>
	<h1>Form Input Barang</h1>
<div id="content" class="form-style">
	<form method="post" action="index.php" enctype="multipart/form-data">
	<fieldset><legend>Silahkan Masukan Data Barang</legend>
	<label for="field1"><span>Kode Barang :</span><input type="text" class="input-field" name="kode" id="kode"/></label>
	<label for="field2"><span>Nama Barang :</span><input type="text" class="input-field" name="nama" id="nama"/></label>
	<label for="field3"><span>Qty Barang :</span><input type="text" class="input-field" name="qty" id="qty"/></label>
	<label for="field4"><span>Harga Beli :</span><input type="text" class="input-field" name="hbeli" id="hbeli"/></label>
	<label for="field5"><span>Harga Jual :</span><input type="text" class="input-field" name="hjual" id="hjual"/></label>
	<input type="submit" name="submit" value="Submit"></br>
	<input type="submit" name="load_data" value="Load Data">
	</fieldset>
</form>
</div>	
<?php
	$host ="bdtmserver.database.windows.net";
	$user ="bdtm";
	$pass ="Butomo2019";
	$db ="bdtmwebappserver";

	try {
		$conn = new PDO("sqlsrv:server = $host; Database = $db", "$user", "$pass");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		echo "Gagal".$e;
	}

	if (isset($_POST['submit'])){
		try {
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$qty = $_POST['qty'];
			$hbeli = $_POST['hbeli'];
			$hjual = $_POST['hjual'];

			//simpan data
			$sql_insert = "INSERT INTO barang (kode, nama, qty, hbeli, hjual) VALUES (?,?,?,?,?)";
			$stmt = $conn->prepare($sql_insert);
			$stmt->bindValue(1, $kode);
			$stmt->bindValue(2, $nama);
			$stmt->bindValue(3, $qty);
			$stmt->bindValue(4, $hbeli);
			$stmt->bindValue(5, $hjual);
			$stmt->execute();
		} catch (Exception $e) {
			echo "Gagal:" .$e;
		}
		echo "<h3>Data berhasil ditambahkan!</h3>";
	}elseif (isset($_POST['load_data'])) {
		try {
			$sql_select = "SELECT * FROM barang";
			$stmt = $conn->query($sql_select);
			$barangs = $stmt->fetchAll();
			if (count($barangs)>0){
				echo "<h3>Data input barang :</h3>";
				echo "<table>";
				echo "<tr><th>Kode Barang</th>";
				echo "<th>Nama Barang</th>";
				echo "<th>Qty Barang</th>";
				echo "<th>Harga Beli</th>";
				echo "<th>Harga Jual</th></tr>";
				foreach ($barangs as $barang ) {
					echo "<tr><td>" .$barang['kode']."</td>";
					echo "<td>" .$barang['nama']. "</td>";
					echo "<td>" .$barang['qty']. "</td>";
					echo "<td>" .$barang['hbeli']. "</td>";
					echo "<td>" .$barang['hjual']. "</td><>/tr";
				}
				echo "</table>";
			}else {
				echo "<h3>Belum ada data!</h3>";
			}
		} catch (Exception $e) {
			echo "Gagal:" .$e;
		}
	}
?>
</body>
<div id="footer">
	<footer>Submission budiutomo@2019</footer>
</div>
</html>
