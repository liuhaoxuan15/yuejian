<?php
namespace app\admin\validate;
use \think\Validate;

class Train extends Validate{
    protected $rule=[
        'train_name'  => 'require|max:50',
        'train_price' => 'number',
    ];	

}