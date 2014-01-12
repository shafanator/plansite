<html>
	<head>
		<title>Blank Template</title>
		<link  href="plansite.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			
		</script>
	</head>
	<body>
		
		<div id = "wrapper">
			<div style="right:0px;"><a href="logout.php" >Log Out</a></div>
			<div id = "top_banner"></div>
			<div id = "content">
			<?php

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'projectlist.php';
	
	setcookie("user", $_POST['user'], time()+60*60*24*2);//save user name for 2 days?
	$user = $_POST['user'];
	echo $user;
	global $mysqli = new mysqli("localhost", "mss302", "415", "plansite");
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
	}
	//echo print_r($_POST);
	if(count($_POST)==2){//check user NOT CREATE USER
		if ($result = $mysqli->query("SELECT * FROM users WHERE user =  '".$user."' ")) 
			{
				$hashed_password= 'wrong';
				while($row=$result->fetch_object()){
					
					$hashed_password = $row->password;
					$group = $row->group;
				}
				$result->close();
			
			if ($hashed_password && crypt($_POST['password'], $hashed_password) == $hashed_password) {
				echo "Password verified!";
				echo $_POST['user'];
				echo "<br>";
				//echo $_COOKIE["user"];
				echo "<br><div id = \"googlelogin\">";
				echo "<a href = 'http://$host$uri/$extra'> Click here to view current projects  </a></div>";
				setcookie("group", $group, time()+60*60*24*2);
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
	else{
		createUser($user, $_POST['password'], (int)$_POST['group']);
	}

	if(isset($group) && $group == 6)//user creator
	{//create USER
		?>
				<form action = "authentication.php" method="POST" style="" >
	  			Username: <input type="text" name="user"><br>
	  			Password: <input type="password" name="password"><br>
	  			Create User:   <select name="group">
					<?php
					    for ($x=1; $x<=6; $x++) {
					        echo '    <option value="' . $x . '">' . $x . '</option>' . PHP_EOL;
					    }
					?>
  				</select><br>
	  			<input type="submit" value="Submit">
				</form>



		<?php


	}
	if(isset($_COOKIE["group"]) && $_COOKIE["group"] > 5){//
		
	}


	function createUser($username, $password, $group){
		$pass  =crypt($password);
		$mysqli = new mysqli("localhost", "mss302", "415", "plansite");
        if ($mysqli->connect_errno) {
                printf("Connect failed: %s\n", $mysqli->connect_error);
                        exit();
        }

		if (!$mysqli->query("INSERT INTO users(`user`,`password`,`group`) values('$username','$pass', '$group')"))
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
			</div>
		</div>

	</body>
</html>


