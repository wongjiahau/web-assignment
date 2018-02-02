# web-assignment

## How to load SQL script into MySql?
``` sh
# Make sure you are in the MySQL console
source ~/Repos/web-assignment/amldb.sql;
```

## How to load sample data?
```sh
# Make sure you are NOT in MySQL console
mysqlimport --ignore-lines=1 \
            --fields-terminated-by=',' \
            --fields-enclosed-by='\"' \
            --local -u root \
            --columns='title, year, genre, img_path, synopsis' \
            -p aml \
            ~/Repos/web-assignment/sample_data/scrapping/video.csv
```

