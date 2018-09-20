<?php
namespace app\admin\validate;
use \think\Validate;

class Award extends Validate{
    protected $rule=[
        'award_name'  => 'require|max:50',
        'award_value' => 'number',
        'award_num' => 'number',
    ];	
}
