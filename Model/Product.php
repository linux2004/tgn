<?php
   class Product {
    public String $title;
    public String $price;
    public String $currency;
    public String $availability;

    // Checking if values are emply
    function validate_values($title,$price,$availability,$url):bool{
        if (empty($title)) {
            error_log('title is missing in url '.$url."\n", 3, "./logs/crawler_varable_logs.txt"); 
            return FALSE;
        }
        if (empty($price)) {
            error_log('price is missing in url '.$url."\n", 3, "./logs/crawler_varable_logs.txt"); 
            return FALSE;
        }
        if (empty($availability)) {
            error_log('availability is missing in url '.$url."\n", 3, "./logs/crawler_varable_logs.txt"); 
            return FALSE;
        }
        return TRUE;
    }
    function set($title,$price,$availability){
        $this->currency='unknown';
        if (str_contains($price, '$')) {$this->currency='USD';}
        if (str_contains($price, '€')) {$this->currency='EUR';}
        if (str_contains($price, '£')) {$this->currency='GBP';}
        // If there is a deferent symbol with filter will not work
        // It should extract the numeric values only
        $price = str_replace(['$','€','£'], '', $price);        
        $this->title=$title;
        $this->price=$price;
        $this->availability=$availability;
    }
    function save(){
        $SqlSave = new sqlConnectionWithDatabase();
        $SqlSave->save_product_to_database($this);
    }
}  