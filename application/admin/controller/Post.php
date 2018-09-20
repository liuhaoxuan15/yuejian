<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Post extends Controller
{
   public function index(){
       
        $pictures=Db::name("pictures")->select();
        $this->assign("pictures",$pictures);

        $users=Db::name("users")->select();
        $this->assign("users",$users);
       
   	    $posts = Db::query('select * from posts po,pictures pi ,users u where po.picture_id=pi.picture_id and po.user_id = u.user_id order by po.post_id desc');
		$this->assign("plist",$posts);
		return $this->fetch();
   
   }
/*——————————马兴欣   删除用户发布的图片——————————*/       
   public function delete($post_id){
   	if(Db::name("posts")->delete($post_id))
		{
			// echo Db::name("trains")->getLastSql();exit;
			$this->success('删除成功');
		}else $this->error('删除失败');


   }

/*——————————马兴欣   查看用户发布的所有图片——————————*/   
   public function show($user_id){

    $pictures = Db::query("select * from pictures where user_id='$user_id'");
    $this->assign("piclist",$pictures);
    return $this->fetch();
   }
/*——————————马兴欣   查看帖子详情——————————*/   
   public function pictureDetailed($post_id){

    $pictures = Db::query("select * from pictures where post_id='$post_id'");
    $this->assign("piclist",$pictures);
    return $this->fetch();
   }
/*——————————马兴欣   查看用图片下的所有评论——————————*/ 
    public function comment($post_id){
      $comments = Db::query("select * from comments c,users u where post_id='$post_id' and c.user_id=u.user_id");
      $this->assign("clist",$comments);
   	  return $this->fetch();
   }
}