<?php

namespace EF2\Http\Request\Filter;

use EF2\Http\Security;

class Get
{


    private $security;
    public function __construct()
    {

        $this->security=new Security;

    }

    public function __get($name)
    {

        return $this->security->scan($_GET[$name]);

    }

    public function all()
    {
        $filter=array();
        foreach ($_GET as $key => $value) {
            $filter[$key]= $this->security->scan($value);
        }

        return $filter;
    }
}