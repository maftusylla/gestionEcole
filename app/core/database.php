<?php

function connexionDB():PDO{

try {
    $pdo = new PDO(
        "pgsql:host=localhost;dbname=alam;port=5432",
        "postgres",
        "PASSWORD"
    );

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch ( Exception $ex) {
    die('Erreur:'.$ex->getMessage());
}




}


function query(PDO $pdo,string $sql, bool $single = true):array{
     $query = $pdo->query($sql);
     $resultat = $single ? $query->fetch():$query->fetchAll();
    return $resultat === false ? [] : $resultat;
    

}

function prepare(PDO $pdo,string $sql, array $datas) {
    $prepare = $pdo->prepare($sql);
    $prepare->execute($datas);
    return $prepare;
}

function executeQuery(PDO $pdo,string $sql, array $datas, bool $single = true) : array {
    $statement = prepare($pdo, $sql,  $datas);

    $resultat = $single ? $statement->fetch():$statement->fetchAll();
    return $resultat === false ? [] : $resultat;
}

function executeUpdate(PDO $pdo, string $sql, array $datas) : int {
    $statement = prepare($pdo, $sql,  $datas);

    if (str_starts_with(strtoupper($sql), 'INSERT')) {
        $id = $pdo->lastInsertId();
        return $id;
    }

    $rowCount = $statement->rowCount();
    return $rowCount;
}



function getAllTables(string $tableName):array{
$pdo=connexionDB();

$sql="SELECT * FROM $tableName";

$result=query($pdo,$sql,false);
$pdo=null;
return $result;
}

