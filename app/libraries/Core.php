<?php

/*
 *
 * App Core Class
 * Creates URL & loads core controller
 * URL Format - /controller/method/params
 *
 */

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();
        // look in controllers for first value as controller
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            $this->currentController = ucwords($url[0]);
            // unset 0 index - destroy it
            unset($url[0]);
        }

        // require controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        // instantiate controller class
        $this->currentController = new $this->currentController;

        // assign controller method based on second part of url array
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                // unset 1 index - destroy it
                unset($url[1]);
            }
        }

        // get params
        $this->params = $url ? array_values($url) : [];
        // callback with array of params of undetermined length
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
       if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
       }
    }
}