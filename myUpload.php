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

<?php 
	if(isset($_SESSION['loggedin'])) {
?>
<hr class="hr">
<div id="menu">
<a class="btn" href="index.php"><button type="button" class="menuButton" id="home">HOME</button></a>
<a class="btn" href="myUpload.php"><button type="button" class="menuButton" id="upload">UPLOAD</button></a>
<a class="btn" href="contactus.php"><button type="button" class="menuButton" id="contactus">CONTACT US</button></a>
<a class="btn" href="logout.php"><button type="button" class="menuButton" id="logout">LOGOUT</button></a>

<?php
} else {
	header("Location:login.php");
}
?>
</div>
<hr class="hr">

<p id ="title">MY UPLOADS</p>
<h4>(<?php echo $_SESSION['loggedin']; ?>)</h4>
</br>
<a href="upload.php" id="uploadLink"><button id="uploadButton">UPLOAD NEW</button></a>
</br></br></br>
<?php
$array = file("upload.txt");

foreach($array as $line) {
	$data = explode("~/0530/~", $line);
	$email[] = trim($data[0]);
	$title[] = trim($data[1]);
	$description[] = trim($data[2]);
	$uploadImage[] = trim($data[3]);
}

$uploadNumber = 0;		
for($i = 0; $i < count($array); $i++) {
	if($_SESSION['loggedin'] == $email[$i]) {
		?>
		<div class="thumbnail">
		<?php
			echo '<p style="text-align:center; font-weight:bold">' . $title[$i] . '</p>';
			echo '<a href="details.php?id='. $i .'"><img src="' . $uploadImage[$i]. '" alt="', $uploadImage[$i] , '" class = uploadImages></a>';
			?>
			</br>
			<form action="" method="POST">
				<input type="submit" name="deleteButton<?php echo $i;?>" id="deleteButton" value="DELETE"/>
			</form>
			<?php
			$delete = 'deleteButton' . "$i";
			if(isset($_POST[$delete])) {
				$fileContent = file("upload.txt");
				$fileContent[$i] = str_replace($email[$i] . "~/0530/~" . $title[$i] . "~/0530/~" . $description[$i] . "~/0530/~" . $uploadImage[$i],
											   "",
											   $email[$i] . "~/0530/~" . $title[$i] . "~/0530/~" . $description[$i] . "~/0530/~" . $uploadImage[$i]);
				file_put_contents('upload.txt', implode("", $fileContent));
				echo "<script>alert('Succesfully deleted.')</script>";
				echo "<script>window.location = 'http://ratemyoutfit.info/myUpload.php'</script>";		
			}			
			?>
	  </div>
	  	<?php
	}
}
ob_end_flush();
?>
</body>

<footer>
	</br></br></br>
</footer>
</html>
