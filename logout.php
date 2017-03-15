<?php
ob_start();
session_start();

if(isset($_POST['logout'])) {
   if (ini_get("session.use_cookies")) {
   $params = session_get_cookie_params();
   setcookie(session_name(), '', time() - 42000,
       $params["path"], $params["domain"],
       $params["secure"], $params["httponly"]
   );
}
   $_SESSION = array();
   
   if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
	}
   session_destroy();
   header("location:login.php");
   die();
}

ob_end_flush();
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
<a class="btn" href="logout.php"><button type="button" class="menuButton" id="logout">LOGOUT</button></a>
</div>
<hr class="hr">

<p id ="title">LOGOUT</p>

<form action="" method="POST">
   <input type="submit" class="contact" id="logout" name="logout" value="Logout"/>
</form>

</body>

<footer>
	</br></br></br>
</footer>
</html>
