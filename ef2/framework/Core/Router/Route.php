<?php
/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */

namespace EF2\Core\Router;

use Exception;

class Route
{
    private static $routes=[];
    private static $prefix="";

    public static function get($pattern,$params)
    {
        $pattern=self::getPattern($pattern);
        $params=self::getParams($params);

        self::$routes[]=[
            "pattern"=>$pattern,
            "params"=>$params,
            "via"=>"GET"
        ];

    }

    public static function post($pattern,$params)
    {
        $pattern=self::getPattern($pattern);
        $params=self::getParams($params);

        self::$routes[]=[
            "pattern"=>$pattern,
            "params"=>$params,
            "via"=>"POST"
        ];
    }

    public static function put($pattern,$params)
    {
        $pattern=self::getPattern($pattern);
        $params=self::getParams($params);

        self::$routes[]=[
            "pattern"=>$pattern,
            "params"=>$params,
            "via"=>"POST"
        ];
    }

    public static function group($params,$func)
    {
        if(isset($params["prefix"]))
        {
            self::$prefix=$params["prefix"];
        }

        $func();

        self::$prefix="";
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    private static function getParams($params)
    {
        if(!is_array($params))
        {
            $ex1=explode("@",$params);


            $params=[];
            if(count($ex1)>1)
            {
                $params["controller"]=$ex1[0];
                $params["action"]=$ex1[1];
            }
        }

        if(isset($params["controller"])){
            new Exception("route not controller");
        }elseif(isset($params["action"])){
            new Exception("route not action");
        }
        return $params;
    }

    private static function getPattern($pattern)
    {

        if(empty(self::$prefix))
        {
            return $pattern;
        }else{
            return "/".self::$prefix.$pattern;
        }


    }


}