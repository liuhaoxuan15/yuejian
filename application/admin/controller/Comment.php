<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Comment extends Controller
{
	public function index(){
		$posts=Db::name("posts")->select();
        $this->assign("posts",$posts);

        $users=Db::name("users")->select();
        $this->assign("users",$users);
       
   	    $comments = Db::query('select * from comments c,posts p ,users u where c.post_id=p.post_id and c.user_id = u.user_id order by c.comment_id desc');
		 $this->assign("clist",$comments);
		 return $this->fetch();
	}

/*——————————马兴欣   删除评论——————————*/
  public function delete($comment_id){
   	if(Db::name("comments")->delete($comment_id))
		{
			// echo Db::name("trains")->getLastSql();exit;
			$this->success('删除成功');
		}else $this->error('删除失败');
    }

/*——————————马兴欣   查看用户的所有评论——————————*/  
   public function detailed($user_id){
     $comments = Db::query("select * from posts p,comments c,users u where p.post_id=c.post_id and c.user_id='$user_id' and p.user_id=u.user_id");
     $this->assign("clist",$comments);
     return $this->fetch();
   }

/*——————————马兴欣   查看被评论的帖子详情——————————*/     
   public function postdetail($post_id){

    $posts = Db::query("select * from posts po,pictures pi where po.post_id=pi.post_id and po.post_id='$post_id' ");
     $this->assign("plist",$posts);
   	return $this->fetch();
   }

	public function member(){   
		return $this->fetch();
	}

}