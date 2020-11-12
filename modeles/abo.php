<?php 
session_start();
function execreq1(){
    require ("./connect.php");

    $req = 'SELECT * FROM vehicule where location =' .$_SESSION['id'].';';
        try {
        $stmt = $pdo->query($req);
        return $stmt;
        }
    catch (PDOException $e) {
    echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die(); // On arrête tout.
    }
}
    

function execreq2(){
    require ("./connect.php");
        $req2 = 'SELECT dateD,dateF FROM facturation where ide =' .$_SESSION['id'].';';
        try {
            $stmt2 = $pdo->query($req2);
            }
        catch (PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
        die(); // On arrête tout.
        }   
return $stmt2;
}

function vehdispo(){
    require ("./connect.php");
    $s = "";
    $req3 = "SELECT id_vehicule,photo,type FROM vehicule where nb>0 and trim(Lower(location)) = 'disponible'";
        try {
        $stmt3 = $pdo->query($req3);
        }
    catch (PDOException $e) {
    echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die(); // On arrête tout.
    }
    $count = $stmt3->rowCount();

    if ($count == 0){
    $s = "Il n'y a pas de véhicule disponible";
    return $s;
    } else{
    return $stmt3;
    }
}



?>