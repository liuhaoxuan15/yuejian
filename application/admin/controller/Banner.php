<?php
/**
 * Created by PhpStorm.
 * User: wu_pc
 * Date: 2018/7/11
 * Time: 16:04
 */
/*——————————吴超		轮播图管理——————————*/
namespace app\admin\controller;


use think\Controller;
use think\Db;

class Banner extends Controller
{
    public function index()
    {       $wu=Db::name("pic")->select();
        $this->assign("pic",$wu);
        return $this->fetch();

    }
    public function add()
    {
        $file = request()->file('pic');
        if($file) {
            $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'images');
        }
        if(request()->isPost()){//检查传参方式是否为POST
            $data=[


                'pic'=>$info->getFilename(),

            ];

            $res=Db::table('pic')->insert($data);

            if($res){
                return  $this->redirect('banner/index');//模板跳转
            }else{
                $this->error('添加失败');
            }
        }
        return $this->fetch();

    }
    public function edit()
    {
        return $this->fetch();

    }
    public function delete($id){
        $res = Db::name("pic")->delete($id);
        if($res){
            $this->success("删除成功");
        }
        else{
            $this->error('删除失败');
        }
    }
}