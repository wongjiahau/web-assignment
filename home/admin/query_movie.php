<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require($_SERVER['DOCUMENT_ROOT'] . "/home/util/send_query.php");
require($_SERVER['DOCUMENT_ROOT'] . "/src/MovieItem.php");

if (isset($_POST['searchWord'])) {
    $LIMIT = 10;
    $searchWord = $_POST['searchWord'];
    $selectedGenre = $_POST['selectedGenre'];
    $selectedYear = $_POST['selectedYear'];
    $startIndex = $_POST['startIndex'];
    $endIndex = $startIndex + $LIMIT - 1;
    $query = <<<QUERY
    select * from video 
    where title like '%$searchWord%'
    and genre like '%$selectedGenre%'
    and year like '%$selectedYear%'
    limit $startIndex, $endIndex
    ;
QUERY;
    $result = send_query($query . ";");
    $LIMIT = 10;
    for ($i = 0; $i < $LIMIT && $i < count($result); $i++) {
        $movie = new MovieItem($result[$i]);
        $movie->render();
    }
    if (count($result) == 0) {
        echo "No result found.";
    }
    exit;
}

if (isset($_POST['renderGenre'])) {
    $result = send_query("select distinct genre from video;");
    $genres = array();
    foreach ($result as $val) {
        $genres = array_merge($genres, explode(",", $val['genre']));
    }
    $genres = (array_unique(array_map("trim", $genres)));
    $genres = array_values(array_filter($genres));
    sort($genres);
    $html = "";
    foreach ($genres as $g) {
        $html .= "<option value='$g'>$g</option>";
    }
    $html = "<option value=''>Any</option>" . $html;
    $html = "<select id='genreList' multiple>" . $html . "</select>";
    echo $html;
    exit;
}

if (isset($_POST['renderYear'])) {
    $result = send_query("select distinct year from video;");
    $years = array();
    foreach ($result as $val) {
        array_push($years, $val['year']);
    }
    sort($years);
    $html = "";
    foreach ($years as $y) {
        $html = "<option value='$y'>$y</option>" . $html;
    }
    $html .= "<option value=''>Any</option>";
    $html = "<select id='yearList'>" . $html . "</select>";
    echo $html;
    exit;
}
?>