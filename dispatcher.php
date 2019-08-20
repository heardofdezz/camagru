<?php

class Dispatcher
{
    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);

        $controller = $this->loadController();
        if($this->request->action){
             call_user_func_array([$controller, $this->request->action], $this->request->params);
            $controller->render($this->request->action);
        }
        else{
            $controller->render("index");
        }
     
    }

    public function loadController()
    {
        $name = $this->request->controller. "Controller";
        // var_dump($name);
        $file = ROOT . 'Controllers/' . $name . '.php';

        require_once($file);
        $controller = new $name();
        return $controller;
    }
}
?>