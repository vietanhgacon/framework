<?php
/*
 * Cập nhật: 13/04/2017 - 10:48 AM - Anhhv
 * Class Controller gốc cho các controller khác kế thừa, chuyên xử lý các vấn đề 
 * liên quan tới controller
 */
namespace framework\core;

class Controller
{
    protected $layout = 'index';
    protected $params;
    protected $controller;

    public function __construct($params = array())
    {
        $object = new \stdClass();
        foreach ($params as $key => $value) {
            $object->$key = $value;
        }

        $this->controller = get_class($this);
        $this->params     = $object;
    }

    public function redirect($url, $message, $wait = 0)
    {

        if ($wait == 0) {

            header("Location:$url");
        } else {

            include _CURR_VIEW_PATH."message.html";
        }


        exit;
    }

    public function render($view, $params = array())
    {
        $content = $this->renderBlock($view, $params);

        include 'app/views/layout/'.$this->layout.'.php';
    }

    public function renderBlock($view, $params = array())
    {
        $arrController = explode('\\', $this->controller);

        $controller = str_replace('Controller', '', end($arrController));

        extract($params);

        ob_start();
        include '/app/views/'.strtolower($controller).'/'.$view.'.php';
        return ob_get_clean();
    }
}