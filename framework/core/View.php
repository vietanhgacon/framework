<?php
/*
 * Cập nhật: 13/04/2017 - 10:06 AM - Anhhv
 * Class chuyên xử lý các vấn đề liên quan đến view
 */
namespace framework\core;

class View
{
    protected $css;
    protected $js;

    public function __construct()
    {
        $this->css = $GLOBALS['config']['asset']['css'];

        $this->js = $GLOBALS['config']['asset']['js'];
    }

    public function registerCss()
    {
        $csss = $this->css;
        foreach ($csss as $css) {
            echo '<link rel="stylesheet" href="'._MAIN_URL.'web/'.$css.'"/>';
        }
    }

    public function registerJs()
    {
        foreach ($this->js as $js) {

            echo '<script src="'._MAIN_URL.'web/'.$js.'" type="text/javascript"></script>';
        }
    }

    public static function getBlock($view,$param = array())
    {
        if (substr($view, 0,1)!='@') {

            $path = explode('/', $view);

            $controller_classname = '\\app\\controllers\\'.$path[0]."Controller";

            $action_name = "action".(isset($path[1]) ? ucfirst($path[1]) : "Index");

            $controller = new $controller_classname($param);

            if (method_exists($controller_classname, $action_name)) {
                return $controller->$action_name();
            } else {
                echo "Can't find the method in controller class";
                exit();
            }
        } else {
            if (substr($view, 0, 1) == "@") {

                if (file_exists(substr($view, 1))) {
                    return file_get_contents(substr($view, 1));
                } else {
                    echo "Can't find the view file";
                    exit();
                }
            }
        }
    }
}