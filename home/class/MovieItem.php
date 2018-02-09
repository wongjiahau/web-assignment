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
        $this->id = $row['video_id'];
        $this->title = $row['title'];
        $this->year = $row['year'];
        $this->genre = $row['genre'];
        $this->img_path = $row['img_path'];
        $this->synopsis = $row['synopsis'];
    }

    function render()
    {
        echo "
            <div class='movieItem' id='movieItem$this->id'>
                <table>
                    <tr>
                        <td>
                            <img src='$this->img_path'></img>
                        </td>
                        <td>
                            <h3>$this->title ($this->year)</h3>
                            Genre: $this->genre <br>
                            Synopsis: <article>$this->synopsis</article>
                        </td>
                    </tr>
                </table> 
            </div>
    ";
    }
}
?>