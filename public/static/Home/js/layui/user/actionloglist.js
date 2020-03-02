layui.use(['laypage', 'laytpl'], function () {
    var   laypage = layui.laypage
        , laytpl = layui.laytpl;

    var orderList = {
        init: function () {
            orderList.loadPage(1);
        },
        loadPage: function (pageIndex) {
            $.ajax("getActionLogList", {
                data: {
                    page: pageIndex
                    , pageSize: 9
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