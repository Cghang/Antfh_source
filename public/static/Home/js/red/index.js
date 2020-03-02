$("#urladd").click(function() {
    var url = $("#url").val(),
    title = $("#webtitle").val(),
    type = $("#addtype").val(),
    t = new Date();
    if (url === '') {
        layer.msg('请输入需要防红的网址URL');
        return false;
    }
    if (title === ''){
        layer.msg('请输入需要防红的网站标题');
        return false;
    }
    var index = layer.load(2, {
        shade: [0.2, '#333'] //0.1透明度的白色背景
    });
    $.ajax({
        url: '/Addfhurl',
        type: 'POST',
        dataType: 'json',
        data: {url: url, title: title ,type: type, t: t.getTime()},
        success: function (data) {
            if (data.code === 1) {
                layer.alert('新生成的防红链接为：<a href="' + data.shorturl+'" target="_blank">' + data.shorturl + '</a>' +
                    '<p class="center-block"><img src="http://api.antfh.net/Qrcode?url='+ data.shorturl +'&title='+ title +'" width="200" height="200"></img></p>');
                layer.close(index);
                $("#title").val('');
                $("#url").val('');
            } else {
                layer.close(index);
                $("#title").val('');
                $("#url").val('');
                layer.alert(data.msg);
            }
        }
    })
});
