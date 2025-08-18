<?php
namespace App\Libs;

use App\Libs\Config;
use App\Controllers\AdminController;
use App\Controllers\TasksController;
use App\Controllers\IndexController;

/**
 * Initializer Controller
 * Initializes the system engine by invoking all necessary libraries.
 */
class FrontController
{
    private static $config;

    public static function main()
    {
        //var_dump(class_exists('App\\Controllers\\AdminController'));
        // Instancia directamente el controlador
        //$controller = new AdminController();

        error_log("FrontController -> Main");

        // Include necessary libraries
        self::includeLibraries();

        // Initialize the config using the singleton method
        self::$config = Config::singleton();

        // Determine the controller name
        $controllerName = self::getControllerName();
        
        // Determine the action name
        $actionName = self::getActionName();

        // Construct the controller path
        $controllerPath = self::$config->get('controllersFolder') . $controllerName . '.php';
        $fullControllerPath = self::$config->get('apachePath') . '/' . $controllerPath;

        error_log("Controller Path: $fullControllerPath");

        // Include the requested controller file
        self::loadController($controllerPath, $controllerName);

        // Check if the action is callable
        if (!self::isActionCallable($controllerName, $actionName)) {
            return false;
        }

        // Create an instance of the controller
        $controllerFullName = 'App\\Controllers\\' . $controllerName;
        $controllerInstance = new $controllerFullName();
        $controllerInstance->$actionName();
    }

    private static function includeLibraries()
    {
        $libraries = [
            'libs/Config.php',
            'libs/Constants.php',
            'libs/FR_Session.php',
            'libs/SPDO.php',
            'libs/ControllerBase.php',
            'libs/ModelBase.php',
            'libs/View.php',
            'libs/Utils.php',
            'libs/ErrorMessage.php',
            'config.php' // Configuration file
        ];

        foreach ($libraries as $library) {
            require $library;
        }
    }

    private static function getControllerName()
    {
        return !empty($_GET['controller']) 
            ? ucfirst($_GET['controller']) . 'Controller' 
            : 'IndexController';
    }

    private static function getActionName()
    {
        return !empty($_GET['action']) ? $_GET['action'] : 'index';
    }

    private static function loadController($controllerPath, $controllerName)
    {
        if (is_file($controllerPath)) {
            error_log("Yes, it is file");
            require $controllerPath;
        } else {
            error_log("Controller: $controllerName - El controlador no existe - 404 not found");
            die('El controlador no existe - 404 not found: ' . $controllerPath . ", " . $controllerName);
        }
    }

    private static function isActionCallable($controllerName, $actionName)
    {
        error_log("isActionCallable - Controller: $controllerName, Action: $actionName");

        // Create an instance of the controller
        $controllerFullName = 'App\\Controllers\\' . $controllerName;
        $controllerInstance = new $controllerFullName();

        // Check if the action is callable on the instance
        if (!is_callable([$controllerInstance, $actionName])) {
            error_log("Callable check failed for: " . $controllerName . '->' . $actionName);
            trigger_error($controllerName . '->' . $actionName . ' no existe', E_USER_NOTICE);
            return false;
        }
        return true;
    }

}
