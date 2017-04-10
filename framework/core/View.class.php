<?php

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

            echo '<link rel="stylesheet" href="web/'.$css.'"/>';
        }
    }

    public function registerJs()
    {
        foreach ($this->js as $js) {

            echo '<script src="web/'.$js.'" type="text/javascript"></script>';
        }
    }
}