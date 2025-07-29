<?php

global $settings;

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Liteslim\Library\DB;
use Slim\Views\PhpRenderer;
use Slim\Middleware\Session;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');
            $root = $settings['root'];
            $loggerName = $settings['LOGGER_NAME'];
            $loggerFile = $settings['LOGGER_PATH'];
            $logger = new Logger($loggerName);
            $processor = new UidProcessor();
            $logger->pushProcessor($processor);
            $processor = new IntrospectionProcessor();
            $logger->pushProcessor($processor);
            $processor = new WebProcessor();
            $logger->pushProcessor($processor);
            $handler = new StreamHandler($root . $loggerFile);
            $logger->pushHandler($handler);
            return $logger;
        },
        PhpRenderer::class => function (ContainerInterface $c) {
            $root = $c->get('settings')['root'];
            return new PhpRenderer($root.'templates');
        },
        DB::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');
            $host     = $settings['DB_HOST'];
            $dbname   = $settings['DB_NAME'];
            $user     = $settings['DB_USER'];
            $pass     = $settings['DB_PASS'];
            $port     = $settings['DB_PORT'];
            return new DB($host, $user, $pass, $dbname, $port);
        },
        Session::class => function (ContainerInterface $c) {
            return new Session([
                'name' => 'dummy_session',
                'autorefresh' => true,
                'lifetime' => '1 day',
            ]);
        }
    ]);
};
