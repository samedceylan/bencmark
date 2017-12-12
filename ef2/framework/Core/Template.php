<?php

namespace EF2\Core;

use EF2\Core\Router\Exception;
use EF2\Template\FileViewFinder;
use EF2\Template\Factory;
use EF2\Template\Compilers\BladeCompiler;
use EF2\Template\Engines\CompilerEngine;
use EF2\Template\Filesystem;
use EF2\Template\Engines\EngineResolver;
use EF2\Http\HttpException;

class Template
{
    private $view_path=[];

    private $cache_path;

    private $factory;

    public function setViewPath($dirarr)
    {
        $this->view_path=$dirarr;
    }

    public function setCachePath($dir)
    {
        $this->cache_path=$dir;
    }

    public function getViewPath()
    {
        return $this->view_path;
    }

    public function getCachePath()
    {
        return $this->cache_path;
    }

    public function register()
    {

        if(!file_exists($this->cache_path))
        {
            throw new Exception( "cache directory not found");
        }

        if(!is_array($this->view_path))
        {
            throw new Exception("view directory not found ");
        }

        if(count($this->view_path)==0)
        {
            throw new Exception("view directory not found ");
        }

        foreach($this->view_path as $key=>$value)
        {
            if(!file_exists($value))
            {
                throw new Exception("view directory not found ".$value);
            }
        }


        require_once EF2_PATH."/Template/helpers.php";


        $file = new Filesystem;
        $compiler = new BladeCompiler($file, $this->cache_path);

        // you can add a custom directive if you want
        $compiler->directive('datetime', function($timestamp) {
            return preg_replace('/(\(\d+\))/', '<?php echo date("Y-m-d H:i:s", $1); ?>', $timestamp);
        });

        $resolver = new EngineResolver;
        $resolver->register('blade', function () use ($compiler) {
            return new CompilerEngine($compiler);
        });

        // get an instance of factory
        $this->factory = new Factory($resolver, new FileViewFinder($file, $this->view_path));

        // if your view file extension is not php or blade.php, use this to add it
        $this->factory->addExtension('tpl', 'blade');


    }

    /**
     * @return mixed
     */
    public function getFactory()
    {
        return $this->factory;
    }
}