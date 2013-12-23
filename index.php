<?php
	// require_once "google-api-php-client/src/Google_Client.php";
	// require_once "google-api-php-client/src/contrib/Google_PlusService.php";
	// $client = new Google_Client();
	// $plus = new Google_PlusService($client);
	// ////And then you need to authenticate the user using the OAuth flow, which you do by:
	// //// If a oauth token was stored in the session, use that- and otherwise go through the oauth dance
	// if (isset($_SESSION['token'])) {
	// 	$client->setAccessToken($_SESSION['token']);
	// } else {
	// //// In a real application this would be stored in a database, and not in the session!
	// 	$_SESSION['auth_token'] = $client->authenticate();
	// }
?>


<html>
	<head>
		<title>Blank Template</title>
		<link  href="plansite.css" rel="stylesheet" type="text/css" />
		<script>
			
			function showTimeSheet(id) {
			    var ele = document.getElementById(id);
			    if(ele.style.display == 'block')
			    	ele.style.display = 'none';
			     else
			     	ele.style.display = 'block';
			 }
		</script>
	</head>
	<body>
		
		<div id = "wrapper">
			<div id = "top_banner"></div>
			<div id = "content">
				This is a test for Prof. Kantor
				<p>View our notes <a href="KantorNotes.pdf">here</a>.</p>
				//login table
				<div id="googlelogin">
				Use Google to Login
				</div>

				<div id="rucaslogin">
				Use Rutgers CAS to Login
				</div>

				
				<form action = "authentication.php" method="POST" style="" >
	  			Username: <input type="text" name="user"><br>
	  			Password: <input type="password" name="password"><br>
	  			<!--Create User: <input type="checkbox" name="cu"><br>-->
	  			<input type="submit" value="Submit">
				</form>
				

				<a href="#" onclick="showTimeSheet('time');">Show Michael's Task Time Sheet</a>
				<div id="time" style="display:none" >
				<u>Task Time Sheet</u>
				<br>Research 1 hour
				<br>Layouts/Page Creation: 2.5hours
				<br>Authentication 2.5
				<br>Database 3
				<br>Tables 2
				<br>Other 3
				</div>


			</div>
		</div>

	</body>
</html>


