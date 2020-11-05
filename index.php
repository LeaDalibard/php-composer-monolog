<?php

// composer autoloader
require_once 'vendor/autoload.php';

use \Monolog\Logger;
use \Monolog\Formatter\LineFormatter;
use \Monolog\Handler\StreamHandler;
use \Monolog\Handler\FirePHPHandler;
use \Monolog\Handler\BrowserConsoleHandler;

// Create the logger

$logger = new Logger('debug');

// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());

$loggerInfo = new Logger('info');
$loggerInfo->pushHandler(new StreamHandler(__DIR__.'/info.log', Logger::INFO));
$loggerInfo->pushHandler(new BrowserConsoleHandler());

$loggerInfo->info($_GET['message']);

$loggerWarning= new Logger('warning');
$loggerWarning->pushHandler(new StreamHandler(__DIR__.'/warning.log', Logger::WARNING));
$loggerWarning->pushHandler(new BrowserConsoleHandler());

$loggerWarning->warning($_GET['message']);

require 'buttons.html';