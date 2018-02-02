const fs = require('fs'),
    path = require('path'),
    filePath = path.join(__dirname, 'sources/2015_imdb.html');

const jsdom = require("jsdom");
const {JSDOM} = jsdom;

function Movie() {
    this.title = null,
    this.year = null,
    this.genre = null,
    this.img_path = null,
    this.synopsis = null,
    this.toString = () => {
        return `${this.title},${this.year},${this.genre},${this.img_path},${this.synopsis}`
    }
}

fs.readFile(filePath, {
        encoding: 'utf-8'
    }, function (err, data) {
        if (!err) {
            const dom = new JSDOM(data.toString());
            const lists = (dom.window.document.getElementsByClassName("lister-item"));
            const movies = [];
            const keys = Object.keys(lists);
            for (var i in keys) {
                if(i === keys[keys.length - 1]) {
                    break;
                }
                const item = lists[i].getElementsByClassName("lister-item-content")[0];
                const x = new Movie();
                x.title = quote(item.getElementsByClassName("lister-item-header")[0].getElementsByTagName("a")[0].innerHTML);
                x.year = (filePath.split("/")[8].split("_")[0]);
                x.genre = quote(item.getElementsByClassName("text-muted")[1].getElementsByClassName("genre")[0].innerHTML.trim());
                x.img_path = quote(lists[i].getElementsByClassName("lister-item-image")[0].children[0].children[0].getAttribute("loadlate"));
                x.synopsis = quote(item.getElementsByClassName("text-muted")[2].innerHTML.trim());
                movies.push(x);
            }
            const header = "title, year, genre, img_path, synopsis\n";
            const csv = header + movies.map((x) => x.toString()).join("\n");
            
            fs.writeFile(__dirname + "/video.csv", csv, function(err) {
                if(err) {
                    return console.log(err);
                }

                console.log("The file was saved!");
            }); 

        } else {
            console.log(err);
        }
    });

function quote(s) {
    return "\"" + s + "\"";
}