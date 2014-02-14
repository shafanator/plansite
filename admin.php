<html>
	<head>
		<title>Project List</title>
		<link  href="plansite.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		
		<div id = "wrapper">
		<div style="right:0px;"><a href="authCAS.php?logout=" >Log Out</a></div>
			<div id = "top_banner"></div>
			<div id = "content">
				<?php $user = $_COOKIE['user'];
				require_once("password.php");
				$mysqli = new mysqli("localhost", $username, $password, "plansite");

				if ($mysqli->connect_errno) {
					printf("Connect failed: %s\n", $mysqli->connect_error);
					exit();
				}
				?>
				This is the Admin Page
				<br>
				<br>To do:
				<br>User dropdown, textbox
				<br>
				<br>1. Create entry in project list
				<br>2. Create project in projects
				<br>3. Create project in temp_projects

				<br>
				<br>
				<br>
				<?php

				if(isset($_GET['user']) && isset($_GET['project'])){


					//echo $_GET['user'];


					$sql="INSERT INTO projects(`user`, `project`) values('$_GET[user]', '$_GET[project]')";
					if (!mysqli_query($mysqli,$sql))
					{
						die('Error: ' . mysqli_error($mysqli));
					}
					echo "Added to Project List<br>";
					$sql="INSERT INTO projectlist(`user`, `project`) values('$_GET[user]', '$_GET[project]')";
					if (!mysqli_query($mysqli,$sql))
					{
						die('Error: ' . mysqli_error($mysqli));
					}
					echo "Added to Projects<br>";
					$sql="INSERT INTO temp_projects(`user`, `project`) values('$_GET[user]', '$_GET[project]')";
					if (!mysqli_query($mysqli,$sql))
					{
						die('Error: ' . mysqli_error($mysqli));
					}
					echo "Added to temp project<br>";






				}
				else
					echo "<br>Please enter a user and project to assign.<br>";


				?>
				<br><form action = "admin.php" method="GET" style="" >
	  			
	  			User:<select name="user">
					<?php 
					if ($names = $mysqli->query("SELECT user from users "))
					    while($name = $names->fetch_object()) {
					        echo '    <option value="' . $name->user . '">' . $name->user . '</option>' . PHP_EOL;
					    }
					?>
  				</select><br>
  				Project: <input type="text" name="project"><br>
	  			<input type="submit" value="Submit">
				</form>

				

				


			


				
			</div>
		</div>

	</body>
</html>
