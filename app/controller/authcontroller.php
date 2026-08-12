<?php
require_once dirname(__DIR__) . "/models/utilisateurs.model.php";
function login(){

   if($_SERVER['REQUEST_METHOD']=='POST') {
                $email=$_POST['email'];
                $password=$_POST['password'];
            $result=getUtilisateurbyEmail($email);


            if(!empty($result) && $password== $result['password']){
                        set_session("connexion",[
                            'id' => $result['id'],
                            'nom' => $result['nom'],
                            'prenom' => $result['prenom'],
                            'email' => $result['email'],
                            'role' => $result['nomrole']
                        ]);
                        header("Location:http://localhost:8000/");
                        exit;
            }

            header("Location:http://localhost:8000");
            exit;

}
    require_once dirname(__DIR__) . "/views/connexion.html.php";

}

function logout(){
destroy_session();
header("Location:http://localhost:8000/login");
exit;
}