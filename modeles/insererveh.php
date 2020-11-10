<?php


function insveh(){
    $nbvehstock=  isset($_POST['nvs'])?($_POST['nvs']):'';
    $type=  isset($_POST['type'])?($_POST['type']):'';
    $moteur=  isset($_POST['moteur'])?($_POST['moteur']):'';
    $typedeb=  isset($_POST['boite'])?($_POST['boite']):'';
    $nbdeporte=  isset($_POST['ndp'])?($_POST['ndp']):'';
    $etat=  isset($_POST['disponible'])?($_POST['disponible']):'';
    $prix=  isset($_POST['prix'])?($_POST['prix']):'';
    $msg = '';
  

    if(isset($_POST['submit'])  && isset($_FILES['image'])){
        $uploaddir = './vues/images/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if (in_array(strtolower($ext),array('jpg','png','jpeg'))){       
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
                $s = array('moteur'=> trim($moteur) , 'boite'=> trim($typedeb) , 'nbPortes' =>trim($nbdeporte));
                newvoit(trim($nbvehstock),trim($type),json_encode($s),trim($etat),$_FILES['image']['name'],trim($prix));
                $delai = 0;
                $url = 'index.php?controle=loueur&action=pageloueur';
                header("Refresh: $delai;url=$url");
            } 
            else {
                $msg = "Il y'a un problème au niveau de l'extension de l'image";
                $delai = 0;
                $url = 'index.php?controle=loueur&action=pageloueur';
                header("Refresh: $delai;url=$url");
            }
    }

}

function newvoit($nb,$type,$caract,$etat,$nomimage,$prix){
    require('./connect.php');
    $sql="INSERT INTO vehicule (nb,type,caract,location,photo,prix) VALUES (:nb,:type,:caract,:etat,:nomimage,:prix)";
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':nb', $nb, PDO::PARAM_INT);
		$commande->bindParam(':type', $type, PDO::PARAM_INT);
		$commande->bindParam(':caract', $caract, PDO::PARAM_STR);
        $commande->bindParam(':etat', $etat, PDO::PARAM_STR);
        $commande->bindParam(':nomimage', $nomimage, PDO::PARAM_INT);
        $commande->bindParam(':prix', $prix, PDO::PARAM_STR);
		$commande->execute();		
		return true;
	}
		catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	
	}
}

function deleteveh(){
    require('./connect.php');
    $req = "SELECT * FROM vehicule";
    try {
    $stmt = $pdo->query($req);
    }
        catch (PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
        die(); // On arrête tout.      
        }

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
        if ($row['id_vehicule'] == $_POST['supp']) {
            $req2 ='DELETE FROM vehicule where id_vehicule =' .  $row['id_vehicule'] . ';';
            try {
            $stmt2 = $pdo->query($req2);
            }
                catch (PDOException $e) {
                echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
                die(); // On arrête tout.      
                }
        }
    endwhile;

    $delai = 0.5;
    $url = 'index.php?controle=loueur&action=pageloueur';
    header("Refresh: $delai;url=$url");

}


?>