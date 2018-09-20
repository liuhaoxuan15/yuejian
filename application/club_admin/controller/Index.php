<?php
namespace app\club_admin\controller;
use think\Controller;
use think\Db;
use \think\Session;
class Index extends Controller{
/*——————————刘皓璇		登录——————————*/
public function index()
{
   if(input('?param.err')){
	  	echo  "<script>alert('请登陆后访问!');
	         	</script>";
	         	
}
$club_adminname=\think\Session::get('login_admin');
      $this->assign("adminname",$club_adminname);		
return $this->fetch();
}
    public function welcome(){
    	return $this->fetch();
    }
        
}
