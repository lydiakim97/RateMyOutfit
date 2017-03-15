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

<p id ="title">CONTACT US</p>

</body>

</html>

<?php
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message']) && isset($_POST['submit'])) {
		(@include_once 'vendor/autoload.php') or die("oops");
		(@include_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php') or die("oops");
		$name=$_REQUEST['name'];
		$email=$_REQUEST['email'];
		$message=$_REQUEST['message'];	
		$subject="Contact Form";

		// Create the Transport
		$transport = new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
		$transport->setUsername('');
		$transport->setPassword('');
		// Create the Mailer using your created Transport
		$mailer = new Swift_Mailer($transport);

		// Create a message
		$msg = new Swift_Message ($subject);
		$msg->setFrom(array('' => 'User'));
		$msg->setTo(array('' => 'Me'));
		$msg->setBody("Name: " . $name . "\n" . "Email: " . $email . "\n" . "Message:" . $message . "\n\n");

		// Send the message
		$result = $mailer->send($msg, $failures);

		//from="From: $name<$email>\r\nReturn-path: $email";
		echo "<script>alert('Your message has been successfully sent.')</script>";
		echo "<script>window.location = 'http://ratemyoutfit.info/index.php'</script>";		
}
ob_end_flush();
?>

<form action="" method="POST" >
<input type="text" class="contact" id="name" name="name" required="required" placeholder="   Name.."></br></br>
<input type="text" class="contact" id="email" name="email" required="required" pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" placeholder="   Email.."></br></br>
<input type="text" class="contact" id="message" name="message" required="required" placeholder="   Message.."></br></br>
<input type="submit" name="submit" id="submit" value="Send"/>
</form>		
<footer>
	</br></br></br>
</footer>