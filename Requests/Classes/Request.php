<?php

namespace Http;

class Request
{

    public $method;

    public function __construct(array $args,$method){

        foreach($args as $argKey=>$argValue) {
            $this->__set($argKey,$argValue);
        }

    }


    public function __set($name,$value)
    {
        $this->$name = $value;
    }

    public function getMethod() 
    {
        return ($_POST === 'POST' || $_POST === 'post')?'POST':'GET';
    }

}