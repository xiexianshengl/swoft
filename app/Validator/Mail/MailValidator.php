<?php declare(strict_types=1);

namespace App\Validator\Mail;

use Swoft\Validator\Annotation\Mapping\Email;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * @Validator(name="MailValidator")
 *
 * Class MailValidator
 * @package App\Validator
 */
class MailValidator
{

    /**
     * @IsString()
     * @Email(message="邮件格式异常")
     * @var string
     */
    protected $mail;

    /**
     * @IsString(message="邮件内容异常")
     * @var string
     */
    protected $content;

    /**
     * @IsString(message="邮件标题异常")
     * @var string
     */
    protected $title;

}
