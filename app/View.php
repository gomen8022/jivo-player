<?php

namespace App;

class View {

    public static function generate($template_view, $data = null)
    {
        if(isset($template_view)) {
            $path =  CWD . '/app/view/' . $template_view . '.php';
            extract($data);
            require $path;
        }
        else {
            echo json_encode($data);
        }
    }
}
