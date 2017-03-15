<?php
ob_start();
session_start();
$_SESSION['time'] = time();

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}


function newAccount($email, $pass) {
    $handler = fopen("users.txt", "a") or die("Unable to open the file.");
    $user = $email . "~/0530/~" . encrypt_decrypt('encrypt', $pass) . "~/0530/~" . gmdate("M d Y h:ia", $_SESSION['time']) . "\n";
    fwrite($handler, $user);
    fclose($handler);
}

if(isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['confirm'])) {	
		$array = file("users.txt");
		foreach($array as $line) {
			$data = explode("~/0530/~", $line);
			$users[$data[0]] = $data[1];
		}
		if(!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['confirm'])) {
			if(!isset($users[$_POST['email']])){
				if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					if(strlen($_POST['pass']) >= 6) {
						if($_POST['pass'] == $_POST['confirm']) {
							newAccount($_POST['email'], $_POST['pass']);	
							echo "<script>alert('Account successfully created.')</script>";
							header("Location:login.php");
						} else {
							echo "<script>alert('The password does not match.')</script>";
						}
					} else {
						echo "<script>alert('The password must be at least 6 characters long.')</script>";
					}
				} else {
					echo "<script>alert('This email is not valid.')</script>";
				}
			} else {
				echo "<script>alert('This email is already registered.')</script>";
			} 	
		} else {
			echo "<script>alert('Enter the required field.')</script>";
		}
	}	 
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
<a class="btn" href="login.php"><button type="button" class="menuButton" id="login">LOGIN</button></a>
<hr class="hr">

<p id ="title">SIGN UP</p>

<form action="" method="POST">
<input type="text" class="contact" id="email" name="email" placeholder="   Email.."></br></br>
<input type="password" class="contact" id="pass" name="pass" placeholder="   Password.. (at least 6 characters)"></br></br>
<input type="password" class="contact" id="confirm" name="confirm" placeholder="   Confirm Password.."></br></br>
<input type="submit" name="submit" id="submit" value="SIGN UP"/>
</form>
</body>

<footer>
	</br></br></br>
</footer>

</html>