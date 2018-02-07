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
    echo "<br>";
    echo "You searched for ".$_POST['search_word'];
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
        <input id="searchInput" type="text"> <input id="searchBtn" type="submit"> <br>
        <p id="response"></p>
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

        <?php
        require($_SERVER['DOCUMENT_ROOT'] . "/home/util/connect.php");
        $query = "select * from video;";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            $message = 'Invalid query: ' . mysqli_error() . "\n";
            $message .= 'Whole query: ' . $query;
            echo $message;
            die($message);
        }
        $LIMIT = 10;
        for ($i = 0; $i < $LIMIT; $i++) {
            $row = mysqli_fetch_assoc($result);
            render_movie_item($row);
        }
        mysqli_close($conn);
        ?>
    </body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script lang="js">
        $('#searchBtn').click(function() {
            $.ajax({
                type: "POST",
                url: "retrieve_movie.php",
                data: { search_word: document.getElementById("searchInput").value}
            }).done(function( ajaxResponse ) {
                document.getElementById("response").innerHTML = ajaxResponse
                console.log( "Data Saved: " + ajaxResponse );
            });    
        });
        x = (1+2)/5;
    </script>
</html>