<?php

/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */


namespace EF2\Components;


class Validation{

    private $gump;
    private $validated_data;

    public function __construct()
    {
        $this->gump = new \GUMP();
    }

    public function isValid($data=array(),$rules=array(),$filter=array())
    {
        $data=$this->gump->sanitize($data);

        $this->gump->validation_rules($rules);

        if(count($filter)>0){
            $this->gump->filter_rules($filter);
        }


        $this->validated_data = $this->gump->run($data);

        if($this->validated_data === false) {
            return false;
        } else {
            return true;
        }

    }

    public function getErrors()
    {

        return $this->gump->errors();

    }

    public function getReadableErrors()
    {

        return $this->gump->get_readable_errors(false);

    }

    public function xss_clean($data=array())
    {
        return $this->gump->xss_clean($data);
    }

    public function filter($data=array(),$filter=array())
    {
        return $this->gump->filter($data,$filter);
    }

}