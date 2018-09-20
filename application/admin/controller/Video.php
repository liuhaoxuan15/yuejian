<?php
/**
 * Created by PhpStorm.
 * User: wu_pc
 * Date: 2018/7/11
 * Time: 15:22
 */
/*——————————吴超		大师课堂视频管理——————————*/
namespace app\admin\controller;


use think\Controller;
use think\Db;

class Video extends Controller
{
    public function index()
    {   $wu=Db::name("master_video")->join('club_coach',"master_video.coach_id=club_coach.coach_id")->select();
    var_dump($wu);
        $this->assign("master_video",$wu);
        return $this->fetch();


    }
    public function add()
    {
        $file1 = request()->file('pic');

        if($file1) {
            $info1 = $file1->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'images');
        }
        if(request()->isPost()){//检查传参方式是否为POST
            $data=[


                'pic'=>$info1->getFilename(),
                'title'=>input('title'),
                'video'=>input('video'),
                'coach_id'=>input('coach_id'),


            ];

            $res=Db::table('master_video')->insert($data);

            if($res){
                return  $this->redirect('video/index');//模板跳转
            }else{
                $this->error('添加失败');
            }
        }
        return $this->fetch();

    }
    public function delete($mvid){
        $mvid=input("mvid");
        $res = Db::name("master_video")->where("mvid=$mvid")->find();
        $pic = $res["pic"];
        if(Db::name("master_video")->delete($mvid)){
            unlink(ROOT_PATH . 'public' . DS . 'static'.DS.'images'.DS.$pic);
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
    public function edit($mvid)
    {
        $mvid=input("mvid");
        $master_video=Db::table('master_video')->find($mvid);
        $this->assign("master_video",$master_video);
        return $this->fetch();

    }

    public function update()
    {$mvid=input("mvid");
        $file1 = request()->file('pic');

        if($file1) {
            $info1 = $file1->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'images');
        }
        if(request()->isPost()){//检查传参方式是否为POST
            $data=[


                'pic'=>$info1->getFilename(),
                'title'=>input('title'),
                'video'=>input('video'),
                'coach_id'=>input('coach_id'),


            ];
            var_dump($data);

            $res=Db::table('master_video')->where("mvid",$mvid)->update($data);

            if($res){
                return  $this->redirect('video/index');//模板跳转
            }else{
                $this->error('添加失败');
            }
        }
        return $this->fetch();

    }

}