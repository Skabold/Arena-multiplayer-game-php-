<?php 
include '../include/bddconnect.php' ;

//si l'utilisateur clique sur le bouton
if(isset($_POST['register']))
{
    
    
    //si les champs ne sont pas vide
    if( !empty($_POST['usernamer']) AND !empty($_POST['pswr']) AND !empty($_POST['pswCr']) AND !empty($_POST['heror']) AND !empty($_POST['emailr']) )
    {
        $usernamer = htmlspecialchars($_POST['usernamer']);
        $emailr = htmlspecialchars($_POST['emailr']);
        $heror = htmlspecialchars($_POST['heror']);
        $pswr = sha1($_POST['pswr']);
        $pswCr = sha1($_POST['pswCr']);
        $usernamerlength = strlen($usernamer);
        
        if($usernamerlength <= 18) 
        {
            //on vérifie que le joueur n'existe pas
            $requsernamer = $bdd->prepare("SELECT * FROM userinfo WHERE pseudo = ?");
            $requsernamer ->execute(array($usernamer));
            $usernameExist = $requsernamer->rowCount();
            
            //on vérifie que le hero n'existe pas
            $reqher = $bdd->prepare("SELECT * FROM hero WHERE nom = ?");
            $reqher ->execute(array($heror));
            $herExist = $reqher->rowCount();
            
            if($usernameExist ==0 AND $herExist ==0)
            {
            
                if($pswr == $pswCr) 
                { 
                    //création variable inspensable pour commencer

                    //user
                    //var :
                    $admin = 0 ;
                    //creation :
                    $insertlog = $bdd->prepare("INSERT INTO userinfo(pseudo,password,email,admin) VALUES(?,?,?,?)");
                    $insertlog ->execute(array($usernamer,$pswr,$emailr,$admin));
                    //recupere l'userId
                    $requser = $bdd->prepare("SELECT * FROM userinfo WHERE pseudo = ? ");
                    $requser ->execute(array($usernamer));
                    $userInfo = $requser->fetch();
                    $userId = $userInfo['userId'];


                    //hero
                    //var :
                    $guildeId=0; //noGuilde
                    $level= 0;
                    $armureId = 0;
                    $shieldId = 0;
                    $talismanId = 0;
                    $weaponId = 0;

                    //crée le hero
                    $inserther = $bdd->prepare("INSERT INTO hero(nom,niveau,armureId,shieldId,talismanId,weaponId,FK_userId,FK_guildeId) VALUES(?,?,?,?,?,?,?,?)");
                    $inserther ->execute(array($heror,$level,$armureId,$shieldId,$talismanId,$weaponId,$userId,$guildeId)); 


                    //rss
                    $gold =0;
                    $stone=0;
                    $diamond=0;
                    
                    
          
                    //donne les ressources au hero
                    $insertres = $bdd->prepare("INSERT INTO rss(FK_userId,gold,stone,diamond) VALUES(?,?,?,?)");
                    $insertres ->execute(array($userId,$gold,$stone,$diamond));  
                    
                    
   
                    
                    $erreur = "Votre compte à bien été crée";
                    echo $erreur;
                    echo "<a href='Index.php'>Return</a>";
                    
                }
                else
                {
                    $erreur = "Les mots de passes ne correspondent pas !";
                    echo $erreur;
                   echo "<a href='Index.php'>Return</a>";

                }
                
                
            }
            else 
            {
                $erreur = "Username déjà utilisé ou family name déjà utilisé";
                echo $erreur;
                echo "<a href='Index.php'>Return</a>";

            }
                
            
        }
        else
        {
        $erreur = "Votre pseudo ne peut pas dépasser les 18 caractères !";
        echo $erreur;
        echo "<a href='Index.php'>Return</a>";

        }
    
    
    
       
    }
    else
    {
        $erreur = "Tout les champs doivent êtres compléter";
        echo $erreur;
       echo "<a href='Index.php'>Return</a>";

    }
     
}
else
 {
 $erreur = "Stop faire n'imp avec ta barre d'adresse poto";
 echo $erreur;
 echo "<a href='Index.php'>Return</a>";

 }
?>