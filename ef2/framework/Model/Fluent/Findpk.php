<?php

namespace EF2\Model\Fluent;

use EF2\Db\FluentPDO;

class Findpk
{
    private $pkname;
    private $pkid;
    private $artributes;
    private $tablename;

    public function __construct($tablename,$pkname,$pkid,$artributes)
    {

        $this->tablename=$tablename;
        $this->pkname=$pkname;
        $this->pkid=$pkid;
        $this->artributes=$artributes;
    }

    public function __set($name,$value)
    {
        $this->artributes[$name]=$value;
    }

    public function __get($name)
    {
        return $this->artributes[$name];
    }

    public function update()
    {
        return FluentPDO::$fluent->update($this->tablename)->set($this->artributes)->where($this->pkname, $this->pkid)->execute();

    }

    public function delete()
    {
        return FluentPDO::$fluent->deleteFrom($this->tablename)->where($this->pkname, $this->pkid)->execute();
    }

}