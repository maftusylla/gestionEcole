<?php

function getMoyenneClasse(int $classeId, int $matiereId, int $periodeId):float{
$pdo=connexionDB();

    $sql="SELECT ROUND(COALESCE(AVG(moyenne_eleve),0),2) AS moyenne_general
FROM (
    SELECT inscription_id,
    ROUND(AVG((COALESCE(devoir1,0)+COALESCE(devoir2,0)+2*COALESCE(composition,0))/4),2) AS moyenne_eleve
    FROM evaluations ev
    INNER JOIN inscriptions i ON i.id = ev.inscription_id
    INNER JOIN anneeScolaires a ON a.id = i.annee_id
    WHERE
    i.classe_id = :classe_id
    AND ev.matiere_id = :matiere_id
    AND ev.periode_id = :periode_id
    AND a.actif = 1
    AND (devoir1 IS NOT NULL OR devoir2 IS NOT NULL OR composition IS NOT NULL)
    GROUP BY inscription_id
) sub;
";

$result=executeQuery($pdo,$sql,[
        'classe_id' => $classeId,
        'matiere_id' => $matiereId,
        'periode_id' => $periodeId,
],true);

$pdo=null;

return $result['moyenne_general'];
}