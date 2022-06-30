<?php
  
namespace Classes;

class View
{
  static private $_instance;
  
  private $mainContent;
  
  private $viewPath;

  private $layoutPath;
  
  private $activeSection;
  
  private $sections = [];
  
  private $args = [];
  
  static public function getInstance()
  {
    if (self::$_instance == null) {
      self::$_instance = new self();
    }
    
    return self::$_instance;
  }
  
  public function render($path)
  {
    $this->viewPath = "views" . DIRECTORY_SEPARATOR . str_replace(".", DIRECTORY_SEPARATOR, $path) .".php";
    return $this;
  }
  
  public function with($args)
  {
    $this->args = $args;
    return $this;
  }
  
  public function import($path)
  {
    extract($this->args);
    include "views". DIRECTORY_SEPARATOR . str_replace(".", DIRECTORY_SEPARATOR, $path). ".php";
  }
  
  public function layout($path) {
    $this->layoutPath = "views". DIRECTORY_SEPARATOR .str_replace(".", DIRECTORY_SEPARATOR, $path).".php";
    return $this;
  }
  
  public function section($key) {
    $this->activeSection = $key;
    extract($this->args);
    ob_start();
  }
  
  public function endSection() {
    $this->sections[$this->activeSection] = ob_get_contents();
    ob_end_clean();
    $this->activeSection = null;
  }
  
  public function getSection($key) {
    if(isset($this->sections[$key])){
      echo $this->sections[$key];
    }
  }
  
  public function __destruct()
  {
    extract($this->args);
    ob_start();
    include $this->viewPath;
    $this->mainContent = ob_get_contents();
    ob_end_clean();

    if($this->layoutPath) {
      include $this->layoutPath;
      die();
    }
    foreach ($this->sections as $section) {
      echo $section;
    }
    die();
  }
}