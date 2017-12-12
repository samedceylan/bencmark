<?php

/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */

namespace EF2\Core;


class Controller
{
    private $template;


    private function loadTemplate()
    {

       $this->template=DI::resolve("template");

    }

    public function render($view,$params=array())
    {
        if(DI::has("template"))
        {
            $this->loadTemplate();
            echo $this->template->getFactory()->make($view, $params)->render();
        }else{
            throw new HttpException(404, "not bind DI 'template'");
        }
    }
}