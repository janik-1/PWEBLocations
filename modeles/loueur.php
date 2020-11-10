<?php
date_default_timezone_set( 'Europe/Paris' );
function affichervehdisloueur(){
    require ("./connect.php");

    $req = "SELECT * FROM vehicule where location = 'disponible' OR location='en_revision'"; // on prend tout les vehicule du loueur 
        try {
        $stmt = $pdo->query($req);
        return $stmt;
        }
    catch (PDOException $e) {
    echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die(); // On arrête tout.
    }

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
        return $stmt;
        }
    catch (PDOException $e) {
    echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die(); // On arrête tout.
    }

  
}

function affilocationavenir(){
    require ("./connect.php");
 
      
  $sql = 'SELECT vehicule.id_vehicule,client.nom, vehicule.type,vehicule.photo,facturation.dateD,facturation.dateF 
  FROM client,vehicule,facturation 
  WHERE vehicule.id_vehicule = facturation.idv and facturation.ide = client.id_client 
  and DATEDIFF(facturation.dateD, DATE(NOW()))>0 ';
        try {
        $stmt = $pdo->query($sql);
        return $stmt;
        }
    catch (PDOException $e) {
    echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die(); // On arrête tout.
    }

  
}


function calculentre(){    
    require ("./connect.php");
    $req ='SELECT client.id_client, client.nom, Sum(facturation.valeur) AS montant FROM client LEFT JOIN facturation ON client.id_client = facturation.ide WHERE facturation.valeur != 0 GROUP BY client.id_client,client.nom';
    // Afficher pour le mois courant c'est a dire ce que l'entreprise doit à la fin du mois
    // date fin juska la fin du mois si 
    //EOMONTH(DATE(NOW()));  renvoie la fin de la date de ce mois 

    try {
    $stmt = $pdo->query($req);
    }
        catch (PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
        die(); // On arrête tout.      
        }

    return $stmt;
}