<?php
session_start();

function af(){
    require ("./modeles/affnonabo.php");
     if (is_string(execreq()) == true){
        $msg = execreq();
    }else{
        $stmt = execreq();
        $msg="";
        //test
    }
    
    require ("./vues/affnonabo.php");
}

function deco(){
    require ("./modeles/affnonabo.php");
    $stmt = execreq();
    sesdeco();
    require ("./vues/affnonabo.php");
}

?>