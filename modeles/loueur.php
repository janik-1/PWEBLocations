<?php
date_default_timezone_set( 'Europe/Paris' );

function affichervehdisloueur(){
    require ("./connect.php");

    $req = "SELECT * FROM vehicule where location = 'disponible' OR location='en_revision'"; // on prend tout les vehicule du loueur 
        try {
        $stmt = $pdo->query($req);
        }
        catch (PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
        die(); // On arrête tout.
        }
    return $stmt;
}

function affiloueur(){
    require ("./connect.php");
 
        $sql = 'SELECT vehicule.id_vehicule,client.nom, vehicule.type,vehicule.photo,facturation.dateD,facturation.dateF 
        FROM client,vehicule,facturation 
        WHERE vehicule.id_vehicule = facturation.idv and facturation.ide = client.id_client 
        and DATEDIFF(facturation.dateD, DATE(NOW()))<0 
        and DATEDIFF(facturation.dateF, DATE(NOW()))>0';

            try {
            $stmt = $pdo->query($sql);
            }

        catch (PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
        die(); // On arrête tout.
        }
    return $stmt;
}

function affilocationavenir(){
    require ("./connect.php");
    
  $sql = 'SELECT vehicule.id_vehicule,client.nom, vehicule.type,vehicule.photo,facturation.dateD,facturation.dateF 
  FROM client,vehicule,facturation 
  WHERE vehicule.id_vehicule = facturation.idv and facturation.ide = client.id_client 
  and DATEDIFF(facturation.dateD, DATE(NOW()))>0 ';
        try {
        $stmt = $pdo->query($sql);
        
        }
    catch (PDOException $e) {
    echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die(); // On arrête tout.
    }
    return $stmt;
  
}


function calculentretotale(){    
    require ("./connect.php");
    $montantot = array();

    $req2 = 'SELECT Sum(facturation.valeur) 
    AS montant , count(vehicule.id_vehicule) as nbdevoituredanslaflotte 
    ,client.id_client, client.nom,vehicule.type
    FROM client 
    LEFT JOIN facturation ON client.id_client = facturation.ide 
    LEFT JOIN vehicule ON vehicule.id_vehicule = facturation.idv 
    WHERE facturation.valeur != 0 
    GROUP BY client.id_client,client.nom';

    try {
    $stmt2 = $pdo->query($req2);
    }
        catch (PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
        die(); // On arrête tout.      
        }


     while($row = $stmt2->fetch(PDO::FETCH_ASSOC)) :
        if ($row['nbdevoituredanslaflotte'] > 10){
            $row['montant'] = $row['montant'] - ($row['montant'] * 0.1);
            $s = $row['montant'] . ' euros pour l entreprise ' .$row['nom']. ' avec une réduction
            de 10%.' ;
            array_push($montantot,$s);
        }
        else{
            $s = $row['montant'] . ' euros pour l entreprise ' .$row['nom'];
            array_push($montantot,$s);
        }
    endwhile;


return $montantot;
}

function calculmontantparvoiture(){    
    require ("./connect.php");

    $req ='SELECT client.id_client, client.nom,vehicule.type,facturation.valeur AS montantparvoiture 
    FROM client 
    LEFT JOIN facturation ON client.id_client = facturation.ide 
    LEFT JOIN vehicule ON vehicule.id_vehicule = facturation.idv 
    WHERE facturation.valeur != 0 
    GROUP BY client.id_client , client.nom, montantparvoiture'; 
    try {
    $stmt = $pdo->query($req);
    }
        catch (PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
        die(); // On arrête tout.      
        }
    return $stmt;
}