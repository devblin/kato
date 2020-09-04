<?php
$variables = [
    'DB_NAME' => 'bp2eceheqxnmmhgybjjd',
    'DB_PASSWORD' => 'seeUJYwcEedoOB14n4EF',
    'DB_USERNAME' => 'uzeq1xikolfjksbk',
    'LOCAL_HOST' => 'bp2eceheqxnmmhgybjjd-mysql.services.clever-cloud.com',
    'BASE_URL' => 'https://kato2.herokuapp.com', //CHANGE IN GIVEN FORMAT
    'FOLDER' => '' //CHANGE IN GIVEN FORMAT
];
foreach ($variables as $key => $val) {
    putenv("$key=$val");
}