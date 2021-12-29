<?php


    // Funktio joka luo region-pudotusvalikon
    function createRegionDropDown() {
        require_once('db.php');
        // Tietokantayhteys
        $con = createDbConnection();
        // SQL-lause
        $sql = "SELECT DISTINCT region FROM aliases;";
        $prepare = $con->prepare($sql);
        $prepare->execute();
        // Tallenna vastaus muuttujaan
        $rows = $prepare->fetchAll();
        $html = '<select name="region">';
        foreach($rows as $row) {
            $html .= '<option>' . $row['region'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    // Funktio joka luo genre-pudotusvalikon
    function createGenreDropDown() {
        require_once('db.php');
        $con = createDbConnection();
        // SQL-lause
        $sql = "SELECT DISTINCT genre FROM title_genres;";
        $prepare = $con->prepare($sql);
        $prepare->execute();
        // Tallenna vastaus muuttujaan
        $rows = $prepare->fetchAll();
        $html = '<select name="genre">';
        foreach($rows as $row) {
            $html .= '<option>' . $row['genre'] . '</option>';
        }
        $html .= '</select>';
        return $html;

    }

    // Funktio joka luo Year-pudotusvalikon
    function createYearDropDown() {
        require_once('db.php');
        $con = createDbConnection();
        // SQL-lause hakee kaikki vuodet, jolloin on tehty/julkaistu elokuvia/videoita
        $sql = "SELECT DISTINCT start_year FROM titles ORDER BY start_year;";
        $prepare = $con->prepare($sql);
        $prepare->execute();
        // Tallenna vastaus muuttujaan
        $rows = $prepare->fetchAll();
        $html = '<select name="start_year">';
        foreach($rows as $row) {
            $html .= '<option>' . $row['start_year'] . '</option>';
        }
        $html .= '</select>';
        return $html;

    }
    // Funktio joka luo dropdownin elokuville
    function createMovieDropDown() {
        require_once('db.php');
        $con = createDbConnection();
        // SQL-lause, hakee top10 arvostellut elokuvat, jotka ovat saaneet yli puoli miljoonaa ääntä
        $sql = "SELECT DISTINCT primary_title 
        FROM titles INNER JOIN title_ratings on titles.title_id = title_ratings.title_id 
        INNER JOIN title_genres on titles.title_id = title_genres.title_id
        WHERE num_votes > 500000 && title_type like 'movie'
        ORDER BY average_rating DESC 
        LIMIT 10;";
        $prepare = $con->prepare($sql);
        $prepare->execute();
        // Tallenna vastaus muuttujaan
        $rows = $prepare->fetchAll();
        $html = '<select name="primary_title">';
        foreach($rows as $row) {
            $html .= '<option>' . $row['primary_title'] . '</option>';
        }
        $html .= '</select>';
        return $html;

    }