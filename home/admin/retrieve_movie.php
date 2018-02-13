<?php
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/src/MovieItem.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/src/Paginator.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/src/DbLink.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/src/QueryBuilder.php");

if (isset($_POST['searchWord'])) {
    $pg = new Paginator(new DbLink(), Q()->fromVideo->selectAll, 0);
    $glue = $pg->getGlue();
    $pageData = $glue["pageData"];
    $totalPageCount = $glue["totalPageCount"];
    $currentPage = $glue["currentPage"];
    $movieListHtml = "";
    foreach($pageData as $movie) {
         $movieListHtml .= (new MovieItem($movie))->render();
    }
    $result = array(
        "movieListHtml" => $movieListHtml,
        "paginatorHtml" => "<p>Not implemented yet</p>"
    );
    echo json_encode($result);
    exit;
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
        <br>
        <button id="prevBtn" onclick="prevPage();">PREVIOUS PAGE </button>
        <button id="nextBtn" onclick="nextPage();">NEXT PAGE </button>
        <div id="currentIndexDiv" tag="0"></div>
        <div id="paginatorLink">
            <?php
            $pg = new Paginator(new DbLink(), Q()->fromVideo->selectAll);
            $result = $pg->getGlue();
            ?>
        </div>
        <div id="movieList">
            <?php
            echo RenderListOfMovies($result["pageData"]);
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
            const startIndex = document.getElementById("currentIndexDiv").getAttribute("tag");
            $.ajax(newPOST({ searchWord, selectedGenre, selectedYear, startIndex }))
                .done((ajaxResponse) => {
                    result = JSON.parse(ajaxResponse);
                    document.getElementById("movieList").innerHTML = result.movieListHtml;
                    document.getElementById("paginatorLink").innerHTML = result.paginatorHtml;
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