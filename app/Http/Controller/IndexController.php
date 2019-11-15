<?php


namespace App\Http\Controller;

use App\Http\Bean\xl;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft;

/**
 *@Controller()
 */
class IndexController
{

    /**
     * @RequestMapping("/bean")
     */
    public function bean()
    {
        $bean = Swoft::getBean(xl::class);
        $bean->setName('xl ...');
        return $bean->getName();
    }

    /**
     * @Swoft\Bean\Annotation\Mapping\Inject()
     * @var xl
     */
    private $xl;


    /**
     * @RequestMapping("/getBean")
     */
    public function getBean()
    {
        $this->xl->setName('xllll');
        return $this->xl->getName();
    }
}
