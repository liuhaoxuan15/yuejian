<?php
/**
 * Created by PhpStorm.
 * User: wu_pc
 * Date: 2018/7/10
 * Time: 16:35
 */
/*——————————吴超		活动报名管理——————————*/
namespace app\admin\controller;


use think\Controller;
use think\Db;

class Enroll extends Controller
{
    public function index()
    {
        $wu=Db::name("activity_enroll")->join('activity',"activity_enroll.aid=activity.aid")->select();
        $this->assign("activity_enroll",$wu);
        return $this->fetch();

    }


}