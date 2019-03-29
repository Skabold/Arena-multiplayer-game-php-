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
		include '../include/powerVar.php';
			
		//buyHere
		if ($_SESSION['gold'] >= $nextShieldPrice)
		{
			$_SESSION['gold'] = $_SESSION['gold'] - $nextShieldPrice;
			//update gold :
			$upd = $bdd->prepare("UPDATE rss SET gold = ? WHERE FK_userId = ?");
			$upd->execute(array($_SESSION['gold'],$_SESSION['id']));

			//update shield Level :
			$upd2 = $bdd->prepare("UPDATE hero SET shieldId = ? WHERE FK_userId = ?");
			$shieldNextLevel = $shieldLevel + 1;
			$upd2->execute(array(($shieldNextLevel),$_SESSION['id']));
			header("Location: boutique.php?id=".$_SESSION['id']);

		}
		else
		{
			header("Location: boutique.php?id=".$_SESSION['id']);

		}




	}
	else
	{
		header("Location: disconnect.php?id=".$_SESSION['id']);

	}
}
?>

