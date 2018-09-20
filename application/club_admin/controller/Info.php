<?php
namespace app\club_admin\controller;
use think\Controller;
use think\Db;
use \think\Session;
class Info extends Controller
{
    public function index()
    {

    	$club_adminname=\think\Session::get('login_admin');
        $this->assign("adminname",$club_adminname);	

        $clubs = Db::name("clubs")->where('club_adminname',$club_adminname)->find();

    	$this->assign("clubs",$clubs);
		return $this->fetch();
}
  public function edit_update(){
  		// $clubs = Db::name("clubs")->where('club_adminname',$club_adminname)->find();
        // $club_id = input("club_id");
		$club_adminname=\think\Session::get('login_admin');
        $this->assign("adminname",$club_adminname);	
      if(request()->isPOST()){
//    		$typename=input('param.typename');
			$data=[
			'club_name'=>input('param.club_name'),
			'club_time'=>input('param.club_time'),
			'club_phone'=>input('param.club_phone'),
			'club_address'=>input('param.club_address'),
			'club_intro'=>input('param.club_intro'),
			// 'club_id'=>1,
			];
          }
      $res = Db::name("clubs")->where('club_adminname',$club_adminname)->update($data);
      if($res){
        $this->success("修改俱乐部信息成功",'info/index');
        // echo "{\"success\":\"1\"}
      }else{
      $this->error("修改俱乐部信息失败");
		dump($this);     
      }	

}
}