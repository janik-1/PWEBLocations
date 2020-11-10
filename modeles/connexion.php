<?php
session_start();


function verif(){

    require ("./connect.php");

    $mail=  isset($_POST['mail'])?($_POST['mail']):'';
    $mdp=  isset($_POST['mdp'])?($_POST['mdp']):'';
    $type =  isset($_POST['type'])?($_POST['type']):'';
        

  
    $requete = "SELECT id_client,nom,email,mdp,type FROM client";

    try {
    $stmt = $pdo->query($requete);
    }
    catch (PDOException $e) {
    echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die(); // On arrête tout.
    }

    //azerty
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :  

        if ($row['mdp'] ==  sha1($mdp) and $row['email'] == trim($mail) and $row['type'] == $type ) :

            $_SESSION['nom'] = $row['nom'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['mdp'] = $row['mdp'];
            $_SESSION['id'] = $row['id_client'];
            
            if($type == "loue") : 
                $_SESSION["type"] = "Loueur";
                $delai = 0.5;
                $url = 'index.php?controle=loueur&action=pageloueur';
                header("Refresh: $delai;url=$url"); 
            endif;
            if($type == "EA") : 
                $_SESSION["type"] = "Entreprise abonnées";
                $delai = 0.5;
                $url = 'index.php?controle=abo&action=affAbo';
                header("Refresh: $delai;url=$url"); 
            endif;
            return true;
        endif;
        if ($row['mdp'] =!  sha1($mdp) or $row['email'] =! $mail) :
            session_destroy();
            return false;
        endif;
    endwhile;



}


?>