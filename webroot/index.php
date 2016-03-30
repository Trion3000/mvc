<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS . '..' . DS);
define('VIEW_DIR', ROOT . 'View' . DS);
define('LIB_DIR', ROOT . 'Library' . DS);
define('CONTROLLER_DIR', ROOT . 'Controller' . DS);
define('MODEL_DIR', ROOT . 'Model' . DS);
define('DATA_DIR', ROOT . '_data' . DS);
define('CONF_DIR', ROOT . 'Config' . DS);
define('UPLOAD_DIR', ROOT . 'webroot' . DS . 'uploads' . DS);



/**
 * @param $className
 * @throws Exception
 */
function __autoload($className)
{
    $file = ROOT . str_replace('\\', DS, "{$className}.php");

    if (!file_exists($file)) {
        throw new \Exception("{$file} not found", 404);
    }

    require_once $file;
}

try {
    \Library\Session::start();
    \Library\Config::setFromXML('db.xml');
    \Library\Router::init('routes.php');

    $request = new \Library\Request();
    \Library\Router::match($request);

    $controller = \Library\Router::$controller;
    $action = \Library\Router::$action;
    $controller = new $controller();

    if (!method_exists($controller, $action)) {
        throw new Exception("{$action} not found", 404);
    }

    $content = $controller->$action($request);
} catch(\Library\NotFoundException $e) {
    $content = \Library\Controller::renderError($e->getCode(), $e->getMessage());
} catch(\Exception $e) {
    $content = \Library\Controller::renderError($e->getCode(), $e->getMessage());
}

echo $content;

//
//echo '<hr> <b>Debug</b>: <br>';
//
//var_dump($route, $controller, $action);