<?php

namespace app\admin\controller;

use app\common\controller\Common;
use think\App;

class BaseAdmin extends Common
{

    /**
     * BaseAdmin constructor.
     *
     * @auth Dany <cgh@tom.com>
     *
     * @param App|null $app
     */
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        !is_admin_login() && $this->redirect('index/index');
        //$this
        $this->version = file_get_contents('../data/version.php');
        $this->assign('nowver',$this->version);
        $this->assign('admin_info', session('admin_info'));
    }
}
