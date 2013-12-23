<script>
			
			function encrypt() {

				location.reload(true);
				
			 }
</script>

				<form action = "encrypt.php" method="POST" style="" >
	  			Username: <input type="text" name="input" ><br>

	  			<!--Create User: <input type="checkbox" name="cu"><br>-->
	  			<input type="submit" value="Submit">
	  			<br>
	  			<?php 
	  				
	  					echo crypt($_POST['input']);
	  			?>
				</form>


				<form action = "encrypt.php" method="POST" style="" >
	  			<input type="text" name="key" ><br>
				<input type="text" name="crypt" ><br>
	  			<!--Create User: <input type="checkbox" name="cu"><br>-->
	  			<input type="submit" value="Submit">
	  			<br>
	  			<?php 
	  				
	  					echo crypt($_POST['key'], $_POST['crypt']);
	  			?>
				</form>