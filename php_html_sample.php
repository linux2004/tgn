<?php
require_once 'SQLite3/functions/sql_check_connection.php';
require_once 'help_functions/curl_requests.php';
require_once 'help_functions/fake_response.php';
require_once 'vendor/autoload.php';
require_once 'Model/Product.php';
use voku\helper\HtmlDomParser;

// Checking the database connetion and creating database if not exists
new sqlConnectionWithDatabase();

$url_array = [];

// Reading from file line by line in a text file
// Also can be done with JSON
// Or read it all with feed
// Alternativly from terminal
// reading argv value with a loop 
// argv[1] will be first url
$urlsfile = fopen("urls.txt", "r") or die("Unable to open file!");
while(!feof($urlsfile)) {
    $single_url=trim(fgets($urlsfile));
    // adding to an array. No keeping the file open
    if (filter_var($single_url, FILTER_VALIDATE_URL)==FALSE){
        error_log($single_url."\n", 3, "./logs/url_filter_logs.txt");
    } else {
        $url_array[] = $single_url;
    }
}
foreach ($url_array as $url) {
    [$getResponse,$error,$error_message] = makeRequest::getResponse($url);
    if ($error){
        [$getResponse,$error,$error_message] = makeRequest::getResponse($url);
        if ($error){
            error_log($error_message."\n", 3, "./logs/response_logs.txt");
            continue;
        }
    }
    // Parse HTML from string
    // Faking the respoanse so it is not needed to make several samples
    $fake_response = fakeResponse::getFakeResponse();
    $html = HtmlDomParser::str_get_html($fake_response);   

    // Find and output the price id
    $title = $html->findOne('div[id$=_title]')->text(); 
    echo $title;
    $price = $html->findOne('div[id^=product_] > div[id$=_price]')->text(); 
    echo $price;
    $availability = $html->findOne('div[id^=product_] > div[id$=_availability]')->text(); 
    echo $availability;
    $Product = new Product();
    $productValidaton=$Product->validate_values($title,$price,$availability,$url);
    if ($productValidaton) { 
        $Product->set($title,$price,$availability);
        $Product->save();
    }
}

