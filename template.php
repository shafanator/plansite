
<html>
	<head>
		<title>Blank Template</title>
		<link  href="plansite.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		
		<div id = "wrapper">
			<div id = "top_banner"></div>
			<div id = "content">
			<h1>Header</h1>
			<p>Content goes here</p>
			<?php
$hashed_password = '$1$RI8YyxFb$Gt6fZo3psPVpcjT7BQGvj0'; // let the salt be automatically generated

/* You should pass the entire results of crypt() as the salt for comparing a
   password, to avoid problems when different hashing algorithms are used. (As
   it says above, standard DES-based password hashing uses a 2-character salt,
   but MD5-based hashing uses 12.) */
if (crypt("aviv", $hashed_password) == $hashed_password) {
   echo "Password verified!";
}
?>
			</div>
		</div>

	</body>
</html>
