<?php
$variables = [
    'DB_NAME' => 'kato',
    'DB_PASSWORD' => '',
    'DB_USERNAME' => 'root',
    'LOCAL_HOST' => 'localhost',
    'BASE_URL' => 'https://kato2.herokuapp.com',
    'FOLDER' => ''
];
foreach ($variables as $key => $val) {
    putenv("$key=$val");
}
