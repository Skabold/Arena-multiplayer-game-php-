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
		include '../include/currentPower.php';
		?>
		<body>
			<div>
				<p>Bienveue dans la boutique : </p>

				<p>//menu boutique</p>
				<nav>
					<ul>
						<li><?php echo " Prix :".$nextWeaponPrice." | + 30 attaque" ;?></li>
						<li><?php echo"<a href='buyWeapon.php?id=".$_SESSION['id']."'> acheter une nouvelle arme </a>" ;?></li>

						<li><?php echo " Prix :".$nextArmurePrice." | + 30 vie" ;?></li>
						<li><?php echo"<a href='buyArmor.php?id=".$_SESSION['id']."'> acheter une nouvelle armure </a>" ;?></li>

						<li><?php echo " Prix :".$nextShieldPrice." | + 30 defence" ;?></li>
						<li><?php echo"<a href='buyShield.php?id=".$_SESSION['id']."'> acheter un nouveau bouclier </a>" ;?></li>

						<li><?php echo " Prix :".$nextTalismanPrice." | + 5 de tout | ACHAT AVEC DIAMANT !" ;?></li>
						<li><?php echo"<a href='buyTalisman.php?id=".$_SESSION['id']."'> acheter un nouveau talisman </a>" ;?></li>
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