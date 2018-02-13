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
class MovieItem
{
    function __construct($row)
    {
        $this->_id = $row['video_id'];
        $this->_title = $row['title'];
        $this->_year = $row['year'];
        $this->_genre = $row['genre'];
        $this->_img_path = $row['img_path'];
        $this->_synopsis = $row['synopsis'];
    }

    function render()
    {
        return "
            <div class='movieItem' id='movieItem$this->_id'>
                <table>
                    <tr>
                        <td>
                            <img src='$this->_img_path'></img>
                        </td>
                        <td>
                            <h3>$this->_title ($this->_year)</h3>
                            Genre: $this->_genre <br>
                            Synopsis: <article>$this->_synopsis</article>
                        </td>
                    </tr>
                </table> 
            </div>
    ";
    }
}

function RenderListOfMovies($rows)
{
    $res = "";
    foreach ($rows as $r) {
        $res .= (new MovieItem($r))->render();
    }
    return $res;
}
?>