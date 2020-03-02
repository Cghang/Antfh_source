## 极验Geetest
ThinkPHP5.1.38LST版本可用的极验扩展

## 样例
[更多案例](https://www.geetest.com/demo/)

## 安装
> composer require cghang/thinkphp-geetest

## 使用
### 参数配置
在配置文件config里配置geetest配置，需要到官网申请

~~~
//key配置
//路径 config/geetest.php
'geetest'=> [
       'captcha_id' =>'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
       'private_key'=>'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    ],
~~~

### 模板里的调用

~~~

CSS样式参照demo.html的style样式48-144行

<!-- 设定DIV -->
<form method="post">
  <input type="text" id="inputUserid" placeholder="账号" required>
  <input type="password" id="inputPassword" placeholder="密码" required>
  <div id="captcha">
    <div id="text">
      行为验证™ 安全组件加载中
    </div>
    <div id="wait" class="show">
      <div class="loading">
        <div class="loading-dot"></div>
        <div class="loading-dot"></div>
        <div class="loading-dot"></div>
        <div class="loading-dot"></div>
      </div>
    </div>
  </div>
  <input id="submit" type="button" value="登陆">
</form>

<!-- 引入js库 -->
<!-- 注意，验证码本身是不需要 jquery 库，此处使用 jquery 仅为了在 demo 中使用，减少代码量 -->
<script src="https://apps.bdimg.com/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://www.geetest.com/demo/libs/gt.js"></script>

<script>
$(document).ready(function () {
    var handler = function (captchaObj) {
        captchaObj.appendTo('#captcha');
        captchaObj.onReady(function () {
            $("#wait").hide();
        });
        $("#submit").click(function () {
            var result = captchaObj.getValidate();
            if (!result) {
                alert('请完成验证');
            } else {
                $.ajax({
                    type: 'POST',
                    url: '/', // 自定义接收url
                    dataType: 'json',
                    data: {
                        userId: $('#inputUserid').val(),
                        userPwd: $('#inputPassword').val(),
                        geetest_challenge: result.geetest_challenge,
                        geetest_validate: result.geetest_validate,
                        geetest_seccode: result.geetest_seccode
                    },
                    success: function (data) {
                        if (data) {
                            alert('登陆成功');
                            // 成功后的自定义操作
                        }
                    },
                    error: function (data) {
                        alert('登陆失败');
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
</script>
~~~

### 控制器里验证

~~~
$data = Request::param(); //传入请求数据
if(!geetest_check($data)){
    //验证失败
    return json()->data(false)->code(403);
}
~~~

### 更多

如有问题,请及时[issue](https://github.com/Cghang/geetest/issues)或者发送邮件cgh@tom.com
