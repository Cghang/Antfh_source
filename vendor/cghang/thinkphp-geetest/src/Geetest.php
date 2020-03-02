<?php
//facade
use think\facade\Route;
use think\facade\Config;
use think\facade\Session;
use think\geetest\GeetestLib;

// 注册路由
Route::rule('geetest/[:id]', "\\think\\geetest\\GeetestController@index");

function geetest($config = [])
{
    $config = empty($config) ? Config::get('geetest.') : $config;
    $geetest = new GeetestLib($config);
    Session::set('geetest_userid', $_SERVER['REQUEST_TIME']);
    Session::set('geetest_status', $geetest->pre_process(Session::get('geetest_userid')));
    return $geetest->get_response_str();
}

/**
 * 极验验证
 * @param array $post post提交的数据
 * @param array $config
 * @return bool
 */
function geetest_check($post, $config = [])
{
    $config = empty($config) ? Config::get('geetest.') : $config;
    $geetest = new GeetestLib($config);
    if (Session::get('geetest_status') == 1) {
        if ($geetest->success_validate($post['geetest_challenge'], $post['geetest_validate'], $post['geetest_seccode'], Session::get('geetest_userid'))) {
            return true;
        } else {
            return false;
        }
    } else {
        if ($geetest->fail_validate($post['geetest_challenge'], $post['geetest_validate'], $post['geetest_seccode'])) {
            return true;
        } else {
            return false;
        }
    }
}
