<?php
session_start();

function af(){
    require ("./modeles/affnonabo.php");
     if (is_string(execreq()) == true){
        $msg = execreq();
    }else{
        $stmt = execreq();
        $msg="";

    }
    
    require ("./vues/affnonabo.php");
}

function deco(){
    require ("./modeles/affnonabo.php");
    if (is_string(execreq()) == true){
        $msg = execreq();
    }else{
        $stmt = execreq();
        $msg="";
    }
    sesdeco();
    require ("./vues/affnonabo.php");
}

?>