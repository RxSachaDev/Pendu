<?php
    try {
        $connection = new PDO('mysql:host=localhost;dbname=pendu', 'root', '');
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e){
        die ('Erreur :' . $e ->getMessage());
    }
    
?>