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
if (isset($_POST['search_word'])) {
    require($_SERVER['DOCUMENT_ROOT'] . "/home/util/send_query.php");
    $x = $_POST['search_word'];
    $result = send_query("select * from video where title like '%$x%';");
    $LIMIT = 10;
    for ($i = 0; $i < $LIMIT && $i < count($result); $i++) {
        render_movie_item($result[$i]);
    }
    if(count($result) == 0) {
        echo "No result found.";
    }
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
        <input id="searchInput" type="text" onkeypress="return searchOnKeyPress(event);"> <input id="searchBtn" type="submit"> <br>
        genre <select name="genre">
            <option value="A">A</option>
            <option value="B">A</option>
            <option value="-">Other</option>
        </select> <br>
        year <select name="year">
            <option value="A">A</option>
            <option value="B">A</option>
            <option value="-">Other</option>
        </select>
        <div id="movieList">
            <?php
            require($_SERVER['DOCUMENT_ROOT'] . "/home/util/send_query.php");
            $result = send_query('select * from video;');
            $LIMIT = 10;
            for ($i = 0; $i < $LIMIT; $i++) {
                render_movie_item($result[$i]);
            }
            mysqli_close($conn);
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
        $('#searchBtn').click(submitWordSearchQuery);
        x = (1+2)/5;
    </script>
</html>