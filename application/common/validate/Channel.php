<?php
/**
 * @author Dany <cgh@tom.com>
 * File_Name ChannelAdd.php
 * Time: 9:43 PM
 */

namespace app\common\validate;


use think\Validate;

class Channel extends Validate
{

    protected $rule =   [
        'name'  => 'require',
        'id' => 'require'
    ];

    protected $message  =   [
        'name.require'    => '通道名称不能为空',
        'name.id'    => '通道ID不能为空'

    ];

    protected $scene = [
        'add' => ['name'],
        'edit' => ['name'],
        'get' => ['id']
    ];
}