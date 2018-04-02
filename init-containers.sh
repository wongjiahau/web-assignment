#!/bin/bash
docker-compose stop
docker-compose build
docker-compose up -d
docker exec -t mydatabase /mydata/init_database.sh
