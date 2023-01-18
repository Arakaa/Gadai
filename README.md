# Codeigniter (HMVC) - E-Gadai

E-Gadai Application is a web-based application that provides information about pawnshops such as what products can be pawned, terms of making pawn transactions, monitoring payments and maturity and other functions such as payment payments.

Our Workspace: https://trello.com/b/wv69KXzV/quattro-e-gadai  
Live Application (Cloud): https://itsaraka.com/

## Intro

This Application use:

- PHP Version: Vers 7.4.22 (Recommended) or higher
- MySQL: 10.4.20-MariaDB
- Codeigniter Version: CodeIgniter 3.1.10

## Installation

### Clone the Repo

```
git clone https://gitlab.kartel.dev/widyatama-dsa/reg-b2-kls-a/e-gadai.git
```

### Environment - Configuration

For environment, here we are using Development Environment.  
1; Open the _application/config/development/config.php_ file with a text editor and set your base URL. ie:

```
$config['base_url'] = 'http://localhost:8082/e-gadai';
```

Here we use port _8082_ because our xampp apache port setting is _8082_.

2; Open the _application/config/development/database.php_ file with a text editor and set your database settings. ie:

```
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'port' => '3307',
	'username' => 'root',
	'password' => '',
	'database' => 'e-gadai',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
```

Here we use port _3037_ because our xampp mysql port setting is _3037_.

### Database Migration

1; Before migration, create a database with the same name that you setup in the database configuration. ie:

```
e-gadai
```

2; After create the database, just execute this using the terminal run command in your project root directory:

```
php index.php migrate
```

### Usage

To run the app, just open browser and copy the following url:

```
http://localhost:8082/e-gadai/ (Customer page)
http://localhost:8082/e-gadai/dashboard/login (Admin page)
```

Admin account:

```
email: admin@gmail.com
password: 12345
```
