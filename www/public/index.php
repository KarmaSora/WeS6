<h1>Webbservern fungerar!</h1>
<p><strong>Denna sida (index.php) skall bytas ut.</strong></p>

<?php
    // Testar att mariaDB fungerar
     $myPDO = new PDO('mysql:host=mariadb;port=3306;dbname=mysql', 'root', '12345');
     $result = $myPDO->query("SELECT * FROM db");
     foreach ($result as $row) {
        echo $row['Db'] . '<hr>';
     }

     phpinfo();
?>
