<?php
namespace app\club_admin\controller;
use think\Controller;
use think\Db;
use think\Session;
    
//<!--——————————刘皓璇     俱乐部管理员登录——————————-->
class Login extends Controller 
{
    public function index(){
        // if(request()->isPost()){
        //     $captcha=input('verifycode');
        //     if(!captcha_check($captcha)){
        //         echo "<script>alert('验证失败!');</script>";
        //     }

        if (request()->isPOST()) {//用于自提交   
                $captcha=input('verifycode');
                if(!captcha_check($captcha)){
                // echo "<script>alert('验证失败!');</script>";
                    $this->error("验证码错误");
            }        
                $adminname = input('club_adminname');
                $password = input('club_password');
                $admin_state = Db::table('clubs')->where('club_adminname',$adminname)->value('club_state');
                $admin =Db::name("clubs")->where('club_adminname',$adminname)->find();

                    if (!$admin) {
                        $this->error("账号不存在");
                        // echo "<script>alert('账号不存在！');</script>";
//                      return 1;

                    }

                    else if ($password!=$admin['club_adminpassword']) {
                        $this->error("密码错误");
                        // echo "<script>alert('密码错误!');</script>";
//                      return 2;

                    }
                    if($admin_state == 2)
                    $this->error("该俱乐部未通过申请，请联系管理员或重新提交申请");
                    if($admin_state == 0)
                    $this->error("该俱乐部正在审核中，请耐心等待");
                    else {
                            \think\Session::set('login_admin',$adminname);
                            $this->redirect('index/index');
                    }           
            }
                return $this->fetch();
        
    }  

public function show_captcha(){
    ob_clean();
    $captcha = new \think\captcha\Captcha();
    $captcha->useZh=true;
    $captcha->zhSet="1234567890qwertyuiopasdfghjklzxcvbnmQWERTUIOPASDFGHJKLZXCVBNM";
    $captcha->fontSize = 20;
    $captcha->length   = 3;
    $captcha->useNoise = false;
    return $captcha->entry();

}
public function logout(){
    \think\Session::clear();
    $this->redirect('index/index');
}

}