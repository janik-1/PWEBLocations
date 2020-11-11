<?php


function pageloueur(){
    require('./modeles/loueur.php');
    $tab = array(); 
    $stmt = affichervehdisloueur();
    $stmt2= affiloueur();
    $stmt4=affilocationavenir(); 
    $stmt5 = calculmontantparvoiture();
    $facturationtotale = calculentretotale();
    $nbdefacturation = count($facturationtotale);  

    require('./vues/loueur.php');
}

function inserervehi(){
    require('./vues/formvehicule.php');
}

function inserermod(){
    require('./modeles/insererveh.php');
    insveh();

}
function supprimervoit(){
   require('./modeles/insererveh.php');
   deleteveh();
   
}
?>