<?php
    // Tietokantayhteys auki
    require_once('../db.php');

    // Lue genre get.paremetri muuttujaan
    $genre = $_GET['genre'];
    $con = createDbConnection();
    
    // SQL-lause
    $sql = "SELECT `primary_title`
    FROM `titles` INNER JOIN title_genres ON titles.title_id = title_genres.title_id
    WHERE genre LIKE '%" . $genre . "%'
    LIMIT 10;";

    // Aja kysely kantaan
    $prepare = $con->prepare($sql);
    $prepare->execute();

    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();
    
    // Tulosta 
    $html = '<h2>' . $genre . '</h2>';
    $html .= '<ul>';
    foreach($rows as $row) {
        $html .= '<li>' . $row['primary_title'] . '</li>';
    }
    $html .= '</ul>';
    echo $html;