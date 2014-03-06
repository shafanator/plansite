<?php

	require_once("password.php");
	$mysqli = new mysqli("localhost", $username, $password, "plansite");

	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
	}
	print_r($_POST);
	echo "test1";
	if ($_POST['button'] == 'SAVE') {
		//ignore button name 
		//foreach
		// key = '$_POST[key]',
		$setString = "";
		echo "test";
		foreach ($_POST as $key => $value) {
			if($key != "button"){
				$setString .= $key;
				$setString .= " = '";
				$setString .= $value;
				$setString .= "', ";
			}

		}
		$setString = substr($setString, 0, -2);
		//echo "<br><strong>$setString</strong><br>";
	    $sql="UPDATE temp_projects SET $setString WHERE project= '$_POST[project]' AND user = '$_POST[user]'";
		if (!mysqli_query($mysqli,$sql))
	  	{
	  		die('Error: ' . mysqli_error($mysqli));
	  	}
		echo "1 record added";

	} else if ($_POST['button'] == 'SUBMIT') {
		//ignore button name
		//`key`,
		//'$_POST[key]',
		echo "test2";
		$keyString = "";
		$valueString = "";
		foreach ($_POST as $key => $value) {
			if($key != "button"){
				$keyString .= "`";
				$keyString .= $key;
				$keyString .= "`, ";
				$valueString .= "'$value', ";
			}

		}
		$keyString = substr($keyString, 0, -2);
		$valueString = substr($valueString, 0, -2);
	    $sql="INSERT INTO projects($keyString) values($valueString)";
	    if (!mysqli_query($mysqli,$sql))
	  	{
	  		die('Error: ' . mysqli_error($mysqli));
	  	}
		echo "1 record added";
		//key = '',
		$setString = "";
		foreach ($_POST as $key => $value) {
			if($key != "button" && $key != "user" && $key != "project"){
				$setString .= $key;
				$setString .= " = '', ";
			}

		}
		$setString = substr($setString, 0, -2);
		$sql="UPDATE temp_projects SET $setString where project= '$_POST[project]' AND user = '$_POST[user]'";
		if (!mysqli_query($mysqli,$sql))
	  	{
	  		die('Error: ' . mysqli_error($mysqli));
	  	}
		echo "1 record added";



	}
	echo "test3";
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'projectlist.php';
	echo "<a href = 'http://$host$uri/$extra'> click here to go </a>";
	//header("Location: http://$host$uri/$extra");
	//header( "Location: projectlist.php" );


?>
