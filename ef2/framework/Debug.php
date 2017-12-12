<?php

/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */
namespace EF2;

use EF2\Http\HttpException;

class Debug
{
    const
        DEVELOPMENT = true,
        PRODUCTION = false;

    private $func;
    private $isError=false;
    private $debugmode;

    public function register($const=true)
    {
        $this->debugmode=$const;

        register_shutdown_function( array($this, 'fatal_handler') );
    }

    public function fatal_handler() {
        if (ob_get_length())
            ob_clean();


        $errfile = "unknown file";
        $errstr  = "shutdown";
        $errno   = E_CORE_ERROR;
        $errline = 0;

        $error = error_get_last();

        if( $error !== NULL) {
            new HttpException(500, "Internal Server Error");
            $this->isError=true;


            $trace = $this->getTrace();

            $this->fireFunc($error,$trace);
            if($this->debugmode==true)
            {
                $htmlerror=$this->show($error,$trace);
                echo $htmlerror;
            }


        }
    }

    public function fire($func)
    {
        $this->func=$func;
    }

    private function fireFunc($error,$trace)
    {

        if($this->func!=null)
        {
            call_user_func_array($this->func, array($error,$trace));
        }
    }

    public function getTrace()
    {
        return debug_backtrace( false );
    }


    public function getIsError()
    {
        return $this->isError;
    }

    private function show($error,$trace)
    {
        $content='<html>
                    <head>
                        <meta charset="utf-8">
                    
                        <style>
                            body{
                                margin: 0px;
                            }
                    
                            .header-content{
                                padding: 20px;
                                font-size: 24px;
                                background: #13a3c6;
                                color:#fff;
                            }
                            .header-content .framework
                            {
                                font-size: 18px;
                    
                            }
                            .header-content .error{
                                margin-top:10px;
                            }
                            .header-content .line{
                                font-weight: bold;
                                margin-right: 10px;
                            }
                            .content{
                                padding: 20px;
                                font-size:18px;
                                background: #e6e88d;
                                min-height: 100%;
                            }
                        </style>
                    </head>
                    <body>
                    
                    
                    <div class="header-content">
                        <div class="framework">Eight Framework 2</div>
                        <div class="error"> <span class="line">Line '.$error["line"].':</span> '.$error["file"].'</div>
                    </div>
                    
                    <div class="content">
                        <pre>'.$error["message"].'</pre>
                    </div>
                    </body>
                    </html>';

        return $content;
    }


}