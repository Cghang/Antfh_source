
var handler = function (captchaObj) {
    captchaObj.onReady(function () {
        $("#wait").hide();
    }).onSuccess(function () {
        var result = captchaObj.getValidate();
        if (!result) {
            return layer.alert('请先完成人机交互身份验证');
        }
        $.ajax({
            url: 'Check',
            type: 'POST',
            dataType: 'json',
            data: {
                type: $('#type').val(),
                url: $('#url').val(),
                geetest_challenge: result.geetest_challenge,
                geetest_validate: result.geetest_validate,
                geetest_seccode: result.geetest_seccode
            },
            success: function (data) {
                if (data.code === 1) {
                        layer.alert(data.msg);
                } else {
                     layer.alert(data.msg);
                        captchaObj.reset();
                }
            }
        });
    });
    $('#btn').click(function () {
        var url = $("#url").val();
        // 调用之前先通过前端表单校验
        if (url === ''){
            return layer.msg('检测域名不能为空，请重试！');
        }
        captchaObj.verify();
    });
    // 更多接口说明请参见：http://docs.geetest.com/install/client/web-front/
};


$.ajax({
    url: "geetest.html?t=" + (new Date()).getTime(), // 加随机数防止缓存
    type: "get",
    dataType: "json",
    success: function (data) {

        // 调用 initGeetest 进行初始化
        // 参数1：配置参数
        // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它调用相应的接口
        initGeetest({
            // 以下 4 个配置参数为必须，不能缺少
            gt: data.gt,
            challenge: data.challenge,
            offline: !data.success, // 表示用户后台检测极验服务器是否宕机
            new_captcha: data.new_captcha, // 用于宕机时表示是新验证码的宕机

            product: "bind", // 产品形式，包括：float，popup
            width: "300px",
            https: true

            // 更多配置参数说明请参见：http://docs.geetest.com/install/client/web-front/
        }, handler);
    }
});