layui.use(['laypage', 'laytpl'], function () {
    var   laypage = layui.laypage
        , laytpl = layui.laytpl;

    layui.laytpl.getstatusName = function (t) {
        switch (t) {
            case 0: return '<font style="color:#FF6100;">微信已红</font>';
            case 1: return '<font style="color:#2c7;">正常访问</font>';
            case 2: return '<font style="color:#FF6100;">QQ已红</font>';
            case 3: return '<font style="color:#e20000;">全部已红</font>';
            case 4: return '<font style="color:#FF6100;">拦截</font>';
        }
        return '';
    };

    layui.laytpl.getstatusFjx = function (t) {
        switch (t) {
            case 0: return '<font style="color:#FF6100;">未开启</font>';
            case 1: return '<font style="color:#2c7;">已开启</font>';
        }
        return '';
    };
    var orderList = {
        init: function () {
            $("#btnSearch").click(function () {
                orderList.loadPage(1);
            });
            console.log($("#endtime").val());
            orderList.loadPage(1);
            $("#view").on("click", ".remove", function () {
                var Id = $(this).data('id'),
                    inindex = $(this).data('index');
                if (Id === '' || inindex === '') {
                    layer.msg("没有落地ID，无法进行删除。", { icon: 0 });
                    return;
                }
                layer.confirm('您是否要删除此落地域名？', {
                    btn: ['确认', '取消'] //按钮
                }, function () {
                    orderList.Remove(Id, inindex);
                }, function () {
                });
            });
        },
        loadPage: function (pageIndex) {
            $.ajax("getLddomainList", {
                data: {
                    page: pageIndex
                    , pageSize: 15
                    , starttime: unescape($("#starttime").val())
                    , endtime: unescape($("#endtime").val())
                    , type: $("#type").val()
                    , status: $.trim($("#status").val())
                    , select_field: $.trim($("#select_field").val())
                    , ordVal: $.trim($("#ordVal").val())
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
                        elem: 'page'
                        , limit: 15
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

                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                timeOut: 4000
                            };
                            toastr.success('列表数据加载成功', '订单数据列表');

                        }, 1300);
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
            $.ajax("delLddomain", {
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