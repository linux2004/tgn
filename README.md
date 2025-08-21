### Installing sqlite3 on ubuntu
```
sudo apt install sqlite3
sqlite3 --version 
```
The actuall database and table is made during the database connection in initialozation of th script to be "more" dynamic.
Alternatively you can make it from the terminal

# Installing and php package 
sudo apt install php8.2-sqlite3
# Running Composer
composer install or composer update
### Sample of product page
<!-- It needs a prototype to read all the values and cover all the needed case. In this example is use the Fictional product ID 1256-->
<!-- Supported currencies with 2 decimal digits
$ USA Dollars USD
€ Euros EUR
£ Pounds GBP
-->
<!doctype html>
<html>
<head>
<title>Product Page</title>
<meta name="description" content="Our first page">
<meta name="keywords" content="html tutorial template">
</head>
<body>
<div id="product_1256_title">Sample Product Title</div>
<div id="product_1256__ditails">Price
    <div id="product_1256__price">250$</div>
    <div id="product_1256__availability">Available</div>
</div>
</body>
</html>

### Running the script

Set connection string in sql_check_connection.php
example protected String $myPDO_string = 'sqlite:./SQLite3/products.db'; 
```
php php_html_sample.php
```