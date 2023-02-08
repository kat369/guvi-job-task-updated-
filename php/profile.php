<?php

require './vendor/autoload.php';
Predis\Autoloader::register();


    $con = new MongoDB\Client("mongodb://localhost:27017");
    
    
    $db = $con-> userprofile_db;
    
    $tbl = $db->profiledata;
    

if(isset ($_POST['fullname'])){
 
   
        if(empty($_POST['dbid'])){

            $email= $_POST['email'];
            $fname = $_POST['fullname'];
            $dob =$_POST['dateofbirth'];
            $mobile = $_POST['mobilenumber'];
            $address = $_POST['address'];
            $pin = $_POST['pincode'];

            $tbl-> insertOne(["email" => "$email", "name" => "$fname", "dateofbirth" => "$dob", "mobile" => "$mobile", "address" => "$address", "pincode" => "$pin"]);
    
            echo "succesfully inserted";
        }
        else {
            $id= $_POST['dbid'];
            $email= $_POST['email'];
            $fname = $_POST['fullname'];
            $dob =$_POST['dateofbirth'];
            $mobile = $_POST['mobilenumber'];
            $address = $_POST['address'];
            $pin = $_POST['pincode'];

            $tbl-> updateOne(["_id" => new \MongoDB\BSON\ObjectID("$id")],['$set' => ["email" => "$email", "name" => "$fname", "date of birth" => "$dob", "mobile" => "$mobile", "address" => "$address", "pincode" => "$pin"]]);
          
            echo "succesfully updated";
        }
   

}
else{
    
   $redis = new predis/Client();

   $chacheddata = $redis->get('data');

   if($chacheddata){

    file_put_contents('data.json', $chacheddata);

    exit();

   }else{

    $email=$_POST['email'];
    
    $data = $tbl-> findOne(['email' => $email]);

    $result = json_encode( $data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
   
    file_put_contents('data.json', $result);

    $redis->set('data', $result);

    $redis->expire('data', 10);

    exit();
   };
   


}




?>