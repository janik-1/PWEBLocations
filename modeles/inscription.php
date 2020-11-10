
<?php

function postmodele(){
	$nom=  isset($_POST['nom'])?($_POST['nom']):'';
	$mdp=  isset($_POST['mdp'])?($_POST['mdp']):'';
	$email=  isset($_POST['email'])?($_POST['email']):'';
    $msg='';
	$type =  isset($_POST['type'])?($_POST['type']):'';
	


	if  (count($_POST)==0)
	    echo '<script type="text/javascript">alert("Veuillez remplir le formulaire")</script>';
    else{
		ajouterpersonne(trim($nom),trim($mdp),trim($email),trim($type));
		$delai = 2;
		$url = 'index.php?controle=connexion&action=connexion';
		header("Refresh: $delai;url=$url"); 
                
	}
	
	   /*  $profil = array();
		if (!verifidentite($nom, $num,$prenom,$role,$email)) {
			$msg ="Vos champs ne sont pas bien remplis ou il manque des champs à remplir";
			require ("../vues/nonabo.php") ;
		}
		else {
			if  (verif_ident($nom,$num,$profil)) {
				$msg ="L'utilisateur existe déjà au sein de la base"; 
				require ("../vues/nonabo.php") ;
			}
			else { 
				ajouterpersonne($nom,$mdp,$email);
				echo ("Bienvenue vous êtes nouveau inscrit"); 
			}
		} */
		
		
		//echo ('<pre>'); 
		//print_r($profil);
		//echo ('</pre>'); 
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

/* function verifidentite($nom, $num,$prenom,$role,$email) {
	
	if(strlen ( $num ) < 8 ){
		return false;
	}
	if(!ctype_alnum ($num)){
		return false;
	}
	if(strlen ( $nom ) > 20){
		return false;
	}
	if(strlen ( $num ) > 10 ){
		return false;
	}
	if(empty($nom)){
		return false;
	}
	if(empty($num)){
		return false;
	}
	if(empty($prenom)){
		return false;
	}
	if(empty($role)){
		return false;
	}
	if(empty($email)){
		return false;
	}
	return true;
} */
		
/* 	
function verif_ident($nom,$num, &$profil) {

	//connexion au serveur de BD -> voir fichier connect.php
	//requete select en BD  -> voir fin cours PDO -> requete paramétrée
		
	require ("connect.php");
	$sql="SELECT * FROM utilisateur  where nom=:nom and num=:num"; 
	
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':nom', $nom, PDO::PARAM_STR);
		$commande->bindParam(':num', $num, PDO::PARAM_INT);
		$commande->execute();
		
		//$commande->debugDumpParams(); //affiche la requete préparée
		//die ('RowCount ' . $commande->rowCount() . '<br/>');
		
		if ($commande->rowCount() > 0) {  //compte le nb d'enregistrement
			$profil = $commande->fetch(PDO::FETCH_ASSOC); //svg du profil
			return true;
		}
		else {
			return false;
		}
	}
	
	
	
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
	
//	return true; //ou false; suivant le cas
} */
?>


