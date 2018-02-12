<?php
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
require($_SERVER['DOCUMENT_ROOT'] . "/home/util/send_query.php");
require($_SERVER['DOCUMENT_ROOT'] . "/src/MovieItem.php");
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
        <br>
        <button id="prevBtn" onclick="prevPage();">PREVIOUS PAGE </button>
        <button id="nextBtn" onclick="nextPage();">NEXT PAGE </button>
        <div id="currentIndexDiv" tag="0"></div>
        <div id="movieList">
            <?php
            $result = send_query('select * from video;');
            foreach ($result as $row) {
                $movie = new MovieItem($row);
                $movie->render();
            }
            // TODO: Paging
            ?>
        </div>
    </body>
    <script src="./jquery.js" type="text/javascript"></script>
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
                url: "query_movie.php",
                data: data
            };
        }
        function submitWordSearchQuery() {
            const searchWord = document.getElementById("searchInput").value;
            const genreList = document.getElementById("genreList");
            const selectedGenre = genreList ? genreList[genreList.selectedIndex].value : "";
            const yearList = document.getElementById("yearList");
            const selectedYear = yearList ? yearList[yearList.selectedIndex].value : "";
            const startIndex = document.getElementById("currentIndexDiv").getAttribute("tag");
            $.ajax(newPOST({ searchWord, selectedGenre, selectedYear, startIndex }))
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

        function goToWhere(callback) {
            const LIMIT = 10;
            const div = document.getElementById("currentIndexDiv");
            const currentIndex = div.getAttribute("tag"); 
            div.setAttribute("tag", callback(parseInt(currentIndex), LIMIT).toString());
            submitWordSearchQuery();
        }
        function nextPage() {
            goToWhere((x, y) => x + y)
        }
        function prevPage() {
            goToWhere((x, y) => x - y)
        }
    </script>
</html>