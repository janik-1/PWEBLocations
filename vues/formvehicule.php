<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Services pour les loueurs</title>
</head>

<body>
<h1> Insertion d'un véhicule </h1>
<form method="POST" action="index.php?controle=loueur&action=inserermod" enctype="multipart/form-data">

        Nombre de véhicule en stock    <br/>
		<input 	name="nvs" 	type="text" 
				value= " " />			 
		<br/><br/>
		Type	 <br/>
		<input 	name="type" 	type="text" 
				value= " " />             <br/><br/>
		Moteur	<br/>
		<input 	type="text" 	name="moteur"
				value= " " />             <br/><br/>
        Type de boite    <br/>
		<input 	name="boite" 	type="text" 
				value= " " />			 
		<br/><br/>
        Nombre de portes    <br/>
		<input 	name="ndp" 	type="text" 
				value= " " />			 
		<br/><br/>
        <input type="radio"  name="disponible" value="disponible"
        >Disponible
         <input type="radio"  name="disponible" value="en_revision"
        >En révision
         <br/><br/>
         Prix    <br/>
		<input 	name="prix" 	type="text" 
				value= " " />			 
		<br/><br/>
        Choisir une image pour la voiture :
        <input type="file"
                    id="image" name="image" 
                    accept="image/png, image/jpeg,image/jpg " >
       <br/><br/>
<input type="submit" name ="submit" value="Insérer un nouveau véhicule">







</body>
</html>