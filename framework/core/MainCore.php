<?php

namespace framework\core;

class MainCore
{

    public static function run()
    {
        self::init();

        self::dispatch();
    }
    /*
     * Hàm định nghĩa hằng
     */

    private static function init()
    {
// Khai báo hằng quan trọng

        define("_DS", DIRECTORY_SEPARATOR);

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

        define("_CURR_CONTROLLER_PATH", _CONTROLLER_PATH);
        //load tham số config, lưu vào một biến global

        $GLOBALS['config'] = include _CONFIG_PATH."config.php";

        //xác định controller và action tương ứng
        //Bước 1: lấy ra URI và chuyển về mảng

        $arrURI = explode('/', $_SERVER['REQUEST_URI']);

        define("_CONTROLLER",
            (isset($arrURI[1]) && $arrURI[1] != null) ? ucfirst($arrURI[1]) : $GLOBALS['config']['base_controller']);


        define("_ACTION",
            (isset($arrURI[2]) && $arrURI[2] != null) ? ucfirst($arrURI[2]) : 'Index');

        define("_CURR_VIEW_PATH", _VIEW_PATH.strtolower(_CONTROLLER)._DS);
        
// Start session

        session_start();
    }


    private static function dispatch()
    {
        
        $controller_classname = '\\app\\controllers\\'._CONTROLLER."Controller";

        $action_name = "action"._ACTION;
 
        $controller = new $controller_classname;

        if (method_exists($controller_classname, $action_name)) {
            $controller->$action_name();
        } else {
            echo "Can't find the method in controller class";
            exit();
        }
    }
}