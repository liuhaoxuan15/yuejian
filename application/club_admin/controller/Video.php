<?php
namespace app\club_admin\controller;
use think\Controller;
use think\Db;
use \think\Session;
class Video extends Controller
{
    public function index()
    {

    	$club_adminname=\think\Session::get('login_admin');
        $this->assign("adminname",$club_adminname);	
    	$videos = Db::query("select * from club_video v,clubs s where club_adminname='$club_adminname' and v.club_id=s.club_id");

    	$this->assign("videos",$videos);
    	return $this->fetch();
	}



	public function add(){
		return $this->fetch();
	}


/*——————————刘皓璇		添加视频——————————*/
	public function update(){

		$info="";
		$info1="";
    	$file = request()->file('video_img');//手册里上传文件
    	$file1 = request()->file('video_url');
  	 	// var_dump($_POST);exit;
  	 	if($file && $file1){
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'video' . DS . 'video_img');
        $info1 = $file1->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'video' . DS . 'video_url');
//  	dump($file);exit;
    	}

    	$club_adminname=\think\Session::get('login_admin');
    	$club_id = Db::table('clubs')->where("club_adminname",$club_adminname)->value("club_id");
		//取值
		if(request()->isPost()){
			//$data数组的下表和videos表的字段名一致
			$data=[
			'video_name'=>input('param.video_name'),
			'video_img'=>$info->getFilename(),
			//完成上传后修改
			'video_url'=>$info1->getFilename(),
			'club_id'=>$club_id,
			];
		}
		//存入数据库
		$num = Db::name("club_video")->where("video_name='$data[video_name]'")->count();
		if($num>0){
			$this->error("此视频名已存在");
		}
		$res=Db::name("club_video")->insert($data);

		if($res){
			$this->success("添加视频成功",'video/index');
			
		}
		else{
			$this->error("添加视频失败");
		}
	

    
}

/*——————————刘皓璇		删除视频——————————*/
	public function delete($id){
			$res = Db::name("club_video")->where("video_id=$id")->find();
			$video_img = $res["video_img"];
			$video_url = $res["video_url"];
			if(Db::name("club_video")->delete($id)){
//				$res = Db::name("videos")->where("vid=$id")->find();

				// 删除图片
				unlink(ROOT_PATH.'public'.DS.'static'.DS.'video'.DS. 'video_img' .DS.  $video_img);
				unlink(ROOT_PATH.'public'.DS.'static'.DS.'video'.DS. 'video_url' . DS .$video_url);
				
				$this->success("删除成功",'video/index');
				
						
			}else{
				$this->error("删除失败");
			}
	} 

/*——————————刘皓璇		修改视频——————————*/
	public function edit($id){
		$res = Db::name("club_video")->where('video_id',$id)->find();
    	$this->assign("videos",$res);
		return $this->fetch();		
	}   

	public function edit_update(){
        $video_id = input("video_id");
        // $video_img = Db::name("club_video")->where('video_id',$video_id)->find("video_img");
        
		$info="";
		$info1="";
    	$file = request()->file('video_img');//手册里上传文件
    	$file1 = request()->file('video_url');
    	if($file){
   		$res = Db::name("club_video")->where("video_id=$video_id")->find();
    	$video_img = $res["video_img"];
    	unlink(ROOT_PATH.'public'.DS.'static'.DS.'video'.DS.'video_img'.DS.$video_img);	
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'video'.DS.'video_img');        
      if(request()->isPOST()){
			$data=[
			'video_name'=>input('param.video_name'),
			'video_img'=>$info->getFilename(),
			//完成上传后修改
			];
          }
        //存入数据库;
      $res = Db::name("club_video")->where("video_id",$video_id)->update($data);
      if($res){
        $this->success("修改视频信息成功",'video/index');
     
      }else{
      $this->error("修改视频信息失败");
		dump($this);     
      }
    	}

    else if($file1){
   	$res = Db::name("club_video")->where("video_id=$video_id")->find();
    	$video_url = $res["video_url"];
    	unlink(ROOT_PATH.'public'.DS.'static'.DS.'video'.DS.'video_url' .DS.$video_url);	
        $info1 = $file1->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'video'.DS.'video_url');	         
      if(request()->isPOST()){
			$data=[
			'video_name'=>input('param.video_name'),
			//完成上传后修改
			'video_url'=>$info1->getFilename(),
			];
          }
        //存入数据库;
      $res = Db::name("club_video")->where("video_id",$video_id)->update($data);
      if($res){
        $this->success("修改视频信息成功",'video/index');
     
      }else{
     $this->error("修改视频信息失败");
		dump($this);     
      }    	
    }

    else{
      if(request()->isPOST()){
			$data=[
			'video_name'=>input('param.video_name'),
			];
          }
        //存入数据库;
      $res = Db::name("club_video")->where("video_id",$video_id)->update($data);
      if($res){
        $this->success("修改视频信息成功",'video/index');
     
      }else{
     $this->error("修改视频信息失败");
		dump($this);     
      }    	    	
    }
	}
}