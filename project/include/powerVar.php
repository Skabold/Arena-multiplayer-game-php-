<?php


$req = $bdd->prepare("SELECT * FROM hero WHERE FK_userId = ?");
$req->execute(array($_SESSION['id']));
$reqinfo = $req->fetch();

$_SESSION['weaponId'] = $reqinfo['weaponId'];
$_SESSION['shieldId'] = $reqinfo['shieldId'];
$_SESSION['armureId'] = $reqinfo['armureId'];
$_SESSION['talismanId'] = $reqinfo['talismanId'];

//current item level
$weaponLevel = $_SESSION['weaponId'];
$shieldLevel = $_SESSION['shieldId'];
$armureLevel = $_SESSION['armureId'];
$talismanLevel = $_SESSION['talismanId'];

//current item power
				// att,def,vie
$weaponPower= array(30 + 30*$weaponLevel, 0, 0);
$shieldPower =  array( 0 , 30 + 30*$shieldLevel , 0 );
$armurePower  = array( 0, 0 , 30 + 30*$armureLevel );
$talismanPower  = array( 10+10*$talismanLevel, 10+10*$talismanLevel , 10+10*$talismanLevel );

$totalPower = array($weaponPower['0'] + $talismanPower['0'], $shieldPower['1'] + $talismanPower['1'] , $armurePower['2'] + $talismanPower['2']);

//Next item price
$nextWeaponPrice = ($weaponLevel +1 ) * 15 ;
$nextShieldPrice = ($shieldLevel +1 ) * 15 ;
$nextArmurePrice = ($armureLevel +1 ) * 15 ;
$nextTalismanPrice = ($talismanLevel +1 ) * 15 ;



?>


