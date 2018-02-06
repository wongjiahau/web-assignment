# web-assignment
## How to launch this website?
Create a symbolic link in the server root to `./home`;
```
sudo ln -s ~/Repos/web-assignment/home/ ./home
```

## What is the credentials for admin of this website?
```
Username: admin
Password: 1234
```

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

## How to initialize database?
``` sh
bash ./init_database.sh
```