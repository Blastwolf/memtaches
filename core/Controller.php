<?php

class Controller{

    public function render($filename, $vars = null) {


        if (is_array($vars) && !empty($vars)) {

            extract($vars);
        }

        ob_start();
        include $filename;
        echo(ob_get_clean());
    }
}



