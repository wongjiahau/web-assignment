# web-assignment
## How to launch this website?
Create a symbolic link in the server root to `./home`;
```
sudo ln -s ~/Repos/web-assignment/home/ ./home
```

## 

## Configuration
### LAMP version
```bash
# Linux version
lsb_release -a
Distributor ID: Ubuntu
Description:    Ubuntu 16.04.3 LTS
Release:        16.04
Codename:       xenial

# Apache version
apache2 -v
Server version: Apache/2.4.18 (Ubuntu)
Server built:   2017-09-18T15:09:02

# MySQL version
mysql --version
mysql  Ver 14.14 Distrib 5.7.21, for Linux (x86_64) using  EditLine wrapper

# php version
php -v
PHP 7.0.22-0ubuntu0.16.04.1 (cli) ( NTS )
Copyright (c) 1997-2017 The PHP Group
Zend Engine v3.0.0, Copyright (c) 1998-2017 Zend Technologies
    with Zend OPcache v7.0.22-0ubuntu0.16.04.1, Copyright (c) 1999-2017, by Zend Technologies
```

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

