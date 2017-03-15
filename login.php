<?php
ob_start();
session_start();

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


if(isset($_POST['submit'])) {
    if (isset($_POST['user']) && isset($_POST['pass'])) {
		$array = file("users.txt");

		foreach($array as $line) {
			$data = explode("~/0530/~", $line);
			$fileEmail[] = trim($data[0]);
			$filePassword[] = trim($data[1]);
		}
				
		for($i = 0; $i < count($array); $i++) {
			if ($_POST['user'] == $fileEmail[$i] && $_POST['pass'] == encrypt_decrypt('decrypt', $filePassword[$i])) {	
				$_SESSION['loggedin'] = $fileEmail[$i];
				echo "<script>alert('Sucessfully logged in.')</script>";
				header("Location:index.php");
	        } else {
				if($i == count($array) - 1) {
					echo "<script>alert('Invalid email or password.')</script>";
					header("Refresh:0");
				}
			}
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

<p id ="title">LOGIN</p>

<form action="" method="POST">
<input type="text" class="contact" id="user" name="user" placeholder="   Username.."></br></br>
<input type="password" class="contact" id="pass" name="pass" placeholder="   Password.."></br></br>
<input type="submit" name="submit" id="submit" value="LOGIN"/>
</form>

</br><a class="btn" id="signupLink" href="signup.php"><button type="button" class="menuButton" id="signupButton">SIGNUP</button></a>

</body>

<footer>
	</br></br></br>
</footer>

</html>