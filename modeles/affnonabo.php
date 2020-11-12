<?php

function execreq(){
    require ("./connect.php");

    $requete = "SELECT * FROM vehicule where (trim(lower(location)) = 'disponible' OR location='en_revision')
    and nb>0;";

try {
    $stmt = $pdo->query($requete);
}
    catch (PDOException $e) {
    echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die(); // On arrête tout.
}
    
    return $stmt;
}

function sesdeco(){
    session_destroy();
}

?>