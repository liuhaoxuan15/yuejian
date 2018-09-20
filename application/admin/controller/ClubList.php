<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
//	<!--——————————谷春晓		最近比赛——————————-->
class Clublist extends Controller 
{
    public function index()
    {
    	$clubs=Db::name("clubs")->where("club_state","1")->select();
        $this->assign("clubs",$clubs);   	
    	return $this->fetch();
    }
    
    public function delete($id){
    	$res = Db::name("clubs")->where("club_id=$id")->find();
    	$club_pic = $res["club_pic"];
    	if(Db::name("clubs")->delete($id)){
    		//删除图片
    		unlink(ROOT_PATH.'public'.DS.'static'.DS.'img'.DS.'club_img'.DS.$club_pic);
            // unlink(ROOT_PATH.'public'.DS.'static'.DS.'img'.DS.'club_img'.DS.$club_pic);
            // unlink(ROOT_PATH.'public'.DS.'static'.DS.'course'.DS.$course_img);

    		$this->success("删除成功");
    	}else{
    		$this->error("删除失败");
    	}
    }
    public function ice($id){
        $data=[
            'club_state'=>0,
            ];
          
      $res = Db::name("clubs")->where("club_id",$id)->update($data);
      if($res){
        $this->success("修改俱乐部状态成功",'club_list/index');
        // echo "{\"success\":\"1\"}
      }else{
       $this->error("修改俱乐部状态失败");
        dump($this);     
      } 
    

    }
}
