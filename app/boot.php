<?php
require_once 'config.php';
require_once 'library/database.php';
require_once 'core/App.php';
require_once 'core/mainModel.php';
require_once 'core/mainController.php';
require_once 'core/mainView.php';
require_once 'route.php';


spl_autoload_register(function($class_name){
    $modul=explode("Model",$class_name);

    if (file_exists($inc=DIRECTORY."/moduls/{$modul[0]}/model/{$class_name}.php"))
    {
        require_once $inc;
    }
});

