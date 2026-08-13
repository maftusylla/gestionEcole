<?php
require_once dirname(__DIR__) . "/models/note.models.php";
require_once dirname(__DIR__) . "/models/moyenne.models.php";
require_once dirname(__DIR__) . "/models/anneescolaire.models.php";




function getTable(){

    $utilisateur = get_session("connexion");

    if(!$utilisateur){
        header("Location:http://localhost:8000/login");
        exit;
    }

    $classes = getAllTables('classes');
    $periodes = getAllTables('periodes');
    $anneeActive = getAnneeActive();

    $classe_id = $_POST['classe'] ?? null;
    $matiere_id = $_POST['matiere'] ?? null;
    $periode_id = $_POST['periode'] ?? null;

    $matieres = $classe_id ? getMatieresParClasse((int)$classe_id) : [];
    $moyenne = 0;
    $eleves = [];

     if($_SERVER['REQUEST_METHOD']=='POST') {
                if($classe_id && $matiere_id && $periode_id){
                    $moyenne=getMoyenneClasse( (int)$classe_id, (int)$matiere_id,  (int)$periode_id);
                    $eleves=getListeNotes( (int)$classe_id, (int)$matiere_id,  (int)$periode_id);
                }
     }
     require_once dirname(__DIR__) . "/views/note.html.php";



}