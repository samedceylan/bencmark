<?php

namespace EF2\Http\Request\Filter;

use EF2\Http\Security;

class Post
{
    private $security;
    public function __construct()
    {

        $this->security=new Security;

    }

    public function __get($name)
    {
        $post=$this->post();
        return $this->security->scan($_POST[$name]);

    }

    public function all()
    {
        $post=$this->post();
        $filter=array();
        foreach ($post as $key => $value) {
            $filter[$key]= $this->security->scan($value);
        }

        return $filter;
    }

    private function post()
    {
        if($_POST)
        {
            return $_POST;
        }

        $raw=json_decode(file_get_contents('php://input'),true);

        if(is_array($raw))
        {
            return $raw;
        }

        return array();
    }
}