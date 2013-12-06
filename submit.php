<?php
	echo "test";
	$mysqli = new mysqli("localhost", "root", "", "plansite");
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
	}
	print_r($_POST);
	if ($_POST['button'] == 'Submit to Temp') {
	    $sql="UPDATE temp_projects SET user =  '$_POST[user]',  done =  '$_POST[done]', to_do = '$_POST[to_do]', hours_last_month = '$_POST[hours_last_month]', hours = '$_POST[hours]' where project= '$_POST[project]'";
		if (!mysqli_query($mysqli,$sql))
	  	{
	  		die('Error: ' . mysqli_error($mysqli));
	  	}
		echo "1 record added";

	} else if ($_POST['button'] == 'Add to Log') {
	    $sql="UPDATE projects SET 
	    user =  concat(user,' $_POST[user]'),  
	    done =  concat(done,' $_POST[done]'), 
	    to_do = concat(to_do,' $_POST[to_do]'), 
	    hours_last_month = concat(hours_last_month,'$_POST[hours_last_month]'), 
	    hours = concat(hours,'$_POST[hours]') 
	    where project= '$_POST[project]'";
	    if (!mysqli_query($mysqli,$sql))
	  	{
	  		die('Error: ' . mysqli_error($mysqli));
	  	}
		echo "1 record added";
		$sql="UPDATE temp_projects SET user =  '',  done =  '', to_do = '', hours_last_month = '', hours = '' where project= '$_POST[project]'";
		if (!mysqli_query($mysqli,$sql))
	  	{
	  		die('Error: ' . mysqli_error($mysqli));
	  	}
		echo "1 record added";



	}
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'projectlist.php';
	//header("Location: http://$host$uri/$extra");
	//header( "Location: projectlist.php" );


?>