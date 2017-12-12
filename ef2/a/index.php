<?php


use EF2\Framework;
use EF2\Core\DI;
use EF2\Core\Router;
use EF2\Core\Loader;
use EF2\Http\HttpException;


/* framework include */
$framework_path=dirname(__FILE__).'/../framework';
require_once $framework_path.'/Framework.php';

$ef2=new Framework;
$ef2->register();


/* loader */


DI::bind("loader",function(){

    $loader=new Loader;
    $loader->setDir(array(
        dirname(__FILE__)."/controller/",
    ));
    $loader->register();
    return $loader;

});



/* route ayarlama. açılış controller ve action */
$baseUrl=baseUrl();
DI::bind("router",function()use($baseUrl){
    $router = new Router;
    $router->setDefaultController('site');
    $router->setDefaultAction('index');
    $router->handle($baseUrl);
    return $router;
});



function baseUrl()
{

    $uri=str_replace("/index.php", "", $_SERVER["SCRIPT_NAME"]);

    return str_replace($uri, "", $_SERVER['REQUEST_URI']);
}

try{

    $ef2->make();

}catch(HttpException $e)
{
    echo $e->getHttpCode()." ".$e->getMsg();
}