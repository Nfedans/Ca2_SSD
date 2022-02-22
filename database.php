<?php
    $dsn = 'mysql:host=localhost;dbname=SSD_DB';
    $username = 'phpuser';
    $password = 'dblog';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>