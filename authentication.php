<?php

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'projectlist.php';
	
	setcookie("user", $_POST['user'], time()+60*60*24*2);//save user name for 2 days?
	$user = $_POST['user'];
	echo $user;
	$mysqli = new mysqli("localhost", "root", "", "plansite");
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
	}
	//echo print_r($_POST);
	if(count($_POST)==2){//check user NOT CREATE USER
		if ($result = $mysqli->query("SELECT password FROM users WHERE user =  '".$user."' ")) 
			{
				$hashed_password= 'wrong';
				while($row=$result->fetch_object()){
					
					$hashed_password = $row->password;
				}
				$result->close();
			
			if ($hashed_password && crypt($_POST['password'], $hashed_password) == $hashed_password) {
				echo "Password verified!";
				echo $_POST['user'];
				echo "<br>";
				echo $_COOKIE['user'];
				echo "<br>";
				echo "<a href = 'http://$host$uri/$extra'> click here to go </a>";
			}
			else
			{
				echo "Wrong Password or username please try again";
				echo "<br>";
				echo "<a href = 'http://$host$uri'> click here to go </a>";
			}
		}
		else
		{
			echo "Wrong password or username please try again";
			echo "<br>";
			echo "<a href = 'http://$host$uri'> click here to go </a>";
			setcookie("user", "", time()-3600);
		}
	}
	else{//create USER
		$pass  =crypt($_POST['password']);

		if (!$mysqli->query("INSERT INTO users(`user`,`password`) values('$user','$pass')"))
		{ 
			print_r($mysqli->error_list);
		}
		else
		{
			echo "User/Password created";
		}

	}

//header("Location: http://$host$uri/$extra");
//header( "Location: projectlist.php" );
?>
