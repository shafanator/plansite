<html>
	<head>
		<title>Authentication</title>
		<link  href="plansite.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			
		</script>
	</head>
	<body>
		
		<div id = "wrapper">
			<div style="right:0px;"><a href="?logout=" >Log Out</a></div>
			<div id = "top_banner"></div>
			<div id = "content">
			<?php

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'projectlist.php';
	
	
	require_once'password.php';
	

	require_once 'config.php';
	require_once 'CAS-1.3.2/CAS.php';
	phpCAS::setDebug("log.txt");
	phpCAS::client(CAS_VERSION_2_0, "test-cas.rutgers.edu", 443, "");
	phpCAS::setNoCasServerValidation();
	
	$mysqli = new mysqli("localhost", $username, $password, "plansite");
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
	}
	if (isset($_REQUEST['logout'])) {

	setcookie("user", "", -1);
    setcookie("group", "", -1);
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
	phpCAS::logout();
}
phpCAS::forceAuthentication();

	if(!phpCAS::isAuthenticated()){
		$user = phpCAS::getUser();
		
		echo $user;
		setcookie("user", $user, time()+60*60*24*2);
		//check user NOT CREATE USER
		if (!$result = $mysqli->query("SELECT * FROM users WHERE user =  '".$user."' ")) 
			{
				echo "test1";
				$hashed_password= 'wrong';
				while($row=$result->fetch_object()){
					
					$hashed_password = $row->password;
					$group = $row->group;
				}
				$result->close();
			
			
				echo "Password verified!";
				echo $user;
				echo "<br>";
				//echo $_COOKIE["user"];
				echo "<br><div id = \"googlelogin\">";
				echo "<a href = 'http://$host$uri/$extra'> Click here to view current projects  </a></div>";
				setcookie("group", $group, time()+60*60*24*2);
			
			
		}
		else
		{
			?>
			You do not a valid username within the database. Would you like to create one? 
			<br> 
			<form action = "authentication.php" method="POST" style="" >
	  			Username: <input type="text" name="user" value = "<?echo $user ?>" >
	  			<br>
	  			Password: <input type="password" name="password"><br>
	  			<br>
	  			<input type="submit" value="Submit">
				</form>
			Please enter a password:
			<input type="password" name="password"><br>

			<br>
			<a href = 'http://$host$uri'> click here to go back </a>
			<?
			setcookie("user", "", time()-3600);
		}
	}

	
	?>
			</div>
		</div>

	</body>
</html>


