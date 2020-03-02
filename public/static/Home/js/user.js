
$('#chkEmailStatus').click(function () {
    var t = new Date();
    $.ajax({
        type: 'POST',
        url: '/doChkchange', // 自定义接收url
        dataType: 'json',
        data: {
            type: $('#chkEmailStatus').val(),
            t: t.getTime()
        },
        success: function (data) {
            if (data.code !== 1){
                layer.msg(data.msg);
                $('#chkEmailStatus').attr('checked');
            }
        },
        error: function (data) {
            layer.alert(data.msg);
        },
    });
});

$('#chkSmsStatus').click(function () {
    var t = new Date();
    $.ajax({
        type: 'POST',
        url: '/doChkchange', // 自定义接收url
        dataType: 'json',
        data: {
            type: $('#chkSmsStatus').val(),
            t: t.getTime()
        },
        success: function (data) {
            if (data.code !== 1){
            layer.msg(data.msg);
                $('#chkSmsStatus').attr('checked',false);
        }
        },
        error: function (data) {
            layer.alert(data.msg);
        },
    });
});


$('#chkAntStatus').click(function () {
    var t = new Date();
    $.ajax({
        type: 'POST',
        url: '/doChkchange', // 自定义接收url
        dataType: 'json',
        data: {
            type: $('#chkAntStatus').val(),
            t: t.getTime()
        },
        success: function (data) {
            if (data.code !== 1){
                layer.msg(data.msg);
            }
        },
        error: function (data) {
            layer.alert(data.msg);
        },
    });
});
