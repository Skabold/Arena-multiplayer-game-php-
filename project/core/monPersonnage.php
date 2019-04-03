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
		include '../include/powerVar.php';
		?>
		<body>
			<div id='imageHero'>
				<img src='../image/exemple.jpg' alt='heroImg'>
			</div>
			<div id='heroStats'>
				<?php
				echo "<ul>";
					echo "<li> Item stats : Attaque  Vie  Défence </li>";
					echo "<li> Arme stats : ".$weaponPower[0]." ".$weaponPower[1]." ".$weaponPower[2]." </li>";
					echo "<li> Bouclier stats : ".$shieldPower[0]." ".$shieldPower[1]." ".$shieldPower[2]." </li>";
					echo "<li> Armure stats : ".$armurePower[0]." ".$armurePower[1]." ".$armurePower[2]." </li>";
					echo "<li> Talisman stats : ".$talismanPower[0]." ".$talismanPower[1]." ".$talismanPower[2]." </li>";
				echo "</ul>";




				?>
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