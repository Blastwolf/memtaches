<?php

class Router
{

    private $_query;
    private $_queryArray;
    private $_controller;
    private $_method;
    private $_params;
    private $_default_controller = DEFAULT_CONTROLLER;

    function __construct($path)
    {
        $this->setQuery($path);
        $this->setQueryArray();
        $this->setController();
        $this->setMethod();
        $this->setParams();
        $this->setupTheRoute();

//        print_r($this->getQueryArray());
//        echo "<br/> controller : {$this->getController()} method : {$this->getMethod()}<br/>";
//        echo 'method : ', $this->getMethod();
//        print_r($this->getParams());

    }

    public function setupTheRoute()
    {
        if (file_exists('app/controllers/'.$this->getController().'.php')) {
            $controllerName = $this->getController();
            $controller = new $controllerName;
        } else {
            throw new Exception("Le controlleur n\'existe pas !{$this->getQuery()},{$this->getController()}");
        }

        if(method_exists($controller,$this->getMethod())) {

            $method = $this->getMethod();
            if (!empty($this->getParams())) {
                $controller->$method(...$this->getParams());
            } else {
                $controller->$method();
            }

        }else{
            throw new Exception('method invalid');
        }
    }


    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->_query;
    }

    /**
     * @param string $query
     */
    public function setQuery($query)
    {
        $this->_query = trim($query, '/');
    }

    /**
     * @return array
     */
    public function getQueryArray()
    {
        return $this->_queryArray;
    }

    /**
     * @param void
     */
    public function setQueryArray()
    {
        $this->_queryArray = explode('/', $this->getQuery());
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * @param void
     * @return string
     */
    public function setController()
    {
        if (!empty($this->getQueryArray()[0])) {
          return $this->_controller = ucfirst($this->getQueryArray()[0]).'_controller';
        }
        return $this->_controller = $this->_default_controller;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->_method;
    }

    /**
     * @param void
     * @return string
     */
    public function setMethod()
    {
        if (!empty($this->getQueryArray()[1])) {
          return $this->_method = $this->getQueryArray()[1];
        }
        return $this->_method = 'index';
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * @param void
     */
    public function setParams()
    {
        if (!empty($this->getQueryArray()[2])) {

            $params = $this->getQueryArray();
            for ($i = 2; $i < count($params); $i++) {
                $this->_params[] = $params[$i];
            }
        }

    }


}