<?php
	require_once 'CAS-1.3.2/CAS.php';
	phpCAS::client(CAS_VERSION_2_0, "test-cas.rutgers.edu", 443, "");
	// SSL!
	phpCAS::setNoCasServerValidation();//this is relative to the cas client.php file
	//if (phpCAS::isAuthenticated())
	//{
	setcookie("user", "", -1);
    setcookie("group", "", -1);
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    
	phpCAS::logout();
	header("Location: http://$host$uri/$extra");
	//}
		

	//header('location: ./test.php');
	
?>