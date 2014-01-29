<?php
include_once("./CAS-1.3.2/CAS.php");
phpCAS::client(CAS_VERSION_2_0,'test-cas.rutgers.edu',443,'');
// SSL!
phpCAS::setCasServerCACert("./cacert.pem");//this is relative to the cas client.php file

if (!phpCAS::isAuthenticated())
{
	phpCAS::set
phpCAS::forceAuthentication();
}else{
header("Location: test.php");
}
?>