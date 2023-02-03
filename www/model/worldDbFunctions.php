<?php
/**
 * Anluter till databasen och returnerar ett PDO-objekt
 * @return PDO  Objektet som returneras
 */
function connectToDb(){
    // Definierar konstanter med användarinformation.
    define('DB_USER', 'world');
    define('DB_PASSWORD', '12345');
    define('DB_HOST', 'mariadb'); // mariadb om docker annars localhost
    define('DB_NAME', 'world');
    // Skapar en anslutning till MySql och databasen egytalk
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
    $db = new PDO($dsn, DB_USER, DB_PASSWORD);
    return $db;
}

/**
 * Hämtar alla status-uppdateringar i tabellen post
 *
 * @param $db PDO-objekt
 * @return array med alla status-uppdateringar
 */
function getAllCountries($db){
    $sqlkod = "SELECT Name, Population, Code FROM country ORDER BY Name";
    /* Kör frågan mot databasen egytalk och tabellen post */
    $stmt = $db->prepare($sqlkod);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getSpecifiedCountry($db, $name){
  



        $sqlkod = "SELECT Name, Population, Code FROM country WHERE Name Like $name% ORDER BY Name";
        /* Kör frågan mot databasen egytalk och tabellen post */
        $stmt = $db->prepare($sqlkod);

        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}
