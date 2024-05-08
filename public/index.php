<?php
require_once __DIR__.'/../vendor/autoload.php';

use Core\ServiceContainer;
use Core\Router;
use Core\Response;

use App\Controller\Salary;

GLOBAL $app;

$app = new ServiceContainer();

$response = $app->get(Response::class);
$router = $app->get(Router::class);

$router->get('/',[Salary::class,'index']);

$router->run();
$response->send();

?>