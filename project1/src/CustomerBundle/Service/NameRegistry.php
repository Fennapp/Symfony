<?php

namespace CustomerBundle\Service;

class NameRegistry
{
    private $names;

    public function __construct()
    {
        $this->names = [
            'le papa',
            'la mama',
            'Jean-Franck',
        ];
    }

     public function getRandomName()
    {
        return $this->names[rand(0, count($this->names) - 1)];
    }
}
?>