<?php 

function affAbo(){
    require ("./modeles/abo.php");
    $s = execreq1();
    $a = execreq2();
  
   if (is_string(vehdispo()) ==true){
       $msg = vehdispo();
       $stmt3= NULL;
   }else {
       $stmt3 =vehdispo();
       $msg = "";
   }
    
    require ("./vues/abo.php");
 
}


function affDateLouer(){
    require ("./modeles/checkbox.php");
    $caseco= recuptype();
    $msg="";
    require ("./vues/DateLouer.php");
}

function affDate(){
    require ("./modeles/checkbox.php"); 
    $msg = date1();  
    $msg2 = "Impossible ! La date de fin commence avant la date de début.";
    if ($msg == $msg2) {      
        $caseco= $_SESSION['voitype'];     
        require ("./vues/DateLouer.php");
    }
    }





?>