# web-assignment
## What are the dependencies of this project?
- `docker`
- `docker-compose`

## How to get started?
Run the code below :

```bash
cd ~
git clone https://github.com/wongjiahau/web-assignment.git
cd web-assignment
./init-containers.sh
```

## What if the webserver containers exited after startup?
```bash
# Retry the command again
./init-containers.sh
```

## How to stop the containers?
```bash
docker-compose stop
```

### How to install dependencies?
Before that, please install [`composer`](https://getcomposer.org/download/) and [`npm`](https://docs.npmjs.com/getting-started/installing-node)
```
# Install php plugins
php composer.phar install

# Install node packages
npm install
## How to run test ?
```
# To run php test
./vendor/bin/kahlan --reporter=verbose 

# To run js test
npm run test
```

## What is the credentials for admin of this website?
```
Username: admin
Password: 1234
```

## How to initialize database?
``` sh
bash ./init_database.sh
```

## References
- https://jonsuh.com/blog/securely-hash-passwords-with-php/
- https://www.youtube.com/watch?v=Aw28-krO7ZM