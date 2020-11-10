<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Services pour les abonnées</title>
</head>

<body>
<form method="POST" action="index.php?controle=abo&action=affDate">

<?php
foreach($caseco as $element)
{
   echo $element .' '.'<input type="date" name="datedebut[]" value=""/> '.  '<input type="date" name="datefin[]" value=""/> ';
   echo('<br/>'); 
}
?>


<input type="submit" value="Confirmer la location">
</body>
</html>