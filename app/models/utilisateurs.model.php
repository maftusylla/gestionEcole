<?php

function getUtilisateurbyEmail(string $email):array{
$pdo=connexionDB();

$sql="SELECT u.*,r.nomRole from utilisateurs u
inner join roles r on u.role_id=r.id
 WHERE
email=:email ";

$result=executeQuery($pdo,$sql,
            [
            'email'=>$email
            ]
);

$pdo=null;
return $result;


}