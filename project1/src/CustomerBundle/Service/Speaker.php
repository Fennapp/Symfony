<?php
namespace CustomerBundle\Service;

class Speaker
{
    private $name;

    public function __construct($name)
    {
            $this->name = $name;
    }

    public function sayMyName()
    {        
        return $this->name;
        
    }
}


?>