<?php

/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */

namespace EF2\Http;

use EF2\Http\Request\Get;
use EF2\Http\Request\Post;
use EF2\Http\Request\Filter;

class Request
{

    private $security;

    public $get;
    public $post;
    public $filter;


    public function __construct()
    {

        $this->get=new Get;
        $this->post=new Post;
        $this->filter=new Filter;

    }




}