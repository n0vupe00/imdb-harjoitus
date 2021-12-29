<?php
    require_once('utilities.php');
    // Hakukriteerit
    $html = "<h2>Criteria</h2>";
    $html .= '<form action="GET">';
    // Alue-pudotusvalikko
    $html .= "<p> Choose Region </p>" . createRegionDropDown();
    // Genre-pudotusvalikko
    $html .= "<p> Choose Genre </p>" . createGenreDropDown();
    // Year- dropdown
    $html .= "<p> Choose Year </p>" . createYearDropDown();
    // Movie- dropdown
    $html .= "<p> Choose Movie </p>" . createMovieDropDown();
    // Looppaa tiedostot läpi datasets-hakemistosta
    $path = 'datasets';
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;

            $html .= '<div><input type="submit" value="' . basename($file, ".php") . '"formaction="' . $path . "/" . $file . '"></div>';
        }
        closedir($handle);
    }
    $html .= '</form>';
    // Luo painiko, joka lähettää lomakkeen käsiteltävänä olevalle tiedostolle

    echo $html;