<?php
    // Tietokantayhteys auki
    require_once('../db.php');

    // Lue genre get.paremetri muuttujaan
    $genre = $_GET['genre'];
    $con = createDbConnection();
    
    // SQL-lause
    $sql = "SELECT primary_title, average_rating, num_votes 
    FROM titles INNER JOIN title_ratings on titles.title_id = title_ratings.title_id 
    INNER JOIN title_genres on titles.title_id = title_genres.title_id
    WHERE num_votes > 10000 && genre like '%" . $genre . "%'
    ORDER BY average_rating DESC 
    LIMIT 10;";
    
    // Aja kysely kantaan
    $prepare = $con->prepare($sql);
    $prepare->execute();

    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();
    
    // Tulosta 
    $html = '<h2>' . $genre . '</h2>';
    $html .= '<ol>';
    foreach($rows as $row) {
        $html .= '<li>' . $row['primary_title'] . ' Rating: ' . $row['average_rating'] . '</li>';
    }
    $html .= '</ol>';
    echo $html;