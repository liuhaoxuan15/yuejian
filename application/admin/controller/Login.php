<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
	
//<!--——————————谷春晓		超级管理员登录——————————-->
class Login extends Controller 
{
    public function index()
   
    {
    	if (request()->isPOST()) {//用于自提交
	        	
	        	
	        	
	        	$adminname = input('adminname');
	            $password = input('password');
    			$admin=\think\Db::name("admins")->where('adminname',$adminname)->find();
                    if (!$admin) {
                    	$this->error("账号不存在");
                        // echo "<script>alert('账号不存在！');</script>";
//                      return 1;

                    }else if ($password!=$admin['password']) {
                    	$this->error("密码错误");
                        // echo "<script>alert('密码错误!');</script>";
//                      return 2;

                    }else {
                            \think\Session::set('login_admin',$adminname);
							$this->redirect('index/index');
                            
                            // $this->redirect('foods/index');
//                          return 3;
                    }

	                    
	        }
	
				return $this->fetch();
	  	
    }

    
}
