<?php

namespace EF2\Http\Request;

class Get
{

    public function __get($name)
    {

        return $_GET[$name];

    }

    public function all()
    {
        return $_GET;
    }
}