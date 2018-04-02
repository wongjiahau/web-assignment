#!/bin/bash
# printf "Enter the password for your MySQL >> ";
# unset -v MYSQL_PW # Make sure it is not exported
# set +a            # Make sure variable are not automaticall exported
# IFS= read -rs MYSQL_PW < /dev/tty
# if [ $? -ne 0 ]; then
#     echo "Error. You may have entered the wrong password for MySQL."
#     exit 1
# fi;

MYSQL_PW=123
echo "Creating tables . . ."
mysql -h localhost -u root -p$MYSQL_PW < /mydata/amldb.sql
echo "Loading sample movies . . ."
mysqlimport --ignore-lines=1 \
            --fields-terminated-by=',' \
            --fields-enclosed-by='\"' \
            --local -u root \
            --columns='title, year, genre, img_path, synopsis' \
            -p$MYSQL_PW aml \
            /mydata/movie.csv

if [ $? -eq 0 ]; then
    echo "Database with name 'aml' is initialized successfully.";
else
    echo "Failed to initialize database. Please try again."
fi
unset MYSQL_PW