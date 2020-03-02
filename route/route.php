<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//Route::get('think', function () {
 //   return 'hello,ThinkPHP5!';
//});
//User
Route::get('User','user/index');
Route::get('Settings','user/settings');
Route::get('setUserInfo','user/setuserinfo');
Route::get('getActionLogList','user/getActionLogList');
Route::post('doSetPassword','user/doSetPassword');
Route::get('Bill','user/bill');
Route::get('Charge','user/charge');
Route::get('getUserBillList','user/getUserBillList');
//Login
Route::get('Login','login/index');
Route::get('Register','login/register');
Route::post('doLogin','login/dologin');
Route::post('doRegister','login/doRegister');
Route::get('Loginout','login/loginout');
//Index
Route::post('Check','index/webcheck');
Route::get('Index','index/index');
Route::get('Api','index/api');
Route::get('Com','index/com');
Route::get('Help','index/help');
Route::get('Sell','index/sell');
//Red
Route::get('Red','red/index');
Route::get('Tongji','red/tongji');
Route::get('addFhdomains','red/addFhdomains');
Route::get('getFhdomainList','red/getFhdomainList');
Route::post('delFhdomain','red/delFhdomain');
//Jump
Route::get('Url','jump/index/index');
Route::get('Look','jump/index/screen');
Route::get('Jump','jump/index/jump');
Route::get('Test','jump/index/test');
Route::get('LdqqCron','jump/index/ldqqcron');
Route::get('LdwxCron','jump/index/ldwxcron');
Route::get('TzqqCron','jump/index/tzqqcron');
Route::get('TzwxCron','jump/index/tzwxcron');
Route::get('setTzCron','jump/index/cron_tzset');//此处为刷新域名功能，添加了新域名需要访问刷新
Route::get('setLdCron','jump/index/cron_ldset');//此处为刷新域名功能，添加了新域名需要访问刷新
//Api_Out
Route::get('CheckUrl','api/index/index');
Route::get('Notify','api/index/notify');
Route::get('ShortUrl','api/index/shorturl');
Route::get('Qrcode','api/index/qrcode');
//Api_In
Route::get('Api','api/index');
Route::post('doChkchange','api/dochkchange');
Route::post('Addfhurl','api/addfhurl');
Route::get('ApiInfo','api/apiinfo');
//Admin
//Route::get('Admin','admin/index/index');