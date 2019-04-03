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
		include '../include/createMonster.php';
		?>
		<body>
			<div>
				<?php
					$MonsterStats = createMonster($totalPower[0],$totalPower[1],$totalPower[2]);
					echo "<br><br>";
					echo "Monster Stats : ".$MonsterStats[0]." | ".$MonsterStats[1]." | ".$MonsterStats[2]." <br>";




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