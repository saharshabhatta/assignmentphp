<?php
//server name of the database
$servername ='mysql';
$username ='student';
$password ='student';
$databasename='ijdb';

$Connection = new PDO('mysql:dbname='. $databasename . ';host=' . $servername,$username,$password);
?>