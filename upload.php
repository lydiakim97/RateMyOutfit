<?php
ob_start();
session_start();

function newUpload($title, $description, $dir) {
    $handler = fopen("upload.txt", "a") or die("Unable to open the file.");
    $upload = $_SESSION['loggedin'] . "~/0530/~" . $title . "~/0530/~" . $description . "~/0530/~" . "upload/" . $dir . "\n";
    fwrite($handler, $upload);
    fclose($handler);
}

$image = array("jpg", "jpeg", "JPG", "gif", "png", "bmp");
$directory = 'upload/';

if(isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['file']) &&  isset($_POST['submit'])) {
		if (!empty($_FILES['file']['tmp_name'])) {
			$ext = explode('.', strtolower($_FILES['file']['name']) ); // check the extension of the file
			if (in_array(end($ext), $image)) {
				if (move_uploaded_file( $_FILES['file']['tmp_name'], $directory . basename($_FILES['file']['name'] ) ) ) {
					$array = file("upload.txt");
					foreach($array as $line) {
						$data = explode("~/0530/~", $line);
						$upload[$data[0]] = $data[1];
					}
					newUpload($_POST['title'], $_POST['description'], $_FILES['file']['name']);	
					echo "<script>alert('Succesfully uploaded.')</script>";
					echo "<script>window.location = 'http://ratemyoutfit.info/myUpload.php'</script>";				}
			} else {
				echo "<script>alert('Invalid file type.')</script>";
			}
		} else {
			echo "<script>alert('File has not been selected.')</script>";

		}
 	
}

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
ob_end_flush();
?>
</div>
<hr class="hr">

<p id ="title">UPLOAD</p>

<form action="" method="POST" enctype="multipart/form-data">
<input type="text" class="contact" id="uploadTitle" name="title" maxlength="30" placeholder="   Title.." ></br></br>
<!--<input type="text" class="contact" id="tag" name="tag" placeholder="   Tag.. (#winter)"></br></br>-->
<textarea class="contact" id="description" name="description"  maxlength="300" placeholder=" Description.."></textarea></br></br>
<input type="file" id="file" name="file" ></br></br>
<input type="submit" name="submit" id="submit" value="UPLOAD"/>
</form>
</body>


<footer>
	</br></br></br>
</footer>
</html>
