<?php
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
Properties of $movie:
- video_id
- title
- year
- genre
- img_path
- synopsis
 */
require($_SERVER['DOCUMENT_ROOT'] . "/home/util/send_query.php");

if (isset($_POST['searchWord'])) {
    $LIMIT = 10;
    $searchWord = $_POST['searchWord'];
    $selectedGenre = $_POST['selectedGenre'];
    $selectedYear = $_POST['selectedYear'];
    $query = <<<QUERY
    select * from video 
    where title like '%$searchWord%'
    and genre like '%$selectedGenre%'
    and year like '%$selectedYear%'
    limit $LIMIT
    ;
QUERY;
    $result = send_query($query . ";");
    $LIMIT = 10;
    for ($i = 0; $i < $LIMIT && $i < count($result); $i++) {
        render_movie_item($result[$i]);
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
    $html = "<option value=''>Any</option>".$html;
    $html = "<select id='genreList'>" . $html . "</select>";
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
        $html = "<option value='$y'>$y</option>".$html;
    }
    $html .= "<option value=''>Any</option>";
    $html = "<select id='yearList'>" . $html . "</select>";
    echo $html;
    exit;
}


function render_movie_item($movie)
{
    $id = $movie['video_id'];
    $title = $movie['title'];
    $year = $movie['year'];
    $genre = $movie['genre'];
    $img_path = $movie['img_path'];
    $synopsis = $movie['synopsis'];
    echo "
    <div class='movieItem' id='movieItem$id'>
        <table>
            <tr>
                <td>
                    <img src='$img_path'></img>
                </td>
                <td>
                    <h3>$title ($year)</h3>
                    Genre: $genre <br>
                    Synopsis: <article>$synopsis</article>
                </td>
            </tr>
        </table> 
    </div>
    ";

}
?>
<html>
    <style>
        .movieItem {
            border: 1px solid black
        }
        
    </style>
    <body>
        
        <h1 id="header">retrieve movie</h1>
    <input id="searchInput" type="text" onkeypress="return searchOnKeyPress(event);"> 
        <button id="searchBtn" onclick="submitWordSearchQuery();">SEARCH</button> 
        <button id="genreBtn" onclick="renderGenres();">Choose Genre</button>
        <button id="yearBtn" onclick="renderYears();">Choose Year</button>
        <div id="movieList">
            <?php
            $result = send_query('select * from video;');
            foreach($result as $row) {
                render_movie_item($row);
            }
            // TODO: Paging
            ?>
        </div>
    </body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script lang="js">
        function searchOnKeyPress(e){
            const keyCodeOfEnter = 13;
            if(e.keyCode == keyCodeOfEnter) {
                submitWordSearchQuery();
            }
        }

        function newPOST(data) {
            return {
                type: "POST",
                url: "retrieve_movie.php",
                data: data
            };
        }
        function submitWordSearchQuery() {
            const searchWord = document.getElementById("searchInput").value;
            const genreList = document.getElementById("genreList");
            const selectedGenre = genreList ? genreList[genreList.selectedIndex].value : "";
            const yearList = document.getElementById("yearList");
            const selectedYear = yearList ? yearList[yearList.selectedIndex].value : "";
            $.ajax(newPOST({ searchWord, selectedGenre, selectedYear }))
                .done((ajaxResponse) => {
                    document.getElementById("movieList").innerHTML = ajaxResponse
            });    
        }

        function renderGenres() {
            $.ajax(newPOST({renderGenre: true})).done((ajaxResponse) => {
                document.getElementById("genreBtn").outerHTML = ajaxResponse;
            });    
        }

        function renderYears() {
            $.ajax(newPOST({renderYear: true})).done((ajaxResponse) => {
                document.getElementById("yearBtn").outerHTML = ajaxResponse;
            });    
        }
    </script>
</html>