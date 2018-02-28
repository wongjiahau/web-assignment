<div id="retriveMoviePage">
    <br/>
    <button id="backBtn" class="clickable" onclick="history.back();">Back</button> 
    <input id="searchInput" type="text" placeholder="Type here to search . . ."> 
    <select id="genreSelect" class="clickable">
        <option value="" disabled selected>Choose genre</option>
        <option value="">Any</option>
    </select>
    <select id="yearSelect" class="clickable">
        <option value="" disabled selected>Choose year</option>
        <option value="">Any</option>
    </select>
    
    <button id="searchBtn" class="clickable primary">Search</button> 
    <br>
    <div id="pageLinks"></div>
    <div id="movieList"></div>
    <div id="createMoviePanel"></div>
</div>