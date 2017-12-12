<?php


/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */

namespace EF2\Security;

use EF2\Core\Router\Exception;
use EF2\Security\Guard\Timepersecond;

class Guard
{
    private $redis;

    private $args=[];


    public function setRedis($redis)
    {
        $this->redis=$redis;
    }

    public function timePerRequest($namespace="",$pertimesecond=1,$requestcount=1)
    {


        $namespace="_guard_timePerRequest_".$namespace;

        $this->args["timeperrequest"]=array(
            "namespace"=>$namespace,
            "pertime"=>$pertimesecond,
            "requestcount"=>$requestcount,
        );

        return $this;
    }

    public function verify($token)
    {
        if($this->redis==null)
        {
            throw new Exception("not set redis");

        }

        foreach($this->args as $key=>$value)
        {
            if($key=="timeperrequest")
            {

                $timepersecond=new Timepersecond($this->redis,$value);

                if($timepersecond->push($token))
                {
                   return false;
                }
            }

        }

        return true;
    }


}