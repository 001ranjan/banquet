<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__ . '/storage/framework/maintenance.php')) {
    require $maintenance;
    exit;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it. Require the autoloader
| to enable autoloading of classes used throughout the application.
|
*/

require __DIR__ . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application instance, handle the incoming request using
| the application's HTTP kernel. Then send the response back to the client's
| browser, allowing them to interact with the application seamlessly.
|
*/

$app = require_once __DIR__ . '/bootstrap/app.php';

// Make the application kernel
$kernel = $app->make(Kernel::class);

// Handle the request and send the response
$response = $kernel->handle(
    $request = Request::capture()
)->send();

// Terminate the request/response cycle
$kernel->terminate($request, $response);