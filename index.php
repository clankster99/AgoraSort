<!DOCTYPE html>
<html lang="en">
<head>
  <title>MarketSort</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="css/main.css">


  <style>

.thumbnail{
    max-height: 50%;
    max-width: 100%;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 20%;
    padding: 10px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
html, body{
  padding: 0;
  margin: 0;
}
html{
  height: 100%;
}
body{
  min-height: 100%;
}

.centerBlock {
  display: table;
  margin: auto;
}
</style>
</head>

<body>
  
  <!--Navigation bar-->
	<div id="nav-placeholder">
		<?php
			include 'nav.php';
		?>
	</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
			<a href="product.php?phone=iPhoneX">
				<center>
					<h2>iPhone X</h2>
				</center>
			</a>
			<div class="centerBlock product-img">
				<img src="iphonexfinal.png"  class="img-responsive" style="max-height: 100%; max-width: 100%"/>
				<div class="overlay">
					<div class="test">
						Great Camera!
						<br>
						Expert Rating:
						<br>
						User Rating:
					</div>
				</div>
			</div>
        </div>
        <div class="col">
           <a href="product.php?phone=SamsungS9">
			<center>
			<h2>Samsung S9</h2>
			</center>
			</a>
			<div class="centerBlock">
			<img src="samsung600.png" class="img-responsive" style="max-height: 100%; max-width: 100%">
			</div>
        </div>
		<div class="col">
			 <a href="product.php?phone=GooglePixel2">
			<center>
			<h2>Google Pixel 2</h2></center></a>
			<div class="centerBlock">
			<img src="googlepixel2.png" class="img-responsive" style="max-height: 100%; max-width: 100%"/>
			</div>
			
		</div>
		<div class="col">
			<a href="product.php?phone=iPhone8">
			<center>
			<h2> iPhone 8</h2></center>
			</a>
			<div class="centerBlock">
			<img src="iphone81.png" class="img-responsive" style="max-height: 100%; max-width: 100%"/>
			</div>

		</div>
		<div class="col">
			<a href="product.php?phone=HTC11">
			 <center>
			<h2>HTC U11</h2></center>
			</a>
			<div class="centerBlock">
			<img src="htcu11.png" class="img-responsive" style="max-height: 100%; max-width: 100%"/>
			</div>
		</div>
		</div>
		
	<div class="row">
		<div class="col">
			<a href="product.php?phone=SamsungNote8">
			<center><h2>Samsung Galaxy Note 8</h2></center>
			</a>
			<div class="centerBlock">
			<img src="note8.png" class="img-responsive" style="max-height: 100%; max-width: 100%"/>
			</div>
		</div>
		<div class="col">
			<a href="product.php?phone=Huawei">
			<center>
			<h2>Huawei Mate 10 Pro</h2></center>
			</a>
			<div class="centerBlock">
			<img src="huawei.png" class="img-responsive" style="max-height: 100%; max-width: 100%"/>
			</div>
		</div>
		<div class="col">
			<a href="product.php?phone=OnePlus">
			<center>
			<h2>OnePlus 5T</h2></center>
			</a>
			<div class="centerBlock">
			<img src="oneplus1.png" class="img-responsive" style="max-height: 100%; max-width: 100%"/>
			</div>
		</div>
		<div class="col">
			<a href="product.php?phone=Motorola">
			<center><h2>Moto Z2 Force</h2></center>
			</a>
			<div class="centerBlock">
			<img src="moto.png" class="img-responsive" style="max-height: 100%; max-width: 100%"/>
			</div>
		</div>
		<div class="col">
			<a href="product.php?phone=LG">
			<center><h2>LG v30</h2></center>
			</a>
			<div class="centerBlock">		
			<img src="lg.png" class="img-responsive" style="max-height: 100%; max-width: 100%"/>
			</div>
		</div>
		
</div>

<?php
   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('agora.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully<br>";
   }

   $sql =<<<EOF
      SELECT * from PHONES;
EOF;

   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      echo "ID = ". $row['ID'] . "<br>";
      echo "PHONE NAME = ". $row['PHONE_NAME'] ."<br><br>";
   }
   echo "Operation done successfully\n";
   $db->close();
?>


</body>
</html>