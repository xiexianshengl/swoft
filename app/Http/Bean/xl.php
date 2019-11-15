<?php


namespace App\Http\Bean;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 */
class xl
{
    private $name;


    public function __construct()
    {
        echo 'xl';
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName():string
    {
        return $this->name.time();
    }
}
