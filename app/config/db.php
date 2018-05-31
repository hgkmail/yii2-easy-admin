<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;port=3307;dbname=yii2_easy_admin',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8mb4',
    'tablePrefix' => 'yea_',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
