<?php
ob_start();
session_start();
?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Rate My Outfit</title>
<link rel="icon" type="image/png" href="img/colourRate.png" />
</head>
<body>

<img src="img/banner.png" alt="banner" id="banner">

<hr class="hr">
<div id="menu">
<a class="btn" href="index.php"><button type="button" class="menuButton" id="home">HOME</button></a>
<a class="btn" href="myUpload.php"><button type="button" class="menuButton" id="upload">UPLOAD</button></a>
<a class="btn" href="contactus.php"><button type="button" class="menuButton" id="contactus">CONTACT US</button></a>
<?php 
if(isset($_SESSION['loggedin'])) {
	?>
	<a class="btn" href="logout.php"><button type="button" class="menuButton" id="logout">LOGOUT</button></a>
<?php
} else {
?>
	<a class="btn" href="login.php"><button type="button" class="menuButton" id="login">LOGIN</button></a>
<?php
}
?>
	
</div>
<hr class="hr">

<p id ="title">HOMEPAGE</p>

<!--
<form>
  <input type="text" id="search" name="search" placeholder="   Search.."></br></br>
  <input type="submit" name="submit" id="submit" value="SEARCH"/>
</form>
-->

</body>

<footer>
	</br></br></br>
</footer>
</html>

<?php
$array = file("upload.txt");

foreach($array as $line) {
	$data = explode("~/0530/~", $line);
	$title[] = trim($data[1]);
	$uploadImage[] = trim($data[3]);
}
				
for($i = 0; $i < count($array); $i++) {
?>

<div class="container">
  <div class="row">
    <div class="col-md-4 col-sm-6">
	<?php
	if($i < count($array)) {
	?>
		<div class="thumbnail">
		<?php
			echo '<p style="text-align:center; font-weight:bold">' . $title[$i] . '</p>';
			echo '<a href="details.php?id='. $i .'"><img src="' . $uploadImage[$i]. '" alt="', $uploadImage[$i] , '" class = uploadImages></a>';
			} else {
				break;
			}
			?>
      </div>
    </div>
    <div class="col-md-4 col-sm-6">
	<?php
	if($i+1 < count($array)) {
	?>
        <div class="thumbnail">
		<?php
			$j = $i+1;
			echo '<p style="text-align:center; font-weight:bold">' . $title[$j] . '</p>';
			echo '<a href="details.php?id='. $j .'"><img src="' , $uploadImage[$j], '" alt="', $uploadImage[$j] ,  '"class = uploadImages></a>';
			} else {
				break;
			}
		?>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
	<?php
	if($i+2 < count($array)) {
	?>
        <div class="thumbnail">
	    <?php
			$k = $i+2;
			echo '<p style="text-align:center; font-weight:bold">' . $title[$k] . '</p>';
			echo '<a href="details.php?id='. $k .'"><img src="' , $uploadImage[$k], '" alt="', $uploadImage[$k] , '" class = uploadImages></a>';
			$i = $i+2;
			} else {
				break;
			}
	    ?>
        </div>
    </div>
  </div>
</div>
<?php
}
ob_end_flush();
?>
</br></br></br>
