<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

//<!--——————————谷春晓		俱乐部申请列表——————————-->
class ClubAuditing extends Controller 
{
    public function index()
    {
    	$clubs=Db::name("clubs")->where("club_state",['=','0'],['=','2'],'or')->select();
        $this->assign("clubs",$clubs);   	
    	return $this->fetch();
    }
    
    public function delete($id){
    	$res = Db::name("clubs")->where("club_id=$id")->find();
    	$club_pic = $res["club_pic"];
    	if(Db::name("clubs")->delete($id)){
    		//删除图片
    		unlink(ROOT_PATH . 'public' . DS . 'static' . DS . 'img' . DS.'club_img' . DS . $club_pic);
    		$this->success("删除成功");
    	}else{
    		$this->error("删除失败");
    	}
    }

    public function pass($id){

        $data=[
            'club_state'=>1,
            ];
          
      $res = Db::name("clubs")->where("club_id",$id)->update($data);
          // $res = Db::query("UPDATE clubs SET club_state = '1' WHERE club_id=$club_id");
      if($res){
        $this->success("修改俱乐部状态成功",'club_auditing/index');
        // echo "{\"success\":\"1\"}
      }else{
       $this->error("修改俱乐部状态失败");
        dump($this);     
      } 
    }

    public function refuse($id){

        $data=[
            'club_state'=>2,
            ];
          
      $res = Db::name("clubs")->where("club_id",$id)->update($data);
          // $res = Db::query("UPDATE clubs SET club_state = '1' WHERE club_id=$club_id");
      if($res){
        $this->success("修改俱乐部状态成功",'club_auditing/index');
        // echo "{\"success\":\"1\"}
      }else{
       $this->error("修改俱乐部状态失败");
        dump($this);     
      } 
    }    
}
