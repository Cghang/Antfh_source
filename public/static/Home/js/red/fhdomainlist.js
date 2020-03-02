layui.use(['laypage', 'laytpl'], function () {
    var   laypage = layui.laypage
        , laytpl = layui.laytpl;

    layui.laytpl.gettypeName = function (t) {
        switch (t) {
            case 1: return '新浪缩址';
            case 2: return '百度缩址';
            case 3: return '搜狗缩址';
            case 4: return '微信缩址';
        }
        return '未知方式';
    };
    layui.laytpl.getstatusName = function (t) {
        switch (t) {
            case 0: return '<font style="color:#FF6100;">微信已红</font>';
            case 1: return '<font style="color:#2c7;">正常访问</font>';
            case 2: return '<font style="color:#FF6100;">QQ已红</font>';
            case 3: return '<font style="color:#FF6100;">全部已红</font>';
            case 4: return '<font style="color:#FF6100;">拦截</font>';
        }
        return '';
    };
    layui.laytpl.formatDate = function (d, format) {
        var date = new Date(d || new Date())
            , ymd = [
            this.digit(date.getFullYear(), 4)
            , this.digit(date.getMonth() + 1)
            , this.digit(date.getDate())
        ]
            , hms = [
            this.digit(date.getHours())
            , this.digit(date.getMinutes())
            , this.digit(date.getSeconds())
        ];

        format = format || 'yyyy-MM-dd HH:mm:ss';

        return format.replace(/yyyy/g, ymd[0])
            .replace(/MM/g, ymd[1])
            .replace(/dd/g, ymd[2])
            .replace(/HH/g, hms[0])
            .replace(/mm/g, hms[1])
            .replace(/ss/g, hms[2]);
    };
    layui.laytpl.digit = function (num, length, end) {
        var str = '';
        num = String(num);
        length = length || 2;
        for (var i = num.length; i < length; i++) {
            str += '0';
        }
        return num < Math.pow(10, length) ? str + (num | 0) : num;
    };
    var orderList = {
        init: function () {
            $("#btnSearch").click(function () {
                orderList.loadPage(1);
            });
            orderList.loadPage(1);
            $("#view").on("click", ".remove", function () {
                var Id = $(this).data('id'),
                inindex = $(this).data('index');
                if (Id === '' || inindex === '') {
                    layer.msg("没有防红ID，无法进行删除。", { icon: 0 });
                    return;
                }
                layer.confirm('您是否要删除此防红链接？', {
                    btn: ['确认', '取消'] //按钮
                }, function () {
                    orderList.Remove(Id, inindex);
                }, function () {
                });
            }).on("click", ".show", function () {
                var Id = $(this).data('id'),
                    inindex = $(this).data('index');
                if (Id === '' || inindex === '') {
                    layer.msg("没有短链接，无法进行二维码。", { icon: 0 });
                    return;
                }
                    orderList.Show(Id, inindex);
            });
        },
        loadPage: function (pageIndex) {
            $.ajax("getFhdomainList", {
                data: {
                    page: pageIndex
                    , pageSize: 15
                    , starttime: $.trim($("#starttime").val())
                    , endtime: $.trim($("#endtime").val())
                    , type: $.trim($("#type").val())
                    , ts: (new Date().getTime())
                },
                type: "GET",
                dataType: 'json',
                beforeSend: function () {
                    layer.msg("加载中......", { icon: 16, time: 0 });
                },
                success: function (d) {
                    layer.closeAll();
                    laytpl($("#tempList").html()).render(d, function (html) {
                        $("#view").html(html);
                    });

                    laypage.render({
                        elem: 'pager'
                        , limit: 30
                        , curr: d.data.current_page
                        , count: d.data.total
                        , layout: ['count', 'prev', 'page', 'next','skip']
                        , skip: true
                        , jump: function (obj, first) {
                            if (!first) {
                                var curr = obj.curr;
                                orderList.loadPage(curr);
                            }
                        }
                    });


                },
                error: function (x, t, e) {
                    layer.closeAll();
                }
            });
        },
        Remove: function (Id, index) {
            var tr = $('#tr_' + index);
            console.log('#tr_' + index);
            $.ajax("delFhdomain", {
                data: {
                    'id': Id
                },
                type: "POST",
                dataType: 'json',
                success: function (d) {
                    layer.msg(d.msg, { icon: d.code === 1 ? 1 : 0 });
                    if (d.code === 1) {
                        setTimeout(function () {
                            tr.remove();
                        }, 1200);
                    }
                }
            });
        },
        Show: function (Id, index) {
            layer.alert('<p class="center-block">防红短链接：<a href="'+ Id +'">'+ Id +'</a><img src="http://api.antfh.net/Qrcode?url='+ Id +'&title=123" width="200" height="200"></img></p>');
        }
    };
    orderList.init();
});
function pickedFunc() {
    $("#starttime").attr("value", $dp.cal.getNewDateStr());
}
function pickedFunc2() {
    $('#endtime').attr("value", $dp.cal.getNewDateStr());
}