<?php
namespace app\club_admin\validate;
use \think\Validate;
use think\Loader;
class Course extends Validate{
    protected $rule=[
        'course_price' => ['number'],
        'difficulty' => ['number','between:1,5'],        
    ];	


}


