<?php
namespace app\club_admin\controller;
use think\Controller;
use think\Db;
class Register extends Controller
{
    public function index()
    {
    	// $clubs = Db::query('select * from club_club');
    	// $this->assign("clubs",$clubs);
        return $this->fetch();
	}
	public function register(){
		$info="";
    	$file = request()->file('club_pic');//手册里上传文件
    	if($file){
    		
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'club_img');
//  	dump($file);exit;
    	
    	
		//取值
		if(request()->isPost()){
			//$data数组的下表和clubs表的字段名一致
		$club_adminname=input('param.club_adminname');
			
		$data=[
		'club_name'=>input('param.club_name'),
		'club_pic'=>$info->getFilename(),
		'club_intro'=>input('param.club_intro'),
		'club_time'=>input('param.club_time'),
		'club_phone'=>input('param.club_phone'),
		'club_address'=>input('param.club_phone'),
		'club_adminname'=>input('param.club_adminname'), 
		'club_adminpassword'=>input('param.club_adminpassword'),
		'club_state'=>0,
		];
		}
		
// 		$validate = \think\Loader::validate('club');

// if(!$validate->check($data)){
//     $this->error($validate->getError());
// };

		//存入数据库
		$res=Db::name("clubs")->insert($data);

		if($res){
			$this->success("注册成功，请耐心等待审核","login/index");
			
		}
		else{
			$this->error("注册失败");
		}
	} 		
	}
}