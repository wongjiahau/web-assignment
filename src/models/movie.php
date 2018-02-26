<?php
class Movie {
    function __construct($title, $year, $genre, $img_path, $synopsis)
    {
        $this->title    = $title;
        $this->year     = $year;
        $this->genre    = $genre;
        $this->img_path = $img_path;
        $this->synopsis = $synopsis;
    }
}
