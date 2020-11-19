<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'demo');
 
$link = mysqli_connect("localhost", "root","Harrypotter@1" , "db_crudtdd");
 
//Verifica a conexão.
if($link === false){
    die("Erro ao conectar. " . mysqli_connect_error());
}
?>