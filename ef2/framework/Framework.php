<?php

/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */

namespace EF2;

use EF2\Http\HttpException;
use EF2\Core\DI;
use EF2\Core\DI\DISingleton;
use EF2\Http\Request;
use EF2\Http\Response;
use PHPImageWorkshop\ImageWorkshop;

define('EF2_PATH', dirname(__FILE__));

class Framework
{

    /**
     * @var controller
     */
    public static $controller;

    /**
     * @var action
     */
    public static $action;


    public function register()
    {

        $this->includeFile();
        $this->autoloadRegister();

    }

    /**
     * @return void
     */
    public function make()
    {

        $this->router();
        $this->command();

    }


    private function includeFile()
    {

        require EF2_PATH . "/Autoload.php";
    }

    private function autoloadRegister()
    {
        $autoload = new Autoload;
        $autoload->register();
    }

    /**
     * @return HttpException|void
     */
    private function router()
    {

        $router = DI::resolve("router");


        if ($router != false) {

            $excontroller=explode("/",DI::resolve("router")->getControllerName());

            if(count($excontroller)==1)
            {

                self::$controller = ucfirst(DI::resolve("router")->getControllerName()) . "Controller";

            }else{
                self::$controller =DI::resolve("router")->getControllerName(). "Controller";
                self::$controller=str_replace("/","\\",self::$controller);

            }

            self::$action = "action" . ucfirst(DI::resolve("router")->getActionName());

        }else{
            throw new HttpException(404, "not bind DI 'router'");
        }

    }

    /**
     *
     * @return HttpException|void
     */
    private function command()
    {


        if (!$this->isController()) {

            throw new HttpException(404, "Controller Not Found");

        }

        $this->controllerAction();
    }


    /**
     *
     * @return bool
     */
    private function isController()
    {

        if (class_exists(self::$controller)) {


            return true;

        } else {

            return false;
        }
    }

    /**
     *
     * @return HttpException|void
     */
    public function controllerAction()
    {

        if (method_exists(self::$controller, self::$action)) {

            $this->runAction();

        } else {

            throw new HttpException(404, "Page Not Found");

        }
    }


    /**
     *
     * @return void
     */
    private function runAction()
    {

        if(DI::has("debug"))
        {
            ob_start();
            $this->beforeAction();
            DISingleton::make(self::$controller, self::$action);
            $content = ob_get_contents();
            ob_end_clean();

            if(!DI::resolve("debug")->getIsError() && count(error_get_last())==0)
            {
                echo $content;
            }

        }else{

            $this->beforeAction();
            DISingleton::make(self::$controller, self::$action);

        }


    }

    private function beforeAction()
    {

        if (DI::has("template")) {
            $template = DI::resolve("template");
            $template->register();
        }

        DI::singleton("request", function () {

            return new Request;

        })->resolveWhen("Request");

        DI::singleton("response", function () {

            return new Response;

        })->resolveWhen("Response");
    }

}