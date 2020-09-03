<?php
$variables = [
    'DB_NAME' => 'YOUR_DB_NAME',
    'DB_PASSWORD' => '',
    'DB_USERNAME' => 'YOUR_DB_USERNAME',
    'LOCAL_HOST' => 'localhost',
    'BASE_URL' => 'http://localhost/Kato', //CHANGE IN GIVEN FORMAT
    'FOLDER' => '/Kato' //CHANGE IN GIVEN FORMAT
];
foreach ($variables as $key => $val) {
    putenv("$key=$val");
}