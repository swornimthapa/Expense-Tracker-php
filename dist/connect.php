<?php 
      require_once __DIR__ . '/../vendor/autoload.php';
      $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ .'/../');
      $dotenv->load();
      $hostname =$_ENV['DB_HOST'];;
      $username =$_ENV['DB_USER'];
      $password = $_ENV['DB_PASS'];
      $dbname = 'expenses_tracker';
      $conn =   mysqli_connect($hostname,$username,$password,$dbname);
  
       if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }
?>