<?php

class SwapiException extends Exception
{

    private $error_list;

    public function __construct($message, $error_list = array())
    {
        $this->error_list = $error_list;
        parent::__construct($message, null, null);
    }

    public function getErrorList()
    {
        return $this->error_list;
    }

}
