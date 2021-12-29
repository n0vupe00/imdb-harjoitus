<?php
    // Tietokantayhteys auki
    require_once('../db.php');

    // Lue title get.paremetri muuttujaan
    $title = $_GET['primary_title'];
    $con = createDbConnection();
    
    // SQL-lause, hakee valituun elokuvan näyttelijät ja heidän roolinsa elokuvassa
    $sql = "SELECT N.name_, H.role_
    FROM Titles AS T, Had_role AS H, Names_ AS N
    WHERE T.primary_title LIKE '%" . $title . "%'
    AND T.title_type LIKE 'movie'
    AND T.title_id = H.title_id
    AND H.name_id = N.name_id;";
    
    // Aja kysely kantaan
    $prepare = $con->prepare($sql);
    $prepare->execute();

    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();

    // Tulosta 
    $html = '<h2>' . $title . '</h2>';
    $html .= '<ul>';
    foreach($rows as $row) {
        $html .= '<li>' . $row['name_'] . ' --- ' . $row['role_'] . '</li>';
    }
    $html .= '</ul>';
    echo $html;