<?php
    // Tietokantayhteys auki
    require_once('../db.php');

    // Lue genre get.paremetri muuttujaan
    $year = $_GET['start_year'];
    $con = createDbConnection();
    
    // SQL-lause
    $sql = "SELECT DISTINCT `primary_title`
    FROM `titles` INNER JOIN title_genres ON titles.title_id = title_genres.title_id
    WHERE start_year LIKE '%" . $year . "%'
    LIMIT 10;";

    // Aja kysely kantaan
    $prepare = $con->prepare($sql);
    $prepare->execute();

    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();
    
    // Tulosta 
    $html = '<h2>' . $year . '</h2>';
    $html .= '<ul>';
    foreach($rows as $row) {
        $html .= '<li>' . $row['primary_title'] . '</li>';
    }
    $html .= '</ul>';
    echo $html;