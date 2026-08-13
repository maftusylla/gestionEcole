<?php

function getAnneeActive():array{
$pdo=connexionDB();

$sql="SELECT * FROM anneescolaires WHERE actif=1";

$result=query($pdo,$sql,true);

$pdo=null;
return $result;
}