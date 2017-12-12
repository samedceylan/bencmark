<?php

namespace EF2\Model;

use EF2\Db\FluentPDO;
use EF2\Model\Fluent\Findpk;

class Fluent
{

    private $columns;

    public $artributes=[];

    public function __construct()
    {
        $columns=$this->getColumns();
        foreach($columns as $key=>$value)
        {
            $this->columns[]=$value["Field"];
        }

    }

    public function __set($name,$value)
    {

        if(in_array($name,$this->columns))
        {
            $this->artributes[$name]=$value;
        }
    }

    public function __get($name)
    {
        if(in_array($name,$this->columns))
        {
           return  $this->artributes[$name];
        }
    }


    public static function model()
    {

        return FluentPDO::$fluent->from(self::getTableName());
    }

    public static function find($id)
    {

        $pk=self::getPk();

        $artributes=FluentPDO::$fluent->from(self::getTableName())->where($pk["Column_name"],$id)->fetch();

        return new Findpk(self::getTableName(),$pk["Column_name"],$id,$artributes);
    }

    private static function getPk()
    {
        return FluentPDO::$pdo->query("SHOW KEYS FROM ".self::getTableName()." WHERE Key_name = 'PRIMARY'")->fetch(\PDO::FETCH_ASSOC);
    }

    private function getColumns()
    {
       return FluentPDO::$pdo->query("SHOW columns FROM ".self::getTableName())->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function save()
    {
        $result=FluentPDO::$fluent->insertInto(self::getTableName())->values($this->artributes)->execute();
        $lastid= FluentPdo::$fluent->getPdo()->lastInsertId();;
        $pk=self::getPk();
        $this->artributes[$pk["Column_name"]]=$lastid;
        return $result;

    }

    private static function getTableName()
    {
        if(isset(static::$table))
        {
            return static::$table;
        }
        return strtolower(get_called_class());
    }


}