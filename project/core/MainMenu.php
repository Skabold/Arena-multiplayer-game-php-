<?php
include '../include/bddconnect.php';
if(isset($_GET['id']) AND $_GET['id'] > 0) 
{
	$getId=intval($_GET['id']);
	$requser = $bdd->prepare('SELECT * FROM userinfo WHERE id = ?');
	$requser->execute(array($getId));
	$userinfo = $requser->fetch();
	if($_GET['id'] == $_SESSION['id'])
	{
		include '../include/header.php'; //met les 2 pour le header mais 1 seul pour le footer
		include '../include/inGameHeader.php';
		?>
		<body>
			<div>
				<p>//menu d'action</p>
				<nav>
					<ul>
						<li><?php echo"<a href='combat.php?id=".$_SESSION['id']."'> combat </a>" ;?></li>
						<li><?php echo"<a href='monPersonnage.php?id=".$_SESSION['id']."'> mon personnage </a>" ;?></li>
						<li><?php echo"<a href='boutique.php?id=".$_SESSION['id']."'> Boutique </a>" ;?></li>
						<li><?php echo"<a href='chat.php?id=".$_SESSION['id']."'> chat </a>" ;?></li>
						<li><?php echo"<a href='guilde.php?id=".$_SESSION['id']."'>guilde </a>" ;?></li>
						<li><?php echo"<a href='truc.php?id=".$_SESSION['id']."'> nom lien </a>" ;?></li>
					</ul>
				</nav>
			</div>
		</body>
		<?php
		include '../include/inGameFooter.php';
	}
	else
	{
		header("Location: disconnect.php?id=".$_SESSION['id']);

	}
}
?>