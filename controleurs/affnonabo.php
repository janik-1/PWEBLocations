<?php
session_start();

function af(){
    require ("./modeles/affnonabo.php");
    $count = execreq()->rowCount();

    if ($count == 0){
    $s = "Aucun véhicule disponible pour le moment.";
    }else{
        $stmt = execreq(); 
        $s =""; 
    }
    require ("./vues/affnonabo.php");
}

function deco(){
    require ("./modeles/affnonabo.php");
    $count = execreq()->rowCount();
    if ($count == 0){
        $s = "Aucun véhicule disponible pour le moment.";
        }else{
            $stmt = execreq(); 
            $s =""; 
        }
    sesdeco();
    
    require ("./vues/affnonabo.php");
}

?>