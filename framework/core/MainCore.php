<?php

namespace framework\core;

class MainCore
{

    public static function run()
    {
        self::init();

        self::autoload();

        self::dispatch();
    }

    private static function init()
    {
// Define path constants

        define("_DS", DIRECTORY_SEPARATOR); //return /

        define("_ROOT", getcwd()._DS);

        define("_APP_PATH", _ROOT.'app'._DS);

        define("_FRAMEWORK_PATH", _ROOT."framework"._DS);

        define("_PUBLIC_PATH", _ROOT."public"._DS);

        define("_CONFIG_PATH", _APP_PATH."config"._DS);

        define("_CONTROLLER_PATH", _APP_PATH."controllers"._DS);

        define("_MODEL_PATH", _APP_PATH."models"._DS);

        define("_VIEW_PATH", _APP_PATH."views"._DS);

        define("_CORE_PATH", _FRAMEWORK_PATH."core"._DS);

        define('_DB_PATH', _FRAMEWORK_PATH."database"._DS);

        define("_UPLOAD_PATH", _PUBLIC_PATH."uploads"._DS);

// Load configuration file
        $GLOBALS['config'] = include _CONFIG_PATH."config.php";
// Define platform, controller, action, for example:
// framework.dev/controller/action/param
        $arrURI            = explode('/', $_SERVER['REQUEST_URI']);

//define("_PLATFORM", isset($_REQUEST['p']) ? $_REQUEST['p'] : 'home');

        define("_CONTROLLER",
            (isset($arrURI[1]) && $arrURI[1] != null) ? ucfirst($arrURI[1]) : $GLOBALS['config']['base_controller']);

        define("_ACTION",
            (isset($arrURI[2]) && $arrURI[2] != null) ? ucfirst($arrURI[2]) : 'Index');


        define("_CURR_CONTROLLER_PATH", _CONTROLLER_PATH);


        define("_CURR_VIEW_PATH", _VIEW_PATH.$arrURI[1]._DS);


// Load core classes
        require _CORE_PATH."View.class.php";
        require _CORE_PATH."Controller.class.php";

        require _CORE_PATH."Loader.class.php";

        require _DB_PATH."Mysql.class.php";

        require _CORE_PATH."Model.class.php";


// Start session

        session_start();
    }

    private static function autoload()
    {
        spl_autoload_register(array(__CLASS__, 'load'));
    }

    private static function load($classname)
    {
        if (substr($classname, -10) == "Controller") {

// Controller
            if (file_exists(_CURR_CONTROLLER_PATH."$classname.class.php")) {

                require_once _CURR_CONTROLLER_PATH."$classname.class.php";
            } else {

                
                exit();
            }
        } else if (substr($classname, -5) == "Model") {

// Model
            if (file_exists(_MODEL_PATH."$classname.class.php")) {
                require_once _MODEL_PATH."$classname.class.php";
            } else {
                echo "Can't find the Model file";
                exit();
            }
        }
    }

    private static function dispatch()
    {
        $controller_name = _CONTROLLER."Controller";

        $action_name = "action"._ACTION;

        $controller = new $controller_name;
        if (method_exists($controller_name, $action_name)) {
            $controller->$action_name();
        } else {
            echo "Can't find the method in controller class";
            exit();
        }
    }
}