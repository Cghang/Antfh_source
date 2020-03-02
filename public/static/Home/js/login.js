/**
 * 蚂蚁防红 - 登陆操作
 */
$(document).ready(function () {
        $("#submit").click(function () {
            var username = $("#username").val(),
                password = $("#password").val();
                $.ajax({
                    type: 'POST',
                    url: '/doLogin', // 自定义接收url
                    dataType: 'json',
                    data: {
                        username: $('#username').val(),
                        password: $('#password').val()
                    },
                    success: function (data) {
                        if (data.code === 1) {
                            layer.msg('登陆成功,正在跳转');
                            setTimeout("top.location.href = '/User'",1500);
                        }else{
                            layer.msg(data.msg);
                        }
                    },
                    error: function (data) {
                        layer.alert(data.msg);
                    },
                });
        });
});