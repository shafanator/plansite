<?php ?>
<html>
	<head>
		<title>Blank Template</title>
		<link  href="plansite.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		
		<div id = "wrapper">
		<div style="right:0px;"><a href="authCAS.php?logout=" >Log Out</a></div>
			<div id = "top_banner"></div>
			<div id = "content">
				<?php $user = $_COOKIE['user'];?>
				<br>
				
				Hello <?php echo $user; ?>, here are the projects you are working on.
				<?php 

				require_once("password.php");
				$mysqli = new mysqli("localhost", $username, $password, "plansite");

				if ($mysqli->connect_errno) {
					printf("Connect failed: %s\n", $mysqli->connect_error);
					exit();
				}
				$id = 0;
				if ($usertab = $mysqli->query("SELECT project from users where user =  '".$user."' "))
				{
					printf("</br>You are currently working on %d projects.<br>\n", $usertab->num_rows);
					echo "<br>\"Submit to Temp\" will save the temp information in the boxes. <br> \"Add to Log\" will add the text from the boxs to the log, no data will be removed from log.";
					while($userrow = $usertab->fetch_object()){
						

						if ($result = $mysqli->query("SELECT * FROM projects WHERE project =  '$userrow->project' AND user = '$user' order by PID desc limit 1")) 
						{
							
							while($row=$result->fetch_object()){
								
								echo "<br><h1>";
								
								echo $row->project;
								$tothours = 0;
								if($sum = $mysqli->query("SELECT user, project, SUM(hours) FROM projects WHERE project =  '$userrow->project' AND user = '$user' "))
								{
									
									while($sumrow = $sum->fetch_array()){
										$tothours = $sumrow['SUM(hours)'];
									}
									
								}
								

								//header row
								$table = "</h1><table><tr><td>User</td><td>Project</td><td>Completed</td><td>To Do</td><td>Hours</td><td>Total Project Hours</td></tr>";
								//permtable
								$table .= "<tr>
								<td>$row->user</td>
								<td>$row->project</td>
								<td>$row->done</td>
								<td>$row->to_do</td>
								<td>$row->hours</td>
								<td>$tothours</td></tr>";

								//temptable
								$temptab = $mysqli->query("SELECT * FROM temp_projects WHERE project =  '$userrow->project' AND user = '$user' ");
								
								while($temprow = $temptab -> fetch_object()){
								$table .= "<tr><form action = 'submit.php' method='POST' id = '$id'>
								<td><input type = 'hidden' name = 'user' value = '$temprow->user'>$temprow->user</td>
								<td><input type = 'hidden' name = 'project' value = '$temprow->project'>$temprow->project</td>
								<td><textarea form= '$id' name = 'done'>$temprow->done</textarea></td>
								<td><textarea form= '$id' name = 'to_do'>$temprow->to_do</textarea></td>
								<td><textarea form= '$id' name = 'hours'>$temprow->hours</textarea></td>
								<td></td>
								</tr></table><input form = '$id' type='submit' name = 'button' value='Submit to Temp'><input form = '$id' name = 'button' type='submit' value='Add to Log'></form>";
								}
								echo $table;
								$table ="";
								$id++;

							}
							/* free result set */
							$result->close();
						}
					}
				}
				//
				//add new project
				//add to user table
				//add to project table
				//add to temp table

				?>
				
			</div>
		</div>

	</body>
</html>

