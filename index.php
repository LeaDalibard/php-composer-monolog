<?php

// composer autoloader
require_once 'vendor/autoload.php';

use \Monolog\Logger;
use \Monolog\Formatter\LineFormatter;
use \Monolog\Handler\StreamHandler;
use \Monolog\Handler\FirePHPHandler;
use \Monolog\Handler\BrowserConsoleHandler;
use \Monolog\Handler\NativeMailerHandler;


// Create the loggers

$loggerInfo = new Logger('info');
$loggerWarning = new Logger('warning');
$loggerDanger = new Logger('danger');

// Now add some handlers
$loggerInfo->pushHandler(new FirePHPHandler());
$loggerInfo->pushHandler(new BrowserConsoleHandler());

$loggerWarning->pushHandler(new StreamHandler(__DIR__ . '/warning.log', Logger::WARNING));
$loggerWarning->pushHandler(new FirePHPHandler());
$loggerWarning->pushHandler(new BrowserConsoleHandler());


$loggerDanger->pushHandler(new FirePHPHandler());
$loggerDanger->pushHandler(new BrowserConsoleHandler());


if(isset($_GET['type'])){
    switch ($_GET['type']) {
        case "DEBUG" :
            $loggerInfo->pushHandler(new StreamHandler(__DIR__ . '/info.log', Logger::DEBUG));
            $loggerInfo->debug($_GET['message']);
            break;
        case "INFO" :
            $loggerInfo->pushHandler(new StreamHandler(__DIR__ . '/info.log', Logger::INFO));
            $loggerInfo->info($_GET['message']);
            break;
        case "NOTICE":
            $loggerInfo->pushHandler(new StreamHandler(__DIR__ . '/info.log', Logger::NOTICE));
            $loggerInfo->notice($_GET['message']);
            break;

        case "WARNING":
            $loggerWarning->warning($_GET['message']);
            break;

        case "ERROR":
            $loggerDanger->pushHandler(new StreamHandler(__DIR__ . '/danger.log', Logger::ERROR));
            $loggerDanger->error($_GET['message']);
            $loggerDanger->pushHandler(new NativeMailerHandler(  'leadalibard@gmail.com','error','leadalibard@gmail.com'));

            break;

        case "CRITICAL":
            $loggerDanger->pushHandler(new StreamHandler(__DIR__ . '/danger.log', Logger::CRITICAL));
            $loggerDanger->critical($_GET['message']);
            break;

        case "ALERT":
            $loggerDanger->pushHandler(new StreamHandler(__DIR__ . '/danger.log', Logger::ALERT));
            $loggerDanger->alert($_GET['message']);
            break;
    }


}


require 'buttons.html';