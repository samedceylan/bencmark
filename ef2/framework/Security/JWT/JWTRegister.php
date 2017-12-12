<?php

namespace EF2\Security\JWT;

class JWTRegister
{
    public $redis;

    public function __construct($redis)
    {
        $this->redis=$redis;
    }

    public function login($token,$duration)
    {
        $this->redis->set($this->getTokenKey(),$token,$duration);
        $this->redis->set($this->getTokenTtlKey(),$duration,$duration);
    }

    public function control($token)
    {
        if($gettoken=$this->redis->get($this->getTokenKey()))
        {
            if($gettoken==$token){
                $this->setExpire();
                return true;
            }
        }
    }

    private function setExpire()
    {
        if($duration=$this->redis->get($this->getTokenTtlKey()))
        {
            $this->redis->getRedis()->expire($this->getTokenKey(),$duration);
        }

    }

    private function getTokenKey()
    {
        return "JWTToken_token_";
    }

    private function getTokenTtlKey()
    {
        return "JWTToken_token_ttl_";
    }

}