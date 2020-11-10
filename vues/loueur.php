<?php session_start()?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Services pour les loueurs</title>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <link rel="stylesheet" href="./vues/css/style.css">
</head>

<body>
<div class="container header-not-main" > 
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">        
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>  
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                <li class="nav-item mx-auto titrepc">
                    <span class="navbar-brand h1"> <a href="index.php">EasyRent</a> </span>
                </li>
                <li class="nav-item">
                    <?php
                        echo('<span class="navbar-brand h1"> Bonjour, ' . $_SESSION['nom'] . '</span>');
                    ?>            
                </li>
                <li class="nav-item">
                    <!-- Se deconnecter a coder -->
                    <form name="x" action="index.php?controle=affnonabo&action=deco" method="post">
                        <button type="submit" class="btn-link nav-link">Se Déconnecter</button>
                    </form>
                </li>
                </ul>
            </div>            
        </nav> 
    </div>
<h1> vehicule disponible ou en revision </h1>
<?php
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $t = json_decode($row['caract'],true);
    echo('<div class="row col-lg-4 col-sm-12 annonce">');
            //echo ('<span class="numAn">Annonce nº' . $row['id_vehicule'] . ' :</span></br>');
            echo ('Id de la voiture : ' . $row['id_vehicule']); echo('</br>');
            echo htmlspecialchars('Voiture : ' . $row['type']) ; echo('</br>');                         
            echo ('Moteur : ' . $t['moteur']); echo('</br>');
            echo ('Type de boite : ' . $t['boite']); echo('</br>');
            echo ('Nombre De Portes : ' . $t['nbPortes']); echo('</br>');
            echo ('Nombre de véhicule en stock : ' . $row['nb']); echo('</br>');
            echo htmlspecialchars('Etat  : ' . $row['location']);  echo('</br>');
            echo ('Prix (par jour de location) : ' . $row['prix']); echo('</br>');
            echo '<img class="annonce-img img-fluid" src="./vues/images/' . $row['photo'] .  '"/>'; echo('</br>');                
    echo('</div>');
endwhile;
?>

<h1> LOCATION ACTUELLEMENT EN COURS  : </h1>

<?php

//ajoute des trucs a afficher stv vu que cest ladministrateur du site 
  while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) :
 
    if (in_array($row2['nom'],$tab) == false){
       array_push($tab,$row2['nom']);
       echo ('<h1> Nom Locataire : ' . $row2['nom'] . '</h1>' ); echo('</br>');
    }
    
    echo ('Id de la voiture : ' . $row2['id_vehicule']); echo('</br>');
    echo ('Type du véhicule loué : ' . $row2['type']); echo('</br>');
    echo ('Date de début de location : ' . $row2['dateD']); echo('</br>');
    echo ('Date de fin de location : ' . $row2['dateF']); echo('</br>');
    echo '<img class="annonce-img img-fluid" src="./vues/images/' . $row2['photo'] .  '"/>'; echo('</br>');
  
  endwhile;


?>

<h1> LOCATION A VENIR  : </h1>
<?php
while($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) :
 
 if (in_array($row4['nom'],$tab2) == false){
    array_push($tab2,$row4['nom']);
    echo ('<h1> Nom Locataire : ' . $row4['nom'] . '</h1>' ); echo('</br>');
 }
 
 echo ('Id de la voiture : ' . $row4['id_vehicule']); echo('</br>');
 echo ('Type du véhicule loué : ' . $row4['type']); echo('</br>');
 echo ('Date de début de location : ' . $row4['dateD']); echo('</br>');
 echo ('Date de fin de location : ' . $row4['dateF']); echo('</br>');
 echo '<img class="annonce-img img-fluid" src="./vues/images/' . $row4['photo'] .  '"/>'; echo('</br>');

endwhile;
?>

<form method="POST" action="index.php?controle=loueur&action=inserervehi">
<input type="submit" value="Insérer un nouveau véhicule">
</form>

<br>

<form method="POST" action="index.php?controle=loueur&action=supprimervoit" >

        Entrez l'id du véhicule que vous souhaitez supprimer :    <br/>
		<input 	name="supp" 	type="text" 
				value= " " />			 
		<br/><br/>

<input type="submit" name ="submit" value="Supprimer ce véhicule">


<h1> FACTURE POUR CHAQUE ENTREPRISE </h1>

<?php while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) :
echo('Nom Entreprise : '. $row3['nom']);echo('</br>');
echo(' Montant totale de sa facture : '. $row3['montant'] . ' euros.');echo('</br>');
endwhile;
?>


</body>
</html>