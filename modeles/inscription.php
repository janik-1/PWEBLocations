
<?php

function postmodele(){
	$nom=  isset($_POST['nom'])?($_POST['nom']):'';
	$mdp=  isset($_POST['mdp'])?($_POST['mdp']):'';
	$email=  isset($_POST['email'])?($_POST['email']):'';
    $msg='';
	$type =  isset($_POST['type'])?($_POST['type']):'';

   		

	if  (count($_POST)==0){
		echo '<script type="text/javascript">alert("Veuillez remplir le formulaire")</script>';
	}
	if (!verifchamps($nom, $email,$mdp)){
		return false;
	}
    else{
		ajouterpersonne(trim($nom),trim($mdp),trim($email),trim($type));
		$delai = 1;
		$url = 'index.php?controle=connexion&action=connexion';
		header("Refresh: $delai;url=$url");        
		return true;        
	}
}

        

function ajouterpersonne($nom,$mdp,$email,$type) {
    require ("./connect.php");
    $mdp = sha1($mdp);
	$sql="INSERT INTO client (nom,email,mdp,type) VALUES (:nom, :email, :mdp,:type)"; 
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':nom', $nom, PDO::PARAM_STR);
		$commande->bindParam(':mdp', $mdp, PDO::PARAM_STR);
		$commande->bindParam(':email', $email, PDO::PARAM_STR);
		$commande->bindParam(':type', $type, PDO::PARAM_STR);
		$commande->execute();		
		return true;
	}
		catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	
	}
	
}

function valideMail($email) {
    return !preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email) ? FALSE : TRUE;
}

function verifchamps($nom, $email,$mdp) {
	if(strlen ( $mdp ) < 6 ){
		return false;
	}
	if(!ctype_alnum (trim($nom))){
		return false;
	}
	if(strlen ( $nom ) > 20){
		return false;
	}
	if(empty($nom)){
		return false;
	}
	if(empty($email)){
		return false;
	}
	if(empty($mdp)){
		return false;
	}
	if(!valideMail($email)){
		return false;
	}

	return true;
}
		
?>


