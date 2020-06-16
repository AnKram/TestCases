<?php

// подключение к бд
define('DB_PARAMS', array(
    'hostname' => 'localhost',
    'username' => 'root',
    'pass' => '',
    'db' => 'test_database'
));

// лимит чанка
define('CHUNK_SIZE', 2);

// просрочка по платежу (в днях)
define('DELAY_IN_PAYMENT', 10);

// путь до папки с xml файлами по просрочкам
define('XML_PATH', 'xml/');

// путь до файлов с логами
define('LOGS_PATH', 'logs/');
