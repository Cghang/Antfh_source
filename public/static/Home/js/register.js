/**
 * 蚂蚁防红 - 注册操作
 */
$(document).ready(function () {
    var handler = function (captchaObj) {
        captchaObj.appendTo('#captcha');
        captchaObj.onReady(function () {
            $("#wait").hide();
        });
        $("#submit").click(function () {
            var result = captchaObj.getValidate();
            if (!result) {
                layer.alert('请先完成人机交互身份验证');
            } else {
                $.ajax({
                    type: 'POST',
                    url: '/doRegister', // 自定义接收url
                    dataType: 'json',
                    data: {
                        username: $('#username').val(),
                        password: $('#password').val(),
                        password_confirm: $('#password_confirm').val(),
                        geetest_challenge: result.geetest_challenge,
                        geetest_validate: result.geetest_validate,
                        geetest_seccode: result.geetest_seccode
                    },
                    success: function (data) {
                        if (data.code === 1) {
                            layer.msg('注册成功，正在跳转用户中心..');
                            setTimeout("top.location.href = '/User'",1500);
                            // 成功后的自定义操作
                        }else {
                            layer.alert(data.msg);
                        }
                    },
                    error: function (data) {
                        layer.alert(data.msg);
                        // console.log(JSON.stringify(data));
                        // 失败后的自定义操作
                    },
                });
            }
        });
        window.gt = captchaObj;
    };
    $.ajax({
        url: "geetest.html?t=" + (new Date()).getTime(), // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            // console.log(data);
            $('#text').hide();
            $('#wait').show();
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                new_captcha: data.new_captcha,
                product: "float", // 产品形式，包括：float，embed，popup 等。注意只对PC版验证码有效
                offline: !data.success, // 表示用户后台检测极验服务器是否宕机，一般不需要关注
            }, handler);
        }
    });
});