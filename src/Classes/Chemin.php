<?php

namespace App\Classes;

class Chemin
{
    private $route;
    private $params;

    public function __construct()
    {        
    }

    public function setRoute(string $route)
    {
        $this->route = $route;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getParams()
    {
        return $this->params;
    }
}
