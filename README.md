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
            --fields-terminated-by=, \ # data is delimited by comma
            --local -u root \
            -p aml \ # using database aml
            ~/Repos/web-assignment/sample_data/admin_data.csv
```

