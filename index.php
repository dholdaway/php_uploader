<?php
 
session_start();
 
$username = 'username';
$password = 'password';
 
$random1 = 'secret_key1';
$random2 = 'secret_key2';
 
$hash = md5($random1.$pass.$random2); 
 
$self = $_SERVER['REQUEST_URI'];
 
if(isset($_GET['logout']))
{
	unset($_SESSION['login']);
}
 
if (isset($_SESSION['login']) && $_SESSION['login'] == $hash) {

	?>
 
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<title>File Upload</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
	
			<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		</head>
		<body>
		<div class="container">
			<div class="jumbotron">
				<h1><span class="glyphicon glyphicon-cloud-upload"></span> File Upload</h1>
				<form action="upload.php" method="post" enctype="multipart/form-data">
					<br>
					<h2>Select .zip-Archive to upload:</h2>
					<input type="file" name="fileToUpload" id="fileToUpload">
					<br>
					<button type="submit" value="Upload File" name="submit">Upload File</button>
				</form>
			</div>
			<a href="?logout=true">Logout?</a>
		</div>
		</body>
 
	<?php
}
 
 
else if (isset($_POST['submit'])) {
 
	if ($_POST['username'] == $username && $_POST['password'] == $password){
	
		//IF USERNAME AND PASSWORD ARE CORRECT SET THE LOG-IN SESSION
		$_SESSION["login"] = $hash;
		header("Location: $_SERVER[PHP_SELF]");
 
	} else {
 
		// DISPLAY FORM WITH ERROR
		display_login_form();
		echo '<p>Username or password is invalid</p>';
 
	}
}	
 
else { 
 
	display_login_form();
 
}
 
 
function display_login_form(){ ?>
 
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>File Upload</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</head>
	<body>
	<div class="container">
	<h1 style="margin-top: 50px;">Login</h1>
	<br>
	<form action="<?php echo $self; ?>" class="form-inline" method='post'>
	<label for="username">Username</label>
	<input type="text" name="username" id="username" class="form-control">
	<label for="password">Password</label>
	<input type="password" name="password" id="password" class="form-control">
	<button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
	</form>
	</div>
	</body>	
 
<?php } ?>

</html>