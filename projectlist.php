<?php ?>
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
				if ($usertab = $mysqli->query("SELECT project from projectlist where user =  '$user' "))
				{
					printf("</br>You are currently working on %d projects.<br>\n", $usertab->num_rows);
					echo "<br>\"Submit to Temp\" will save the temp information in the boxes. <br> \"Add to Log\" will add the text from the boxs to the log, no data will be removed from log.";
					echo "<br><a href='?show=all'>Show all</a>";
					if(isset($_GET['show'])){
						$show = "";
						echo "all";
					}
					else
						$show = "limit 1";

					while($userrow = $usertab->fetch_object()){
						

						if ($result = $mysqli->query("SELECT * FROM projects WHERE project =  '$userrow->project' AND user = '$user' order by PID desc $show")) 
						{
							
							while($row=$result->fetch_object()){
								
								echo "<br><h1>";
								
								echo $row->project;
								$tothours = 0;
								if($sum = $mysqli->query("SELECT user, project, hoursA, hoursB, hoursC, hoursD, hoursE FROM projects WHERE project =  '$userrow->project' AND user = '$user' "))
								{
									// echo "<br>entries: ";
									// echo $sum->num_rows;
									while($sumrow = $sum->fetch_object()){
										$tothours += $sumrow->hoursA +$sumrow->hoursB +$sumrow->hoursC +$sumrow->hoursD +$sumrow->hoursE;
									}
									
								}
								$lm = date('F',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));
								$tm = date('F');
								

								//header row
								$table = "</h1><table>
								<tr>
									<td>User</td>
									<td>Project</td>
									<td>Category</td>
									<td>Completed</td>
									<td>To Do</td>
									<td>Hours</td>
									<td>Month/<br>Total Project Hours</td>
								</tr>";
								//permtable
								$table .= "
								<tr>
									<td rowspan='5'>$row->user</td>
									<td rowspan='5'>$row->project</td>
									<td>WRITING</td>
									<td>$row->doneA</td>
									<td>$row->to_doA</td>
									<td>$row->hoursA</td>
									<td rowspan='5'>$lm<br><br>$tothours</td>
								</tr>
								<tr>
									<td>INTERVIEWING</td>
									<td>$row->doneB</td>
									<td>$row->to_doB</td>
									<td>$row->hoursB</td>
								</tr>
								<tr>
									<td>CODING</td>
									<td>$row->doneC</td>
									<td>$row->to_doC</td>
									<td>$row->hoursC</td>
								</tr>
								<tr>
									<td>MEETING</td>
									<td>$row->doneD</td>
									<td>$row->to_doD</td>
									<td>$row->hoursD</td>
								</tr>
								<tr>
									<td>ALL OTHER</td>
									<td>$row->doneE</td>
									<td>$row->to_doE</td>
									<td>$row->hoursE</td>
								</tr>

								";

								//temptable
								$temptab = $mysqli->query("SELECT * FROM temp_projects WHERE project =  '$userrow->project' AND user = '$user' ");
							
								$temprow = $temptab -> fetch_object();
								$table .= "
								<tr><form action = 'submit.php' method='POST' id = '$id'>
	<td rowspan='5'><input type = 'hidden' name = 'user' value = '$row->user'>$row->user</td>
	<td rowspan='5'><input type = 'hidden' name = 'project' value = '$row->project'>$row->project</td>
	<td>WRITING</td>
	<td><textarea form= '$id' name = 'doneA'>$temprow->doneA</textarea></td>
	<td><textarea form= '$id' name = 'to_doA'>$temprow->to_doA</textarea></td>
	<td><textarea form= '$id' name = 'hoursA'>$temprow->hoursA</textarea></td>
	<td rowspan='5'>$tm</td>
</tr>
<tr>
	<td>INTERVIEWING</td>
	<td><textarea form= '$id' name = 'doneB'>$temprow->doneB</textarea></td>
	<td><textarea form= '$id' name = 'to_doB'>$temprow->to_doB</textarea></td>
	<td><textarea form= '$id' name = 'hoursB'>$temprow->hoursB</textarea></td>
</tr>
<tr>
	<td>CODING</td>
	<td><textarea form= '$id' name = 'doneC'>$temprow->doneC</textarea></td>
	<td><textarea form= '$id' name = 'to_doC'>$temprow->to_doC</textarea></td>
	<td><textarea form= '$id' name = 'hoursC'>$temprow->hoursC</textarea></td>
</tr>
<tr>
	<td>MEETING</td>
	<td><textarea form= '$id' name = 'doneD'>$temprow->doneD</textarea></td>
	<td><textarea form= '$id' name = 'to_doD'>$temprow->to_doD</textarea></td>
	<td><textarea form= '$id' name = 'hoursD'>$temprow->hoursD</textarea></td>
</tr>
<tr>
	<td>ALL OTHER</td>
	<td><textarea form= '$id' name = 'doneE'>$temprow->doneE</textarea></td>
	<td><textarea form= '$id' name = 'to_doE'>$temprow->to_doE</textarea></td>
	<td><textarea form= '$id' name = 'hoursE'>$temprow->hoursE</textarea></td>
</tr>
								</table>
								<input style='width:100px;background-color:green' form = '$id' type='submit' name = 'button' value='SAVE'>
								<input style='background-color:red'form = '$id' name = 'button' type='submit' value='SUBMIT'>
								</form>";
								
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

