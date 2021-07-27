<?php

class View
{
    public static function frontView($module, $method, $data = null, $return=false)
    {
        if ($return == false) {
            if (file_exists($file = DIRECTORY . "/moduls/{$module}/view/{$method}View.php")) {
                require_once $file;
            } else {
                echo "Page Not Found";
            }
        } else {
            ob_start();
            if (file_exists($file = DIRECTORY . "/moduls/{$module}/view/{$method}View.php")) {
                require_once $file;
                $text=ob_get_contents();
                ob_end_clean();
                return $text;
            } else {
                echo "Page Not Found";
            }
        }

    }


    public static function frontLayout($area,$layout,$module,$method,$data=null)
    {
        $data['VIEW']=$method != null ? view::frontView($module,$method,$data, true) : null;

        require_once DIRECTORY."/layout/{$area}/{$layout}Layout.php";
    }
}
