<?php
   require_once 'Model/Product.php';

   class sqlConnectionWithDatabase {
      
      protected String $myPDO_string = 'sqlite:./SQLite3/products.db';     
      protected $file_db;

      function __construct() {    
         $this->file_db  = new PDO($this->myPDO_string);
         $this->file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
         // Create table messages
         $this->file_db->exec("CREATE TABLE IF NOT EXISTS messages (
                        id INTEGER PRIMARY KEY, 
                        title TEXT, 
                        message TEXT, 
                        time INTEGER)");    
         $this->file_db->exec("CREATE TABLE IF NOT EXISTS products (
                        id INTEGER PRIMARY KEY, 
                        title VARCHAR(100), 
                        price  DECIMAL(10,2), 
                        currency VARCHAR(3),
                        availability  TEXT)");                     
      
         // Array with some test data to insert to database             
         // $messages = array(
         //          array('title' => 'Hello!',
         //                'message' => 'Just testing...',
         //                'time' => 1327301464),
         //          array('title' => 'Hello again!',
         //                'message' => 'More testing...',
         //                'time' => 1339428612),
         //          array('title' => 'Hi!',
         //                'message' => 'SQLite3 is cool...',
         //                'time' => 1327214268)
         //        );
         $title='nameaa'; 
         $price=10.3;
         $currency='USD';
         $availability='AVAILABLE';
         try {
            $sql = "INSERT INTO products(title, price, currency,availability) VALUES (?,?,?,?)";
            $this->file_db->prepare($sql)->execute([$title, $price,$currency,$availability]);
            } catch (PDOException $e) {
               error_log($e->getMessage()."\n", 3, "./logs/sql_logs.txt");      
         }

            // Select all data from memory db messages table 
            // $result = $this->file_db->query('SELECT * FROM users');
         
            // foreach($result as $row) {
            //    echo "Id: " . $row['name'] . "\n";
            //    echo "Title: " . $row['surname'] . "\n";
            //    echo "Message: " . $row['sex'] . "\n";
            // }
         }
         function save_product_to_database(Product $product){
            $sql = "INSERT INTO products (title, price, currency,availability) VALUES (?,?,?,?)";
            $this->file_db->prepare($sql)->execute([$product->title, $product->price,$product->currency,$product->availability]);
   
         }
      }

               
?>