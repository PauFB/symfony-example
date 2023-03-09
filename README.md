# symfony-example
A simple Symfony PHP web application example to manage provider data stored in a MySQL database.

### 1. Build from docker-compose file
```
docker-compose build
```

### 2. Run
```
docker-compose up -d
```
Afterwards, create the database schema by running:
```
docker exec symfony-example_app php bin/console doctrine:migrations:migrate --no-interaction
```
Navigate to http://localhost:8000.
