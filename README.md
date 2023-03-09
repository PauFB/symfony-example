# symfony-example
A simple Symfony PHP web application example to manage provider data stored in a MySQL database.

# Install
Install Composer dependencies:
```
composer install
```
After creating a new database called `symfony_example_db`, create its schema by using:
```
php bin/console doctrine:migrations:migrate
```

# Run
```
php bin/console server:run
```
Navigate to http://localhost:8000.

---

### Tested using
- Composer 2.5.4
- PHP 8.0.25 (included in XAMPP 8.0.25)
- MySQL server version: 10.4.27-MariaDB (included in XAMPP 8.0.25)
