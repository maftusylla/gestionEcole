<?php
require_once dirname(__DIR__) . "/models/note.models.php";
require_once dirname(__DIR__) . "/models/moyenne.models.php";
require_once dirname(__DIR__) . "/models/anneescolaire.model.php";




function getTable(){


$utilisateur = get_session("connexion");

    if(!$utilisateur){
        header("Location:http://localhost:8000/login");
        exit;
    }

    $classes = getAllTables('classes');
    $matieres = getAllTables('matieres');
    $periodes = getAllTables('periodes');
    $annee=getAllTables('anneeScolaires');
    $anneeActive = getAnneeActive();



     if($_SERVER['REQUEST_METHOD']=='POST') {
                $classe_id=$_POST['classe'];
                $matiere_id=$_POST['matiere'];
                $periode_id=$_POST['periode'];



    $moyenne=getMoyenneClasse( (int)$classe_id, (int)$matiere_id,  (int)$periode_id);
   
        
     }
     require_once dirname(__DIR__) . "/views/note.html.php";



}

