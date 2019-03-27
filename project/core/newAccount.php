<?php

include '../include/header.php' ; 

?>

<body>
	<div>
		<h2>Create an account :</h2>
	</div>    


	<div>
		<form method="POST" action="registerAlgo.php"required>

			<label for="usernamer">Username :</label>
			<input type="text" id="usernamer" name="usernamer" >
			<label for="pswr">Password :</label>
			<input type="password" id="pswr" name="pswr" required>
			<label for="pswCr">Password confirmation :</label>
			<input type="password" id="pswCr" name="pswCr" required>
			<label for="famr">Hero name :</label>
			<input type="text" id="heror" name="heror" required>
			<label for="emailr">email :</label>
			<input type="email" id="emailr" name="emailr" required>
			<input type="submit" value="REGISTER" name="register" id="register">
		</form>
	</div>


	<div>
		<a href="Index.php">Back to the login page </a>  
	</div>

</body>

<?php include '../include/footer.php'; ?> 