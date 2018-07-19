<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=mysql;port=3306;dbname=yii2_easy_admin',   // service name: mysql
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8mb4',
    'tablePrefix' => 'yea_',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 0,      // never expire
    'schemaCache' => 'cache',
];
