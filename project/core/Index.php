<?php

include '../include/header.php' ; 

?>


<body>
	<div>
		<h1><u>FatalWeaponOfTheDeathThatKill</u></h1>
		<h2>sub text</h2>
		<br>
		<h3>Sign in :</h3>
		<br>
	</div>


	<div id="loginForm"> 
		<form method="POST" action="loginAlgo.php"> 
			<label for="usernamel">Username :</label>
			<input type="text" id="usernamel" name="usernamel" required>
			<label for="pswl">Password :</label>
			<input type="password" id="pswl" name="pswl" required>
			<input type="submit" value="LOGIN" name="login">
		</form>
	</div>


	<div id='newAccount'>
		<a href="newAccount.php">Or create an new account </a>  
	</div>

</body>
<?php include '../include/footer.php';?>