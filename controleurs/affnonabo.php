<?php
session_start();

function af(){
    require ("./modeles/affnonabo.php");
    $stmt = execreq();
    require ("./vues/affnonabo.php");
}

function deco(){
    require ("./modeles/affnonabo.php");
    $stmt = execreq();
    sesdeco();
    require ("./vues/affnonabo.php");
}

?>