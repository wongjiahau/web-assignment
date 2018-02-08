<?php
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

if (isset($_POST['search_word'])) {
    $x = $_POST['search_word'];
    $result = send_query("select * from video where title like '%$x%';");
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
    $genres = (array_unique(array_map(trim, $genres)));
    $genres = array_values(array_filter($genres));
    //TODO: sort the $genres
    // $genres = uasort($genres, function ($a, $b) {
        //     return strcmp($a['path'], $b['path']);
        // });
        // print_r($genres);
    $html = "";
    foreach ($genres as $g) {
        $html.="<option value='$g'>$g</option>";
    }
    $html = "<select name='genre'>".$html."</select>";
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
        <button id="searchBtn" onclick="submitWordSearchQuery();">SEARCH</button> <br>
        <button id="genreBtn" onclick="renderGenres();">Choose Genre</button>
        <button id="yearBtn" onclick="">Choose Year</button>
        year <select name="year">
            <option value="A">A</option>
            <option value="B">A</option>
            <option value="-">Other</option>
        </select>
        <div id="movieList">
            <?php
            $result = send_query('select * from video;');
            $LIMIT = 10;
            for ($i = 0; $i < $LIMIT; $i++) {
                render_movie_item($result[$i]);
            }
            mysqli_close($conn);
            // TODO: Paging
            ?>
        </div>
    </body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script lang="js">
        function searchOnKeyPress(e){
            if(e.keyCode == 13) {
                submitWordSearchQuery();
            }


        }
        function submitWordSearchQuery() {
            $.ajax({
                type: "POST",
                url: "retrieve_movie.php",
                data: { search_word: document.getElementById("searchInput").value}
            }).done(function( ajaxResponse ) {
                document.getElementById("movieList").innerHTML = ajaxResponse
            });    
        }

        function renderGenres() {
            $.ajax({
                type: "POST",
                url: "retrieve_movie.php",
                data: { renderGenre: true }
            }).done(function( ajaxResponse ) {
                document.getElementById("genreBtn").outerHTML = ajaxResponse
            });    
        }
    </script>
</html>