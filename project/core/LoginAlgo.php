<?php 
include '../include/bddconnect.php' ;
include '../include/header.php' ; 

?>





<?php



if(isset($_POST['login']))
{
    $usernamel = htmlspecialchars($_POST['usernamel']);
    $pswl = sha1($_POST['pswl']);
    if(!empty($usernamel) AND !empty($pswl))
    {
        $requser = $bdd->prepare("SELECT * FROM userinfo WHERE pseudo = ? AND password = ?");
        $requser->execute(array($usernamel, $pswl));
        $userexist = $requser->rowCount();
        
            
        if($userexist == 1)
        {
            //info sur l'utilisateur
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['userId'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
           
            
            //mon joueur existe, je chope des info sur l'or etc.
            $reqres = $bdd->prepare("SELECT * FROM rss WHERE FK_userId = ?");
            $reqres->execute(array($_SESSION['id']));
            $userres = $reqres->fetch();
            $_SESSION['gold'] = $userres['gold'];
            $_SESSION['stone'] = $userres['stone'];
            $_SESSION['diamond'] = $userres['diamond'];
            
             
            
            //je vérifie si le hero existe (on sait jamais)
            $reqher = $bdd->prepare("SELECT * FROM hero WHERE heroId = ?");
            $reqher ->execute(array($_SESSION['id']));
            $herExist = $reqher->rowCount();
            
            //si le hero existe
            if($herExist==1) {
            
                $userher = $reqher->fetch();
                $_SESSION['nom'] = $userher['nom'];
                $_SESSION['niveau'] = $userher['niveau'];
                $_SESSION['armureId'] = $userher['armureId'];
                $_SESSION['shieldId'] = $userher['shieldId'];
                $_SESSION['talismanId'] = $userher['talismanId'];
                $_SESSION['weaponId'] = $userher['weaponId'];
                $_SESSION['gid'] = $userher['FK_guildeId'];
              
                header("Location: MainMenu.php?id=".$_SESSION['id']);
                
                }
            
            
             //ne devrait pas être possible mais bon
             if($herExist>=2) {
                
                $erreur = "Erreur, 2 nains dans bdd, wut";
                echo $erreur;
                echo"<a href='Index.php'>back to log</a>";
                }
            
            if ($herExist==0) {
                
                //pas de hero
                $erreur="le jeu est casser";
                echo $erreur;
                echo"<a href='Index.php'>back to log</a>";
               
                
            }
           
            
            
        //login incorrect    
        }
        else
        {
            $erreur = "Username ou password incorrect !";
            
            echo $erreur;
            echo"<a href='Index.php'>back to log</a>";
        }
        
        
    }
    else
    {
     $erreur = "Veuillez remplir tout les champs";  
     echo $erreur;
     echo"<a href='Index.php'>back to log</a>";
        
    }
    
    
    
    
}
else
{
    $erreur = "rien ?";
    echo $erreur;
    echo"<a href='Index.php'>back to log</a>";
    //rien
    
}


include '../include/footer.php';

?>