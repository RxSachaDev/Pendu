<?php
    function getConnection() {
        try {
            $connection = new PDO('mysql:host=localhost;dbname=pendu', 'root', '');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
    }
    
?>