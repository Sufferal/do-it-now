# Back-end Documentation

## Pre-requisites
- [XAMPP](https://www.apachefriends.org/index.html)

## Structure
- `config/`: Database configuration. This is not included in the repository. You need to create a `config.php` file inside a `config` directory with the following content:
```php
<?php
  $host = 'localhost';
  $db = 'do_it_now';
  $user = <your_username>;
  $pass = <your_password>;
  $charset = 'utf8mb4';
?>
```
- `controllers/`: contains controller classes handling incoming HTTP requests and returning responses
- `models/`: contains model classes that represent and interact with the database
- `public/`: the entry point for the application
- `services/`: contains service classes that encapsulate business logic
- `utils/`: utility classes and helpers, such as database connection setup.