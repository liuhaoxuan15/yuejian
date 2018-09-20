<?php
namespace app\jsonAPI\controller;
use think\Db;
use think\Controller;

class Activity extends Controller{
    public function getActivity(){

        $activityinfo=Db::name('activity')->select();
        if($activityinfo){
            return json($activityinfo);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }
    public function Activitylist(){

        $activityinfo=Db::name('activity')->where("aid",aid)->find();
        if($activityinfo){
            return json($activityinfo);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }	
}