<?php
  
  namespace Classes;
  
  class View
  {
    static private $_instance;
    
    private $viewPath = 'views';
  
    private $layoutPath;
    
    private $params = [];
    
    private $mainContent;
    
    
    static public function getInstance()
    {
      if (self::$_instance == null) {
        self::$_instance = new self();
      }
      
      return self::$_instance;
    }
    
    public function render($path)
    {
      $this->viewPath .= DIRECTORY_SEPARATOR . str_replace(".", DIRECTORY_SEPARATOR, $path) .".php";
      return $this;
    }
    
    public function with($args)
    {
      $this->params = $args;
      return $this;
    }
    
    public function includes($path)
    {
      include "views". DIRECTORY_SEPARATOR . str_replace(".", DIRECTORY_SEPARATOR, $path). ".php";
    }
    
    public function layout($path) {
      $this->layoutPath = "views". DIRECTORY_SEPARATOR .str_replace(".", DIRECTORY_SEPARATOR, $path).".php";
      return $this;
    }
    
    public function content() {
      echo $this->mainContent;
    }
    
    public function __destruct()
    {
      extract($this->params);
      ob_start();
      include $this->viewPath;
      $this->mainContent = ob_get_contents();
      ob_end_clean();
  
      if($this->layoutPath) {
        include $this->layoutPath;
        die();
      }
      
      echo $this->mainContent;
      die();
    }
  }