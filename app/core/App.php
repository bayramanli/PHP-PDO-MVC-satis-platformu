<?php
error_reporting(0);
class App
{
    protected $nowPath;
    protected $nowMethod;
    protected static $routes = [];
    protected $home;

    public function __construct($config)
    {
        $this->nowPath = $_SERVER['REQUEST_URI'];
        $this->nowMethod = $_SERVER['REQUEST_METHOD'];
        $this->home = $config['home'];
        $this->startRoute();

    }

    public static function getAction($link, $path, $auth = false, $area = null)
    {
        self::$routes[] = ['GET', $link, $path, $auth, $area];
    }

    public static function postAction($link, $path, $auth = false, $area = null)
    {
        self::$routes[] = ['POST', $link, $path, $auth, $area];
    }

    public function startRoute()
    {
        foreach (self::$routes as $routes) {
            list($method, $link, $path, $auth, $area) = $routes;

            $methodCheck = $this->nowMethod == $method;
            $pathCheck = preg_match("@^{$link}$@", $this->nowPath, $params);

            if ($methodCheck && $pathCheck) {
                $uri = explode("/", $path);
                array_shift($uri);
                @list($activeModul, $activeMethod) = $uri;


                if ($this->nowPath == "/") {
                    $module = $this->home['modul'];
                    $controller = $this->home['modul'] . "Controller";
                    $method = $this->home['method'];

                } else {

                    if (($auth==true && $area=="frontend" && isset($_SESSION['users']))||
                        ($auth==true && $area=="backend" && isset($_SESSION['users']))
                        || $auth==false) {

                        $module = $activeModul;
                        $controller = $activeModul . "Controller";
                        $method = $activeMethod;
                    } else {
                        if ($area == "frontend") {
                            Header("Location:/login");
                            exit;
                        } else if ($area == "backend") {
                            Header("Location:/login");
                            exit;
                        }

                    }



                }

                if (file_exists($file = DIRECTORY . "/moduls/{$module}/controller/{$controller}.php"))
                {
                    require_once $file;

                    if (class_exists($controller))
                    {
                        $class=new $controller;

                        if (method_exists($class,$method))
                        {
                            array_shift($params);
//                            echo "<pre>";
//                            print_r($params);
                            return call_user_func_array([$class,$method],array_values($params));
                        } else {
                            echo "Method Not Found";
                            echo "<br/>";
                        }

                    } else
                        {
                            echo "Class Not Found";
                            echo "<br/>";
                        }
                } else {
                    echo "Controller Not Found";
                    echo "<br/>";
                }

            }

        }

        Header("Location:/404");
    }

}