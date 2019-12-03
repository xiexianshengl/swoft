<?php declare(strict_types=1);

namespace App\Rpc\Lib;

/**
 * Interface EmailInterface
 * @package App\Rpc\Lib
 */
interface MailInterface
{

    /**
     * @param string $mail
     * @param string $content
     * @param string $title
     * @return bool
     */
    public function sendMail(string $mail,string $content,string $title): bool ;

}
