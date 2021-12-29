<?php
    // Tietokantayhteys auki
    require_once('../db.php');
    
    $con = createDbConnection();
    
    // SQL-lause (view1-näkymä luotu tietokantaan, luontilause löytyy view.sql)
    $sql = "SELECT * FROM view1;";
    
    // Aja kysely kantaan
    $prepare = $con->prepare($sql);
    $prepare->execute();

    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();

    // Tulosta 
    $html = '<h2>Number of films each year</h2>';
    $html .= '<p>Year --- Amount</p>';
    $html .= '<ul>';
    foreach($rows as $row) {
        $html .= '<li>' . $row['Year'] . ' --- ' . $row['Number_of_movies'] . '</li>';
    }
    $html .= '</ul>';
    echo $html;