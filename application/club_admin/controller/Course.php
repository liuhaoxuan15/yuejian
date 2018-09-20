<?php
namespace app\club_admin\controller;
use think\Controller;
use think\Db;
use \think\Session;
class Course extends Controller
{
    public function index()
    {
    	$club_adminname=\think\Session::get('login_admin');
        $this->assign("adminname",$club_adminname);	
    	$courses = Db::query("select * from club_course c,clubs s where club_adminname='$club_adminname' and c.club_id=s.club_id");
    	$this->assign("courses",$courses);
        return $this->fetch();
}

/*——————————刘皓璇		添加课程——————————*/
	public function add(){
		return $this->fetch();
	}
	public function update(){
//		dump($_POST["videoname"]);exit;
		//上传
		// 获取表单上传文件 
		$info="";
    	$file = request()->file('course_img');//手册里上传文件
    	if($file){    		
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'course');
//  	dump($file);exit;
    	$club_adminname=\think\Session::get('login_admin');
    	$club_id = Db::table('clubs')->where("club_adminname",$club_adminname)->value("club_id");
    	
		//取值
		if(request()->isPost()){
			//$data数组的下表和courses表的字段名一致
			$data=[
			'course_name'=>input('param.course_name'),
			'course_img'=>$info->getFilename(),
			//完成上传后修改
			'difficulty'=>input('param.difficulty'),
			'course_des'=>input('param.course_des'),
			'course_price'=>input('param.course_price'),
			'club_id'=>$club_id,
			'coach_id'=>1,
			];
		}
			// $validate = \think\Loader::validate('Train');
   //          if(!$validate->check($data)){
   //          $this->error($validate->getError());
   //      	}

          	$validate =  \think\Loader::validate('Course');
			if(!$validate->check($data)){
    		$this->error($validate->getError());
			}


		$num = Db::name("club_course")->where("course_name='$data[course_name]'")->count();
		if($num>0){
			$this->error("此课程名已存在");
		}
		//存入数据库
		$res=Db::name("club_course")->insert($data);

		if($res){
			$this->success("添加课程成功");
			
		}
		else{
			$this->error("添加课程失败");
		}
	}  
}

/*——————————刘皓璇		修改课程——————————*/
	public function edit($id){
		$res = Db::name("club_course")->where('course_id',$id)->find();
    	$this->assign("courses",$res);
		return $this->fetch();
	}

    public function edit_update(){
        $course_id = input("course_id");
        // $course_img = Db::name("club_course")->where('course_id',$course_id)->find("course_img");
        
		$info="";
    	$file = request()->file('course_img');//手册里上传文件
    	if($file){

    	$res = Db::name("club_course")->where("course_id=$course_id")->find();
    	$course_img = $res["course_img"];
    	unlink(ROOT_PATH.'public'.DS.'static'.DS.'course'.DS.$course_img);	
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'course');
         
        if(request()->isPOST()){
			$data=[
			'course_name'=>input('param.course_name'),
			'course_img'=>$info->getFilename(),
			//完成上传后修改
			'difficulty'=>input('param.difficulty'),
			'course_des'=>input('param.course_des'),
			'course_price'=>input('param.course_price'),
			];

          }
          	$validate = Loader::validate('Course');
			if(!$validate->check($data)){
    		$this->error($validate->getError());
			}



 

        //存入数据库;
      $res = Db::name("club_course")->where("course_id",$course_id)->update($data);
      if($res){
        $this->success("修改课程信息成功",'course/index');
     
      }else{
      $this->error("修改课程信息失败");
		dump($this);     
      }
}else{
	  // $club_adminname=\think\Session::get('login_admin');
   //    $club_id = Db::name('clubs')->where("club_adminname",$club_adminname)->value("club_id");
      if(request()->isPOST()){
//    		$typename=input('param.typename');
			$data=[
			'course_name'=>input('param.course_name'),
			//完成上传后修改
			'difficulty'=>input('param.difficulty'),
			'course_des'=>input('param.course_des'),
			'course_price'=>input('param.course_price'),
			// 'club_id'=>$club_id,
			// 'course_id'=>1,
			];
          }
      $res = Db::name("club_course")->where("course_id",$course_id)->update($data);
      if($res){
        $this->success("修改课程信息成功",'course/index');
        // echo "{\"success\":\"1\"}
      }else{
      $this->error("修改课程信息失败");
		dump($this);     
      }	
}
}

/*——————————刘皓璇		删除课程——————————*/
	public function delete($id){
			$res = Db::name("club_course")->where("course_id=$id")->find();
			$course_img = $res["course_img"];
			if(Db::name("club_course")->delete($id)){
//				$res = Db::name("coachs")->where("vid=$id")->find();

				// 删除图片
			unlink(ROOT_PATH.'public'.DS.'static'.DS.'course'.DS.$course_img);
				
				$this->success("删除成功",'course/index');
				
						
			}else{
				$this->error("删除失败");
			}
	} 

}