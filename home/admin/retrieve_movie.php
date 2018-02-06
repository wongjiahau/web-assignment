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
function render_movie_item($movie)
{
    $title = $movie['title'];
    $year = $movie['year'];
    $genre = $movie['genre'];
    $img_path = $movie['img_path'];
    $synopsis = $movie['synopsis'];
    echo "
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
    ";

}
?>
<html>
    <body>
        <h1>retrieve movie</h1>
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
        while ($row = mysqli_fetch_assoc($result)) {
            render_movie_item($row);
            // echo json_encode($row)."<br>";
            // echo "" . $row['title'] . " <br>";
        }
        mysqli_close($conn);
        ?>
    </body>
</html>