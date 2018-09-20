<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Activityorder extends Controller
{
	public function index(){
        // select * from posts po,pictures pi ,users u where po.picture_id=pi.picture_id and 
        // po.user_id = u.user_id order by po.post_id desc
		$activity_order = Db::query('select * from activity_order ao,users u,activity ac where ao.user_id = u.user_id and ao.aid = ac.aid');
		$this->assign("actorder",$activity_order);
		return $this->fetch();
	}
	/*——————————马兴欣   删除订单——————————*/
    public function delete($order_id){
    	if(Db::name("activity_order")->delete($order_id))
		{
			// echo Db::name("activity_order")->getLastSql();exit;
			$this->success('删除成功');
		}else $this->error('删除失败');

	}
	/*——————————马兴欣   查看用户发布的所有图片——————————*/   
	public function show($user_id){

	$activity_order = Db::name("activity_order")->where("user_id",$user_id)->select();
	$this->assign("activity_order",$activity_order);
    // $order = Db::query("select * from activity_order where user_id='$user_id'");
    // $this->assign("order",$order);
    return $this->fetch();
   }	

}