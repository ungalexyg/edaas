<?php
# filename ConnectMongo.php
require_once __DIR__ . "/vendor/autoload.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// connect to mongodb
//$manager = new MongoDB\Driver\Manager('mongodb://username:password@127.0.0.1'); //required username+pass
//$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017', ["username" => "joe", "password" => "test"]); // optional username+pass
$manager = new MongoClient('mongodb://localhost:27017');



$id = new \MongoDB\BSON\ObjectId("5a0c8e2362eb6404c2f10032");
$filter = ['_id' => $id];
$options = [];

$query = new \MongoDB\Driver\Query($filter, $options);
$rows   = $manager->executeQuery('db.collection', $query);
foreach ($rows as $document) {
    var_dump($document);
}
?>
