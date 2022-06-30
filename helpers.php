<?php

if(!file_exists('view')) {
    function view($filePath) {
        return \Classes\View::getInstance()
            ->render($filePath);
    }
}

if(!file_exists('section')) {
  function section($key) {
    \Classes\View::getInstance()
      ->section($key);
  }
}

if(!file_exists('endSection')) {
  function endSection() {
    \Classes\View::getInstance()
      ->endSection();
  }
}

if(!file_exists('import')) {
  function import($path) {
    \Classes\View::getInstance()
      ->import($path);
  }
}

if(!file_exists('layout')) {
  function layout($layout) {
    return \Classes\View::getInstance()
      ->layout($layout);
  }
}

if(!file_exists('request')) {
  function request() {
    return \Classes\Request::getInstance();
  }
}

if(!file_exists('config')) {
  function config($property) {
    $config = include "config.php";
    $keys = explode(".", $property);
    foreach ($keys as $key) {
      if(isset($config[$key])) {
        $config = $config[$key];
        continue;
      }
      $config = null;
    }
    return $config;
  }
}

if(!file_exists('dd')) {
    function dd($data) {
        echo '<pre>';
        var_dump($data);
        die;
    }
}