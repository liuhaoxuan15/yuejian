<?php
namespace app\club_admin\controller;
use think\Controller;
use think\Db;
use \think\Session;
class Coach extends Controller
{
    public function index()
    {
    	$club_adminname=\think\Session::get('login_admin');
        $this->assign("adminname",$club_adminname);	
    	$coachs = Db::query("select * from club_coach c,clubs s where club_adminname='$club_adminname' and c.club_id=s.club_id");
    	 $this->assign("coachs",$coachs);
         return $this->fetch();
	}
	public function add()
    {
        return $this->fetch();
	}

/*——————————刘皓璇		添加教练——————————*/
	public function update(){
//		dump($_POST["coachname"]);exit;
		//上传
		// 获取表单上传文件 

		// var_dump($_POST);exit;

		$info="";
    	$file = request()->file('coach_img');//手册里上传文件
    	if($file){
    		
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'coach');
//  	dump($file);exit;

    	$club_adminname=\think\Session::get('login_admin');
    	$club_id = Db::table('clubs')->where("club_adminname",$club_adminname)->value("club_id");
    	// dump($club_id);exit;
		//取值
		if(request()->isPost()){
			//$data数组的下表和coachs表的字段名一致
			$data=[
			'coach_name'=>input('param.coach_name'),
			'coach_img'=>$info->getFilename(),
			'coach_des'=>input('param.coach_des'),
			'club_id'=>$club_id,
			];
		}
		
// 		$validate = \think\Loader::validate('coach');

// if(!$validate->check($data)){
//     $this->error($validate->getError());
// };

		//存入数据库
		$res=Db::name("club_coach")->insert($data);

		if($res){
			$this->success("添加教练成功");
			
		}
		else{
			$this->error("添加教练失败");
		}
	} 
}

/*——————————刘皓璇		删除教练——————————*/
	public function delete($id){
			$res = Db::name("club_coach")->where("coach_id=$id")->find();
			$coach_img = $res["coach_img"];
			if(Db::name("club_coach")->delete($id)){
//				$res = Db::name("coachs")->where("vid=$id")->find();

				// 删除图片
			unlink(ROOT_PATH.'public'.DS.'static'.DS.'coach'.DS.$coach_img);
				
				$this->success("删除成功",'coach/index');
				
						
			}else{
				$this->error("删除失败");
			}
	} 	
	
	public function edit($id){

		$res = Db::name("club_coach")->where('coach_id',$id)->find();

    	$this->assign("coachs",$res);
		return $this->fetch();
	}


/*——————————刘皓璇		修改教练——————————*/
  public function edit_update(){
        $coach_id = input("coach_id");
		$info="";
    	$file = request()->file('coach_img');//手册里上传文件
    	if($file){
    	$res = Db::name("club_coach")->where("coach_id=$coach_id")->find();
    	$coach_img = $res["coach_img"];
    	unlink(ROOT_PATH.'public'.DS.'static'.DS.'coach'.DS.$coach_img);		
        	$info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'coach');
        
        $club_adminname=\think\Session::get('login_admin');
    	$club_id = Db::name('clubs')->where("club_adminname",$club_adminname)->value("club_id");        
      if(request()->isPOST()){
//    		$typename=input('param.typename');
			$data=[

			'coach_name'=>input('param.coach_name'),
			'coach_img'=>$info->getFilename(),
			'coach_des'=>input('param.coach_des'),
			'club_id'=>$club_id,
			];
          }
        //存入数据库;
      $res = Db::name("club_coach")->where("coach_id",$coach_id)->update($data);
      if($res){
        $this->success("修改教练信息成功",'coach/index');
        // echo "{\"success\":\"1\"}
      }else{
      $this->error("修改教练信息失败");
		dump($this);     
      }
}else{
	    $club_adminname=\think\Session::get('login_admin');
    	$club_id = Db::name('clubs')->where("club_adminname",$club_adminname)->value("club_id");
      	if(request()->isPOST()){
//    		$typename=input('param.typename');
			$data=[
			'coach_name'=>input('param.coach_name'),
			'coach_des'=>input('param.coach_des'),
			'club_id'=>$club_id,
			];
          }
       $res = Db::name("club_coach")->where("coach_id",$coach_id)->update($data);
      if($res){
        $this->success("修改教练信息成功",'coach/index');
        // echo "{\"success\":\"1\"}
      }else{
      $this->error("修改视频名失败");
		dump($this);     
      }	
}
}

}