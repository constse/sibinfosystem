<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

//umask(0000);

$protected = false;
$allowedIPs = array('127.0.0.1', 'fe80::1', '::1');
$denied = array_key_exists('HTTP_CLIENT_IP', $_SERVER)
    || array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)
    || !(in_array(@$_SERVER['REMOTE_ADDR'], $allowedIPs) || php_sapi_name() === 'cli-server');

if ($protected && $denied) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file.');
}

$loader = require_once __DIR__ . '/../app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__ . '/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
