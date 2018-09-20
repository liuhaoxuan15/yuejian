<?php
/**
 * Created by PhpStorm.
 * User: wu_pc
 * Date: 2018/7/9
 * Time: 15:09
 */

namespace app\admin\controller;
/*——————————吴超		活动管理——————————*/


use think\Controller;
use think\Db;

class Activity extends Controller
{
    public function index()
    {
        $wu=Db::name("activity")->select();
        $this->assign("activity",$wu);
        return $this->fetch();

    }
    public function add()
{               $file = request()->file('pic');
    if($file) {
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'images');
    }
        if(request()->isPost()){//检查传参方式是否为POST
        $data=[
            'name'=>input('name'),

            'pic'=>$info->getFilename(),
            'address'=>input('address'),
            'data'=>input('data'),
            'enroll'=>input('enroll'),
            'hotline'=>input('hotline'),
            'cost'=>input('cost'),
            'abstract'=>input('abstract'),
            'aid'=>input('aid'),
        ];

            $res=Db::table('activity')->insert($data);

            if($res){
                return  $this->redirect('activity/index');//模板跳转
            }else{
                $this->error('添加失败');
            }
        }
    return $this->fetch();


}
    public function edit()
    {
        $aid=input('aid');
        $activity=Db::table('activity')->find($aid);
        $this->assign("activity",$activity);
        return $this->fetch();

    }
    public function delete($aid){
        $aid=input("aid");
        $res = Db::name("activity")->where("aid=$aid")->find();
        $pic = $res["pic"];
        if(Db::name("activity")->delete($aid)){
            unlink(ROOT_PATH . 'public' . DS . 'static'.DS.'images'.DS.$pic);
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }}

    public function update()

    {
        $aid=input("aid");
        $file = request()->file('pic');
        if($file) {
            $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'images');
            if(request()->isPost()){//检查传参方式是否为POST
                $data=[
                    'name'=>input('name'),

                    'pic'=>$info->getFilename(),
                    'address'=>input('address'),
                    'data'=>input('data'),
                    'enroll'=>input('enroll'),
                    'hotline'=>input('hotline'),
                    'cost'=>input('cost'),
                    'abstract'=>input('abstract'),

                ];

                $res=Db::table('activity')->where("aid='$aid'")->update($data);

                if($res){
                    return  $this->redirect('activity/index');//模板跳转
                }else{
                    $this->error('添加失败');
                }
            }}
        else{
            if(request()->isPost()){//检查传参方式是否为POST
                $pic=input("pic");
                $data=[
                    'name'=>input('name'),

                    'pic'=>$pic,
                    'address'=>input('address'),
                    'data'=>input('data'),
                    'enroll'=>input('enroll'),
                    'hotline'=>input('hotline'),
                    'cost'=>input('cost'),
                    'abstract'=>input('abstract'),

                ];

                $res=Db::table('activity')->where("aid='$aid'")->update($data);

                if($res){
                    return  $this->redirect('activity/index');//模板跳转
                }else{
                    $this->error('添加失败');
                }
            }
        }

}}