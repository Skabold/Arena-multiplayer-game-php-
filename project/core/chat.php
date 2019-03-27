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
			<?php 
			//chat code
			if(isset($_POST['message']) AND !empty($_POST['message']))    {
			    date_default_timezone_set ( "Europe/Paris");
			    $username = $_SESSION['id'];
			    $message  = htmlspecialchars($_POST['message']);
			    $time = date('H:i');
			    $insertmsg = $bdd->prepare('INSERT INTO chat(FK_userId,messageTEXT,timecode,FK_guildeId) VALUES(?,?,?,?)');
			    $insertmsg ->execute(array($username,$message,$time,0));
			    
			}
			//chat code    
			    
			?>
			   
			<form method="post" action="">
				<p><label> Say something :</label></p>
				<input type="text" name="message">
				<input type="submit" value="Send"> 
			</form>
		    
		    <!-- chat -->
		    <?php
		    //chat code suite
		    $allmsg = $bdd->query('SELECT * FROM chat WHERE FK_guildeId = 0 ORDER BY id DESC LIMIT 0, 12');
		    while($msg = $allmsg ->fetch())
		    {
		        
		        
		        //INTEGRATION SMILEY
		        $msg['messageText'] = str_replace(':mad:',  '<img src="../emojis/emo_angry.png">'      ,$msg['messageText']);
		        $msg['messageText'] = str_replace(':3',     '<img src="../emojis/emo_cat.png">'       ,$msg['messageText']);
		        $msg['messageText'] = str_replace(':cry:',  '<img src="../emojis/emo_cry.png">'       ,$msg['messageText']);
		        $msg['messageText'] = str_replace(':|',     '<img src="../emojis/emo_noreaction.png">',$msg['messageText']);
		        $msg['messageText'] = str_replace(':(',     '<img src="../emojis/emo_sad.png">'       ,$msg['messageText']);
		        $msg['messageText'] = str_replace(';)',     '<img src="../emojis/emo_wink.png">'      ,$msg['messageText']);
		        $msg['messageText'] = str_replace(':)',     '<img src="../emojis/emo_smile.png">'     ,$msg['messageText']);
		        //INTEGRATION SMILEY

		        //find user name
		        $requser = $bdd->prepare("SELECT * FROM hero WHERE FK_userId = ?");
		        $requser -> execute(array($msg['FK_userId']));
		        $userinfo = $requser->fetch();
		        $heroName = $userinfo['nom'];

		 	   ?>  
		    
		    
			    
			    <div id='chat'>
			    <b><?php echo $heroName . ": "; ?></b>    <?php  echo " " . $msg['messageText'] . " - " .$msg['timecode'] ?>
			    <br>

			    <?php
			}
		    ?>
		</body>
		<?php
		include '../include/inGameFooter.php';
	}
}
?>