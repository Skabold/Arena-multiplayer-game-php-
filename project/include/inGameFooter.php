
<footer>
	<div>
		<p>This is the inGameFooter @Maxime</p>
		<div id = inGameFooter>
			<nav>
				<ul>
					<?php echo"<li><a href='MainMenu.php?id=".$_SESSION['id']."'>Menu principale</a></li>";?>
					<?php echo"<li><a href='disconnect.php?id=".$_SESSION['id']."'>déconnexion</a></li>";?>

				</ul>
			</nav>
		</div>
	</div>
</footer>

</html>