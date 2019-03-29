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
		if ($_SESSION['gold'] >= $nextTalismanPrice)
		{
			$_SESSION['gold'] = $_SESSION['gold'] - $nextTalismanPrice;
			//update gold :
			$upd = $bdd->prepare("UPDATE rss SET gold = ? WHERE FK_userId = ?");
			$upd->execute(array($_SESSION['gold'],$_SESSION['id']));

			//update talisman Level :
			$upd2 = $bdd->prepare("UPDATE hero SET talismanId = ? WHERE FK_userId = ?");
			$talismanNextLevel = $talismanLevel + 1;
			$upd2->execute(array(($talismanNextLevel),$_SESSION['id']));

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

