<?php
/*
 * Cập nhật: 13/04/2017 - 10:42 AM - Anhhv
 * MainClass chạy chương trình, khai báo hàm quan trọng, xử lý bảo mật cơ bản và routing
 */
namespace framework\core;

use framework\libs\Helper;

class MainCore
{
    /*
     * Biến helper thuộc class helper
     */
    public static $helper;

    public function __construct()
    {
        self::$helper = new Helper();
    }

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

        define("_MAIN_URL",
            $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/');

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

// Start session

        session_start();
    }

    private static function dispatch()
    {
        $params = [];

        $arrURI = explode('/', $_SERVER['REQUEST_URI']);

        define("_CONTROLLER",
            (isset($arrURI[1]) && $arrURI[1] != null) ? ucfirst($arrURI[1]) : $GLOBALS['config']['base_controller']);

        define("_ACTION",
            (isset($arrURI[2]) && $arrURI[2] != null) ? ucfirst($arrURI[2]) : 'Index');

        if (count($arrURI) > 3) {
            $params = array_slice($arrURI, 3);
        }

        define("_CURR_VIEW_PATH", _VIEW_PATH.strtolower(_CONTROLLER)._DS);

        if ((isset($_SESSION['csrf_token']) && $_REQUEST['csrf_token'] && $_SESSION['csrf_token']
            == $_REQUEST['csrf_token']) || (!isset($_SESSION['csrf_token']))) {
            $controller_classname = '\\app\\controllers\\'._CONTROLLER."Controller";

            $action_name = "action"._ACTION;

            $controller = new $controller_classname($params);

            if (method_exists($controller_classname, $action_name)) {
                $controller->$action_name();
            } else {
                echo "Can't find the method in controller class";
                exit();
            }
        } else {
            echo "Security code is not fit";
            exit();
        }
    }
}