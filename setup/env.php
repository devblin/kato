<?php
$variables = [
    'DB_NAME' => 'kato',
    'DB_PASSWORD' => '',
    'DB_USERNAME' => 'root',
    'LOCAL_HOST' => 'localhost',
    'BASE_URL' => 'http://localhost/Kato',
    'FOLDER' => '/Kato'
];
foreach ($variables as $key => $val) {
    putenv("$key=$val");
}