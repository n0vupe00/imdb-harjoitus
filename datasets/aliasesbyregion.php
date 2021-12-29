<?php
    // Tietokantayhteys auki
    require_once('../db.php');

    // Lue region get.parametri muuttujaan
    $region = $_GET['region'];
    $con = createDbConnection();
    
    // SQL-lause (Call- proseduuri samanlainen kuin tunneilla tehty, löytyy view.php)
    $sql = "CALL GetAliasesByRegion('" . $region . "');";
     
    // Aja kysely kantaan
    $prepare = $con->prepare($sql);
    $prepare->execute();

    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();

    // Tulosta 
    $html = '<h2> Aliases by region ' . $region . '</h2>';
    $html .= '<ul>';
    foreach($rows as $row) {
        $html .= '<li>' . $row['title'] . '</li>';
    }
    $html .= '</ul>';
    echo $html;