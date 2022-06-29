<?php

use \Controllers\HomeController as DefaultController;

class MVC
{

    private $defaultController = DefaultController::class; // HomeController
    private $defaultActionName = 'index'; // "index" method of HomeController object

    private $uri;
    private $segments; // []
    private $params = []; // []

    private $hasController; // false
    private $hasAction; // false

    private $controller; // HomeController::object
    private $action; // HomeController::object->index()


    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->uri = explode("?", $this->uri)[0];
        $this->segments = explode('/', $this->uri);
        $this->segments = array_values(array_filter($this->segments)); // []
    }

    public function init()
    {
        try {
            $this->checkControllerAndActionExisting()
                ->selectController() // find controller
                ->selectAction()
                ->sendParamsToAction();
        } catch (Exception $exception) {
            echo $exception->getMessage();die; // no controller or action exist
        }
    }

    private function checkControllerAndActionExisting()
    {
        $segments_count = count($this->segments); // 0
        switch ($segments_count) {
            case 0: // <-- here
                $this->hasController = false;
                $this->hasAction = false;
                break;
            case 1:
                $this->hasController = true;
                $this->hasAction = false;
                break;
            default:
                $this->hasController = true;
                $this->hasAction = true;
        }

        if($segments_count > 2) { // <-- no here
            $this->params = array_splice($this->segments, 2, count($this->segments));
        }
        return $this;
    }

    private function selectController()
    {
        $controller = null; // null
        if (!$this->hasController) { // <-- here
            $controller = $this->defaultController; // HomeController::class
        } else {
            $controllerNameFromParam = ucwords(strtolower($this->segments[0])); // GagC
            $controller = '\Controllers\\'. $controllerNameFromParam .'Controller';
        }

        if(!class_exists($controller)) { // <-- no here
            throw new Exception('Controller not found', 404);
        }

        $this->controller = new $controller; // HomeController::object

        return $this;
    }

    private function selectAction()
    {
        $action = null; // null
        if (!$this->hasAction) { // <-- here
            $action = $this->defaultActionName; // index
        } else {
            $action = strtolower($this->segments[1]);
        }

        if(!method_exists($this->controller, $action)) { // <-- no here
            throw new Exception('Action not found', 404);
        }

        $this->action = $action;
        return $this;
    }

    private function sendParamsToAction()
    {
        call_user_func_array([$this->controller, $this->action], $this->params); // HomeController::object->index('artur', 'gago')
    }
}