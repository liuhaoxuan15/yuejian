<?php
/**
 * Created by PhpStorm.
 * User: wu_pc
 * Date: 2018/7/11
 * Time: 14:06
 */
/*——————————吴超		大师管理——————————*/
namespace app\admin\controller;


use think\Controller;
use think\Db;

class Master extends Controller
{
    public function index()
    {   $master=Db::name("club_coach")->where("coach_ismaster","0")->select();

        $this->assign("club_coach",$master);
        return $this->fetch();
        }
        public function delete($coach_id){
            $coach_id=input("coach_id");
            $master=Db::name("club_coach")->where("coach_id",$coach_id)->update(['coach_ismaster' => '1']);
            if($master){
            return  $this->redirect('master/index');}
        }

}