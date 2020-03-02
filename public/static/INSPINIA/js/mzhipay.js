  function logout()
        {
layer.open({  
                        content: '确定要退出登录吗?',  
                        btn: ['确认', '取消'],  
                        yes: function(index, layero) {  
                            window.location.href='/admin/login/logout';
                        },  
                        btn2: function(index, layero) {  
  
                        }  
                        ,  
                        cancel: function() {  
                            //右上角关闭回调  
  
                        }  
                    });  }