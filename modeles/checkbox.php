<?php
session_start();
date_default_timezone_set( 'Europe/Paris' );

function recuptype(){  // recupère les type des case coché pour les voiture.
    
    $id = $_POST['idveh'] ;
    $voitid = array();
    $voitype = array();
    foreach ($id as $valeur){ // valeurs cest les id des voiture 
        if(!empty($id)){
            require ("./connect.php");
            $req3 = "SELECT type,id_vehicule FROM vehicule where id_vehicule =". $valeur.";";
            try {
            $stmt3 = $pdo->query($req3);
            }
            catch (PDOException $e) {
            echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
            die(); // On arrête tout.      
            } 
            while($row= $stmt3->fetch(PDO::FETCH_ASSOC)) :                
                array_push($voitype,$row['type']);
                array_push($voitid,$row['id_vehicule']);
            endwhile;      
        }
    }
    $_SESSION['idvoit'] = $voitid;
    $_SESSION['voitype']  =   $voitype; // variable qui contient les id vehicules que le client souhaite louer 
    return $voitype;
}

function date1(){ // voiture id en parametre
    require ("./connect.php");
    $date3 = $_POST['datedebut'] ;
    $date4 = $_POST['datefin'] ;
    $count = count($_SESSION['idvoit']); 
    $s = "";

    for ($i = 0 ; $i<$count ; ++$i){     

        $req3 = "SELECT prix,nb,id_vehicule FROM vehicule where id_vehicule =". $_SESSION['idvoit'][$i] .";";
        try {
        $stmt3 = $pdo->query($req3);
        }
            catch (PDOException $e) {
            echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
            die(); // On arrête tout.      
            }
        if ($date4[$i] > $date3[$i]){
            while($row= $stmt3->fetch(PDO::FETCH_ASSOC)) :
                if  ($row['nb'] > 0){      
                    $msg = "N"; 
                    if ($date4[$i] == ""){
                        $date4[$i] =date('Y-m-d',strtotime('+1 month',strtotime(date('Y-m-d'))));
                    }
                    $nbjour= NbJours($date3[$i],$date4[$i]);
                    $prix = $row['prix']*$nbjour ; 
                    $nb =  $row['nb'] -1;        
                    ajouterfacturation($_SESSION['id'],$row['id_vehicule'],$date3[$i],$date4[$i],$prix,$msg);
                    updateloc ( $_SESSION['idvoit'][$i],$_SESSION['id'],$nb); 
                }
            endwhile;
            $delai = 0.5;
            $url = 'index.php?controle=abo&action=affAbo';
            header("Refresh: $delai;url=$url");
           
         }  
         elseif ($date4[$i] < $date3[$i]) {
             $s = "Impossible ! La date de fin commence avant la date de début.";
         }
        
     }
     return $s;
}

function ajouterfacturation($ide,$idv,$dateD,$dateF,$valeur,$etat) {
    require ("./connect.php");
    $sql="INSERT INTO facturation (ide,idv,dateD,dateF,valeur,etat) VALUES (:ide,:idv,:dateD,:dateF,:valeur,:etat)";
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':ide', $ide, PDO::PARAM_INT);
		$commande->bindParam(':idv', $idv, PDO::PARAM_INT);
		$commande->bindParam(':dateD', $dateD, PDO::PARAM_STR);
        $commande->bindParam(':dateF', $dateF, PDO::PARAM_STR);
        $commande->bindParam(':valeur', $valeur, PDO::PARAM_INT);
        $commande->bindParam(':etat', $etat, PDO::PARAM_STR);
		$commande->execute();		
		return true;
	}
		catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	
	}
	
}

function NbJours($debut, $fin) {

    $tDeb = explode("-", $debut);
    $tFin = explode("-", $fin);

    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) - 
            mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    
    return(($diff / 86400)+1);

  }

function updateloc ($idvoit,$ide,$nb){
    require ("./connect.php");
    $sql=" UPDATE vehicule SET location=:ide, nb =:nb WHERE id_vehicule=:idv";
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':ide', $ide, PDO::PARAM_INT);
        $commande->bindParam(':idv', $idvoit, PDO::PARAM_INT);
        $commande->bindParam(':nb', $nb, PDO::PARAM_INT);
		$commande->execute();		
		return true;
	}
		catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	
	}
   
}












?>