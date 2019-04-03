<?php

function CreateMonster($attH,$defH,$vieH)
{
    
    $attM = rand( ($attH - ($attH*rand(1,20) /100) ), ($attH + ($attH*rand(1,10) /100) ));
   
    $defM = rand( ($defH - ($defH*rand(1,20) /100) ), ($defH + ($defH*rand(1,10) /100) ));

    $vieM = rand( ($vieH - ($vieH*rand(1,20) /100) ), ($vieH + ($vieH*rand(1,10) /100) ));

   $monsterStats = array($attM,$defM,$vieM);

    return $monsterStats ;



}


?>