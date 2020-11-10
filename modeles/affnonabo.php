<?php

function execreq(){
    require ("./connect.php");
    $s = "";
    $requete = "SELECT * FROM vehicule where location = 'disponible' OR location='en_revision'
    and nb>0;";

try {
    $stmt = $pdo->query($requete);
}
    catch (PDOException $e) {
    echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die(); // On arrête tout.
}
    $count = $stmt->rowCount();

    if ($count == 0){
    $s = "Aucun véhicule disponible pour le moment";
    }else{
        $s = $stmt;
    
    }
    return $s;
}

function sesdeco(){
    session_destroy();
}

?>