<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name Activation.php
 * Time: 4:34 PM
 */
namespace app\common\library;
use think\Facade\Cache;
use think\Facade\Log;
/**
 * Class Activation
 *
 * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
 *
 */
class Activation
{
    /**
     * 发送激活码链接   用户激活后在发送商户信息
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param object $user
     * @return bool
     */
    public function sendActiveCode($user){
        //收件人邮箱
        $toemail    =   $user->account;
        //发件人昵称
        $name       =   !empty($user->nickname)? $user->nickname:'Cmpay';
        //邮件标题
        $subject    =   "【蚂蚁推送】用户注册 - 注册邮箱验证";
        //邮件主体  也可以使用邮件模板文件
        $content =  self::getRegActiveContent($user);
        //读数据库配置
        $config = config();
        //发送激活邮件
        try{
            return Mail::getInstance(config('code.Email'))->send($toemail,$name,$subject,$content);
        }catch (\Exception $exception){
            Log::error("Active Code Error:".$exception->getMessage());
            return false;
        }
    }
    /**
     * 激活成功返回
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param $user
     *
     * @return bool
     */
    public function sendRegCallback($user){
        //收件人邮箱
        $toemail    =   $user->account;
        //发件人昵称
        $name       =   !empty($user->nickname)? $user->nickname:'PushAnt';
        //邮件标题
        $subject    =   "【蚂蚁推送】用户注册 - 注册成功通知";
        //邮件主体  也可以使用邮件模板文件
        $content = self::getRegCallbackContent($user);
        //发送激活邮件
        try{
            return Mail::getInstance(config('code.Email'))->send($toemail,$name,$subject,$content);
        }catch (\Exception $exception){
            Log::error("Active Code Error:".$exception->getMessage());
            return false;
        }
    }
    /**
     * 注册成功内容
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     *
     * @return string
     */
    private function getRegCallbackContent($user){
        return '<div id="mailContentContainer" class="qmbox qm_con_body_content qqmail_webmail_only" style="">
<style type="text/css">
       .qmbox .ExternalClass,.qmbox .ExternalClass div,.qmbox .ExternalClass font,.qmbox .ExternalClass p,.qmbox .ExternalClass span,.qmbox .ExternalClass td,.qmbox h1,.qmbox img{line-height:100%;}.qmbox h1,.qmbox h2{display:block;font-family:Helvetica;font-style:normal;font-weight:700;}.qmbox #outlook a{padding:0;}.qmbox .ExternalClass,.qmbox .ReadMsgBody{width:100%;}.qmbox a,.qmbox blockquote,.qmbox body,.qmbox li,.qmbox p,.qmbox table,.qmbox td{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;}.qmbox table,.qmbox td{mso-table-lspace:0;mso-table-rspace:0;}.qmbox img{-ms-interpolation-mode:bicubic;border:0;height:auto;outline:0;text-decoration:none;}.qmbox table{border-collapse:collapse!important;}.qmbox #bodyCell,.qmbox #bodyTable,.qmbox body{height:100%!important;margin:0;padding:0;width:100%!important;}.qmbox #bodyCell{padding:20px;}.qmbox #templateContainer{width:600px;border:1px solid #ddd;background-color:#fff;}.qmbox #bodyTable,.qmbox body{background-color:#FAFAFA;}.qmbox h1{color:#202020!important;font-size:26px;letter-spacing:normal;text-align:left;margin:0 0 10px;}.qmbox h2{color:#404040!important;font-size:20px;line-height:100%;letter-spacing:normal;text-align:left;margin:0 0 10px;}.qmbox h3,.qmbox h4{display:block;font-style:italic;font-weight:400;letter-spacing:normal;text-align:left;margin:0 0 10px;font-family:Helvetica;line-height:100%;}.qmbox h3{color:#606060!important;font-size:16px;}.qmbox h4{color:grey!important;font-size:14px;}.qmbox .headerContent{background-color:#f8f8f8;border-bottom:1px solid #ddd;color:#505050;font-family:Helvetica;font-size:20px;font-weight:700;line-height:100%;text-align:left;vertical-align:middle;padding:0;}.qmbox .bodyContent,.qmbox .footerContent{font-family:Helvetica;line-height:150%;text-align:left;}.qmbox .footerContent{text-align:center;}.qmbox .bodyContent pre{padding:15px;background-color:#444;color:#f8f8f8;border:0;}.qmbox .bodyContent pre code{white-space:pre;word-break:normal;word-wrap:normal;}.qmbox .bodyContent table{margin:10px 0;background-color:#fff;border:1px solid #ddd;}.qmbox .bodyContent table th{padding:4px 10px;background-color:#f8f8f8;border:1px solid #ddd;font-weight:700;text-align:center;}.qmbox .bodyContent table td{padding:3px 8px;border:1px solid #ddd;}.qmbox .table-responsive{border:0;}.qmbox .bodyContent a{word-break:break-all;}.qmbox .headerContent a .yshortcuts,.qmbox .headerContent a:link,.qmbox .headerContent a:visited{color:#1f5d8c;font-weight:400;text-decoration:underline;}.qmbox #headerImage{height:auto;max-width:600px;padding:20px;}.qmbox #templateBody{background-color:#fff;}.qmbox .bodyContent{color:#505050;font-size:14px;padding:20px;}.qmbox .bodyContent a .yshortcuts,.qmbox .bodyContent a:link,.qmbox .bodyContent a:visited{color:#1f5d8c;font-weight:400;text-decoration:underline;}.qmbox .bodyContent a:hover{text-decoration:none;}.qmbox .bodyContent img{display:inline;height:auto;max-width:560px;}.qmbox .footerContent{color:grey;font-size:12px;padding:20px;}.qmbox .footerContent a .yshortcuts,.qmbox .footerContent a span,.qmbox .footerContent a:link,.qmbox .footerContent a:visited{color:#606060;font-weight:400;text-decoration:underline;}@media only screen and (max-width:640px){.qmbox h1,.qmbox h2,.qmbox h3,.qmbox h4{line-height:100%!important;}.qmbox #templateContainer{max-width:600px!important;width:100%!important;}.qmbox #templateContainer,.qmbox body{width:100%!important;}.qmbox a,.qmbox blockquote,.qmbox body,.qmbox li,.qmbox p,.qmbox table,.qmbox td{-webkit-text-size-adjust:none!important;}.qmbox body{min-width:100%!important;}.qmbox #bodyCell{padding:10px!important;}.qmbox h1{font-size:24px!important;}.qmbox h2{font-size:20px!important;}.qmbox h3{font-size:18px!important;}.qmbox h4{font-size:16px!important;}.qmbox #templatePreheader{display:none!important;}.qmbox .headerContent{font-size:20px!important;line-height:125%!important;}.qmbox .footerContent{font-size:14px!important;line-height:115%!important;}.qmbox .footerContent a{display:block!important;}.qmbox .hide-mobile{display:none;}}
</style>
<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
    <tbody>
    <tr>
        <td align="center" valign="top" id="bodyCell">
            <table border="0" cellpadding="0" cellspacing="0" id="templateContainer">
                <tbody>
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">
                            <tbody>
                            <tr>
                                <td valign="top" class="headerContent">
                                    <a href="https://pay.iredcap.cn" rel="noopener" target="_blank">
                                    </a>
                                    <img src="https://pay.iredcap.cn/static/logo-color.png" style="max-width:600px;padding:20px"
                                         id="headerImage">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                            <tbody>
                            <tr>
                                <td valign="top" class="bodyContent">
                                    <p>
                                        Dear '. $user->username . ',
                                    </p>
                                    <p>
                                        欢迎加入,在开始使用之前，请确认你的账号
                                    </p>
                                    <p>
                                        操作安全码:
                                        <b>
                                            <span style="border-bottom:1px dashed #ccc;z-index:1" t="7" onclick="return false;"
                                                  data="'. $user->auth_code . '">
                                                '. $user->auth_code . '
                                            </span>
                                        </b>
                                    </p>
                                    <p>
                                        商户UID： '. $user->uid . '
                                        <br>
                                        注册邮箱： '. $user->account . '
                                        <br>
                                        商户名称： '. $user->username . '
                                   
                                    </p>
                                    <p>
                                        彻底告别繁琐的支付接入流程，一次接入所有主流支付渠道和分期渠道，99.99% 系统可用性，满足你丰富的交易场景需求，为你的用户提供完美支付体验。
                                    </p>
                                    <p>
                                        <br>
                                        小红帽科技
                                        <br>
                                        咨询邮箱: <a href="mailto:me@iredcap.cn" style="color:#35c8e6; text-decoration: none;" target="_blank" rel="noopener"> me@iredcap.cn </a>
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">
                            <tbody>
                            <tr>
                                <td valign="top" class="footerContent">
                                    <a href="https://pay.iredcap.cn/" rel="noopener" target="_blank">访问首页</a>
                                    <span class="hide-mobile">|</span>
                                    <a href="https://pay.iredcap.cn/login.html" rel="noopener" target="_blank">登录账户</a>
                                    <span class="hide-mobile">|</span>
                                    <a href="https://pay.iredcap.cn/cashier" rel="noopener" target="_blank">Demo测试</a>
                                    <br>
                                    Copyright &copy; Cmpay . All rights reserved.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<style type="text/css">.qmbox style, .qmbox script, .qmbox head, .qmbox link, .qmbox meta {display: none !important;}</style>
</div>';
    }
}