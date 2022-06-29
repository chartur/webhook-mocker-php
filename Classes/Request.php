<?php


namespace Classes;

class Request
{
    private static $instance;

    private $original;

    private $method;

    private $host;

    private $path;

    private $user_agent;

    private $protocol;

    private $data = [];

    public function __construct()
    {
        $this->init();
    }

    public static function getInstance() {
        if (self::$instance == null)
        {
            self::$instance = new Request();
        }

        return self::$instance;
    }

    public function __get($name)
    {
        if(isset($this->data[$name])) {
            return $this->data[$name];
        }

        return null;
    }

    public function getOriginal() {
        return $this->original;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getHost() {
        return $this->host;
    }

    public function getUserAgent() {
        return $this->user_agent;
    }

    public function getPath() {
        return $this->path;
    }

    public function getProtocol() {
        return $this->protocol;
    }

    public function toArray() {
        return $this->data;
    }

    private function init() {
        $this->makeHost()
            ->makeMethod()
            ->makeOriginalRequest()
            ->makePath()
            ->makeProtocol()
            ->makeUserAgent()
            ->makeData();
    }

    private function makeOriginalRequest() {
        $this->original = $_SERVER;
        return $this;
    }

    private function makeMethod() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        return $this;
    }

    private function makeHost() {
        $this->host = $_SERVER['HTTP_HOST'];
        return $this;
    }

    private function makeUserAgent() {
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
        return $this;
    }

    private function makePath() {
        $this->path = $_SERVER['REQUEST_URI'];
        return $this;
    }

    private function makeProtocol() {
        $this->protocol = $_SERVER['SERVER_PROTOCOL'];
        return $this;
    }

    private function makeData() {
        $this->data = array_merge($_GET, $_POST);
        return $this;
    }
}