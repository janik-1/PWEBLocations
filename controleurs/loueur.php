<?php


function pageloueur(){
    require('./modeles/loueur.php');
    $stmt = affichervehdisloueur();
    $stmt2= affiloueur();
    $stmt3 = calculentre();
    $stmt4=affilocationavenir();
    $tab = array();
    $tab2= array();

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