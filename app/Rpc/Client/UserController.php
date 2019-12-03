<?php


namespace App\Rpc\Client;


use App\Rpc\Lib\MailInterface;
use App\Rpc\Lib\UserInterface;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Rpc\Client\Annotation\Mapping\Reference;

/**
 * @Controller()
 *
 * @since 2.0
 * Class UserController
 * @package App\Rpc\Client
 */
class UserController
{
    /**
     * @Reference(pool="user.pool")
     * @var UserInterface
     */
    private $userservice;

    /**
     * @var MailInterface
     */
    private $mailservice;
    /**
     *
     * @RequestMapping("/client")
     */
    public function getList():array
    {
        $result = $this->userservice->getList('1','type');

        var_dump($result);
        return [$result];
    }


}
