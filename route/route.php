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
use think\facade\Route;
//Index
    Route::get('Index', 'index/index');
    Route::get('Api', 'index/api');
//Api_Out
    Route::get('Notify', 'api/index/notify');
    Route::any('ShortUrl', 'api/index/shorturl');


//Jump
Route::get('Url','jump/index/index');
Route::get('Look','jump/index/screen');
Route::get('Jump','jump/index/jump');
Route::get('LdqqCron','jump/index/ldqqcron');
Route::get('LdwxCron','jump/index/ldwxcron');
Route::get('TzqqCron','jump/index/tzqqcron');
Route::get('TzwxCron','jump/index/tzwxcron');
Route::get('setTzCron','jump/index/cron_tzset');//此处为刷新域名功能，添加了新域名需要访问刷新
Route::get('setLdCron','jump/index/cron_ldset');//此处为刷新域名功能，添加了新域名需要访问刷新
//Admin
//Route::get('Admin','admin/index/index');