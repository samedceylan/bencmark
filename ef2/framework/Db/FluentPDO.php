<?php

namespace EF2\Db;

class FluentPDO
{
    public static $fluent;

    public static $pdo;

    public function __construct($connectstring,$username,$password,$params=array())
    {
        self::$pdo= new \PDO($connectstring,$username,$password,$params);

        self::$fluent = new \FluentPDO(self::$pdo);

    }

    public  static function createCommand($command,$params=array())
    {
        $query=self::$pdo->prepare($command);
        foreach($params as $key=>$value)
        {
            $query->bindValue($key,$value);
        }
        $query->execute();
        return $query;

    }


}