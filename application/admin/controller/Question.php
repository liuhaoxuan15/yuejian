<?php
/**
 * Created by PhpStorm.
 * User: wu_pc
 * Date: 2018/7/11
 * Time: 14:20
 */
/*——————————吴超		大师课堂问答管理——————————*/
namespace app\admin\controller;


use think\Controller;
use think\Db;

class Question extends Controller
{
    public function index()
    {
        $wu=Db::name("question")->join('users',"question.user_id=users.user_id")->join('club_coach',"question.coach_id=club_coach.coach_id")->select();
        $this->assign("question",$wu);
        return $this->fetch();

    }
 public function delete($qid){
       $qid=input("qid");
       $res= Db::name("question")->delete($qid);
       if ($res) {
         $this->success("删除成功");
       }

    }




}