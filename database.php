<?php
    $dsn = 'mysql:host=localhost;dbname=SSD_DB';
    $username = 'phpuser';
    $password = 'dblog';


    /*
    
    
    $dsn = 'mysql:host=localhost;dbname=D00238707';
    $username = 'D00238707';
    $password = 'eaP0nwkP';
    
    
    */

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>