<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Date de location</title>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <link rel="stylesheet" href="./vues/css/style.css">
</head>

<body class="bg3">
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
                      <form name="x" action="index.php?controle=abo&action=affabo" method="post">
                        <button type="submit" class="btn-link nav-link">Mon Compte</button>
                      </form>          
                    </li>
                    <li class="nav-item">
                        <form name="x" action="index.php?controle=affnonabo&action=deco" method="post">
                            <button type="submit" class="btn-link nav-link">Se Déconnecter</button>
                        </form>
                    </li>
                </ul>
            </div>            
        </nav> 
  </div>

  <div class="text-center">
    <h4>
      Quand voulez vous louez ?
    </h4>
      <form method="POST" action="index.php?controle=abo&action=affDate">

      <?php
      foreach($caseco as $element)
      {
        echo $element .' '.'<input type="date" name="datedebut[]" value=""/> '.  '<input type="date" name="datefin[]" value=""/> ';
        echo('<br/>'); 
      }
      ?> <br>
      <input type="submit" value="Confirmer la location">

      <?php echo('</br>');echo($msg); ?>
  </div>



</body>
</html>     