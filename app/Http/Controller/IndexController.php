<?php


namespace App\Http\Controller;

use App\Http\Bean\xl;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft;
use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\Db\DB;

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

    /**
     * * @RequestMapping("/request")
     * @param Request $request
     * @param Response $response
     * @return array|mixed|string
     */
    public function request(Request $request,Response $response)
    {

//        var_dump($request->isGet());
        var_dump($request->input());

        return $response->redirect("https://www.baidu.com",302);
    }

    /**
     * @RequestMapping("/getsql")
     */
    public function sqlGet()
    {
        return DB::table('tsp_spro_serv')->get();
    }

    /**
     * @RequestMapping("/setredis")
     */
    public function redisSet()
    {

    }

    /**
     * @RequestMapping("/email")
     */
    public function mail()
    {
// Create the Transport

        $rand = mt_rand(0000,9999);

        $str_tmp = "";
        $str_tmp = $str_tmp . "<div class=\"details\">";
        $str_tmp = $str_tmp . "<div class=\"auth\">【验证码】" . $rand . "</div>";
        $str_tmp = $str_tmp . "<div class=\"greetings\">亲爱的百礼汇积分云用户：</div>";
        $str_tmp = $str_tmp . "<div class=\"main_auth\">您本次的验证码为：<span>" . $rand . "</span></div>";
        $str_tmp = $str_tmp . "<div>请于30分钟内输入，工作人员不会向您索取，请勿泄露</div>";
        $str_tmp = $str_tmp . "<div class=\"service\">我们会努力为您提供更好的服务。如有任何问题请联系客服：<a href=\"mailto:service@fensaas.com\">" . 66666 . "</a></div>";
        $str_tmp = $str_tmp . "<div>【百礼汇积分云】账户中心</div>";
        $str_tmp = $str_tmp . "</div>";
        $str_tmp = $str_tmp . "</body>";
        $str_tmp = $str_tmp . "<style>
.details{
	padding:15px;
	font-size:14px;
	font-family:\"微软雅黑\";
	color:#000;
}
.details div{
	line-height:24px
}
.auth,.partingline{
	margin-bottom:20px
}
.greetings{
	margin-bottom:30px
}
.main_auth span{
	font-size:20px;
	font-weight:bold;
	border-bottom:1px dashed #ccc;
}
.service{
	margin:20px 0 60px 0;
}
.service a{
	color: #1e5494;
}";
        $str_tmp = $str_tmp . "</style>";

        $transport = (new \Swift_SmtpTransport('smtp.exmail.qq.com', 25))
            ->setUsername('system@fensaas.com')
            ->setPassword('Fensaas2018');

// Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

// Create a message
        $message = (new \Swift_Message('邮件发送测试'))
            ->setFrom(['system@fensaas.com' => 'system@fensaas.com'])
            ->setTo(['13310251973@163.com'=>'xl'])
            ->setBody($str_tmp,"text/html")
        ;

// Send the message
        $result = $mailer->send($message);
        return $result;
    }

    /**
     * @RequestMapping("/sgo")
     */
    public function sGo()
    {

        $i = 0;

        sgo(function (){
            DB::select("select sleep(5)");
            echo '2';
        });



        echo $i.'----';

    }
}
