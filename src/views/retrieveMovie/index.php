<html>
    <style>
        .movieItem {
            border: 1px solid black
        }
    </style>
    <body>
        <h1 id="header">retrieve movie</h1>
        <input id="searchInput" type="text"> 
        <button id="searchBtn">SEARCH</button> 
        <select id="genreSelect">
            <option value="" disabled selected>Choose genre</option>
            <option value="">Any</option>
        </select>
        <select id="yearSelect">
            <option value="" disabled selected>Choose year</option>
            <option value="">Any</option>
        </select>
        <br>
        <div id="pageLinks">

        </div>
        <div id="movieList">

        </div>
    </body>
</html>