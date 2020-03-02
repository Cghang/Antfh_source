layui.use(['laypage', 'laytpl'], function () {
    var   laypage = layui.laypage
        , laytpl = layui.laytpl;

    layui.laytpl.gettypeName = function (t) {
        switch (t) {
            case 1: return '消费';
            case 2: return '充值';
        }
        return '未知方式';
    };

    var orderList = {
        init: function () {
            $("#btnSearch").click(function () {
                orderList.loadPage(1);
            });
            orderList.loadPage(1);
        },
        loadPage: function (pageIndex) {
            $.ajax("getUserBillList", {
                data: {
                    page: pageIndex
                    , pageSize: 15
                    , starttime: $.trim($("#starttime").val())
                    , endtime: $.trim($("#endtime").val())
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
        }
    };
    orderList.init();
});