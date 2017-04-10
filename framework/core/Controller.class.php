<?php

namespace framework\core;

// Base Controller
use framework\core\Loader;

class Controller
{
    // Base Controller has a property called $loader, it is an instance of Loader class(introduced later)

    protected $loader;
    protected $layout = 'index';

    public function __construct()
    {

        $this->loader = new Loader();
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

    public function render($view, array $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        $content = file_get_contents('app/views/'.strtolower(_CONTROLLER).'/'.$view.'.php');
        include 'app/views/layout/'.$this->layout.'.php';
        
        
        
    }
}