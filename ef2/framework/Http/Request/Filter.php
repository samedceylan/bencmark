<?php

namespace EF2\Http\Request;

use EF2\Http\Request\Filter\Get;
use EF2\Http\Request\Filter\Post;

class Filter
{
    public $get;
    public $post;

    public function __construct()
    {
        $this->get=new Get;
        $this->post=new Post;
    }


}