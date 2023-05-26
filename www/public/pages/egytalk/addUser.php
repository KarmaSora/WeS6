<?php    
if(isset($_POST['firstName'],$_POST['surName'],$_POST['userName'],$_POST['pwd'])){                
    include_once('../../inc/db.inc.php');    
    
    $fname = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
    $sname = filter_input(INPUT_POST, 'surName', FILTER_SANITIZE_SPECIAL_CHARS);
    $user = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS);
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    
    /* Bygger upp sql frågan */
    $stmt= $db->prepare("INSERT INTO user(uid, firstname, surname, username, password) VALUES(UUID(), :fn, :sn,:user,:pwd)");
    
    $stmt->bindValue(":fn", $fname);
    $stmt->bindValue(":sn", $sname);
    $stmt->bindValue(":user", $user);
    $stmt->bindValue(":pwd", $pwd);
    
    // Om INSERT gick bra! Om man användarnamn är upptaget fungerar inte insert
    try{
        $stmt->execute();
        header('Location: /addUserForm.html'); // Borde visa att allt gick bra!, sidan finns inte än, skickar användare till index sidan för tillfätllet
    }catch(Exception $e){
        header('Content-Type: text/html; charset=utf-8');
        echo "<p>Kunde inte lägga till användaren. Kontrollera användarnamnet</p>";
        echo "<a href = 'addUserForm.html'>Försök igen</a>";
    }
}
?>