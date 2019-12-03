<?php declare(strict_types=1);

namespace App\Rpc\Service;

use App\Rpc\Lib\MailInterface;
use App\Validator\Mail\MailValidator;
use Swoft\Log\Helper\Log;
use Swoft\Rpc\Server\Annotation\Mapping\Service;


/**
 * Class MailService
 *
 * @Service()
 *
 * @package App\Rpc\Service
 */
class MailService implements MailInterface
{
    /**
     * @param string $mail
     * @param string $content
     * @param string $title
     * @return bool
     * @throws \Swoft\Validator\Exception\ValidatorException
     */
    public function sendMail(string $mail, string $content, string $title): bool
    {

        $data = ['mail'=>$mail,'content'=>$content,'title'=>$title];

        validate($data,'MailValidator');

        sgo(function () use ($mail,$content,$title){

            $transport = (new \Swift_SmtpTransport(config('email_host'), config('email_port')))
                ->setUsername(config('email_user'))
                ->setPassword(config('email_pass'));

            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);

            // Create a message
            $message = (new \Swift_Message($title))
                ->setFrom([config('email_user') => config('email_user')])
                ->setTo([$mail])
                ->setBody($content,"text/html")
            ;

            // Send the message
            $result = $mailer->send($message);

            $data = ['content'=>$content,'title'=>$title];
           var_dump(Log::pushLog($mail, json_encode($data)));

        });


        return true;
    }


}

