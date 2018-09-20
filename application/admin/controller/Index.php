<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;


class Index extends Controller 
{
    public function index()
    {
    	if(input('?param.err')){
	    	echo  "<script>alert('请登陆后访问!');
	           	</script>";
	           	
		}
		$adminname=\think\Session::get('login_admin');
        $this->assign("adminname",$adminname);		
		return $this->fetch();
	  	
    }

    public function welcome()
    {
    	return $this->fetch();
    }    

}
