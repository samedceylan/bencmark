<?php

namespace EF2\Http\Request;

class Post
{

    public function __get($name)
    {
        $post=$this->post();
        return $post[$name];

    }

    public function all()
    {
        return $this->post();
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