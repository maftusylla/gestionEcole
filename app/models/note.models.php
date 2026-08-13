<?php

function getMatieresParClasse(int $classeId):array{
$pdo=connexionDB();

$sql="SELECT m.id, m.nomMatiere
FROM matiere_classes mc
INNER JOIN matieres m ON m.id = mc.matiere_id
WHERE mc.classe_id = :classe_id
ORDER BY m.nomMatiere;
";

$result=executeQuery($pdo,$sql,[
        'classe_id' => $classeId,
],false);

$pdo=null;
return $result;
}


function getListeNotes(int $classeId, int $matiereId, int $periodeId):array{
$pdo=connexionDB();

    $sql="SELECT e.id AS eleve_id, e.nom, e.prenom, e.matricule,
       COALESCE(ev.devoir1,0) AS devoir1,
       COALESCE(ev.devoir2,0) AS devoir2,
       COALESCE(ev.composition,0) AS composition,
       ROUND((COALESCE(ev.devoir1,0)+COALESCE(ev.devoir2,0)+2*COALESCE(ev.composition,0))/4,2) AS moyenne
FROM inscriptions i
INNER JOIN eleves e ON e.id = i.eleve_id
INNER JOIN anneeScolaires a ON a.id = i.annee_id
LEFT JOIN evaluations ev ON ev.inscription_id = i.id
    AND ev.matiere_id = :matiere_id
    AND ev.periode_id = :periode_id
WHERE i.classe_id = :classe_id
AND a.actif = 1
ORDER BY e.nom, e.prenom;
";

$result=executeQuery($pdo,$sql,[
        'classe_id' => $classeId,
        'matiere_id' => $matiereId,
        'periode_id' => $periodeId,
],false);

$pdo=null;
return $result;
}