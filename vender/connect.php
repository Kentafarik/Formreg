<?php
    require_once __DIR__ . '/vendor/autoload.php';
    class_alias('\RedBeanPHP\R','\R');
    R::setup( 'mysql:host=formreg;dbname=register',
    'root', '' );

    //проверка
    if(!R::testConnection()) die('No DB connection!');

    session_start(); // Создаем сессию для авторизации
?>
