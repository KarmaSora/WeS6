<?php
/**
 * Instans av klassen skapar en koppling till databasen egytalk
 * och tillhandahåller ett antal metoder för att hämta och manipulera
 * data i databasen.
 *
 */
class DbEgyTalk {
/**
 * Används i metoder genom $this->db</code>
 */
private $db;
/**
 * DbEgyTalk constructor.
 *
 * Skapar en koppling till databaseb egytalk
 */
public function __construct(){
// Definierar konstanter med användarinformation.
    define('DB_USER', 'egytalk');
    define('DB_PASSWORD', '12345');
    define('DB_HOST', 'mariadb');
    define('DB_NAME', 'egytalk');
    // Skapar en anslutning till MySql och databasen world
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
    $this->db = new PDO($dsn, DB_USER, DB_PASSWORD);
}
/**
 * Kontrollerar av användare och lösen.
 * Skapar global sessions-array med användarinformation.
 *
 * @param $userName Användarnamn
 * @param $passWord Lösenord
 * @return $response användardata eller tom []
 */
function auth($userName, $passWord) {
    $userName = trim(filter_var($userName, FILTER_UNSAFE_RAW));
    $response = [];
    /* Bygger upp sql frågan */
    $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :user");
    $stmt->bindValue(":user", $userName);
    $stmt->execute();

    /** Kontroll att resultat finns */
    if ($stmt->rowCount() == 1) {
        // Hämtar användaren, kan endast vara 1 person
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Kontrollerar lösenordet, och allt ok.
        if (password_verify($passWord, $user['password'])) {
            $response['uid'] = $user['uid'];
            $response['username'] = $user['username'];
            $response['firstname'] = $user['firstname'];
            $response['surname'] = $user['surname'];
        }
    }
    return $response;
}

    function getUserFromUid($uid){

        $stmt = $this->db->prepare("SELECT username, uid FROM user WHERE uid = :uid");
        $stmt->bindValue(":uid", $uid);
        $stmt->execute();
    
        /** Kontroll att resultat finns */
        if ($stmt->rowCount() == 1) {
            // Hämtar användaren, kan endast vara 1 person
            $response = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $response ;
    }

}
