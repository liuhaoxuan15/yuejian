<?php
namespace app\admin\validate;
use \think\Db;
use \think\Validate;

class Soft extends Validate
{
    protected $rule = [
        'name|软件名称'  =>  'require|min:20',
        //'pic|你选择的图片' => 'image:jpg',
    ];

}

