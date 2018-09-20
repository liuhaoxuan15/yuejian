<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

//<!--——————————谷春晓		用户管理——————————-->
class UserList extends Controller 
{
    public function index()
    {
    	$users=Db::query('select * from users');
        $this->assign("users",$users);   	
    	return $this->fetch();
     }
    
//  删除用户
    public function delete($id){
			$res = Db::name("users")->where("user_id=$id")->find();
			$user_pic= $res["user_pic"];
			if(Db::name("users")->delete($id)){

				// 删除图片
			unlink(ROOT_PATH.'public'.DS.'static'.DS.'user_img'.DS.$user_pic);
				
				$this->success("删除成功");
				
						
			}else{
				$this->error("删除失败");
			}
	}

    public function pass($id){

        $data=[
            'state'=>1,
            ];
          
      $res = Db::name("users")->where("user_id",$id)->update($data);
      if($res){
        $this->success("修改用户状态成功",'user_list/index');
        // echo "{\"success\":\"1\"}
      }else{
       $this->error("修改用户状态失败");
        dump($this);     
      } 
    }

    public function refuse($id){

        $data=[
            'state'=>0,
            ];
          
      $res = Db::name("users")->where("user_id",$id)->update($data);
          // $res = Db::query("UPDATE clubs SET club_state = '1' WHERE club_id=$club_id");
      if($res){
        $this->success("修改用户状态成功",'user_list/index');
        // echo "{\"success\":\"1\"}
      }else{
       $this->error("修改用户状态失败");
        dump($this);     
      } 
    }   
}
