<?php
namespace app\club_admin\controller;
use think\Db;
use think\Controller;

// 刘皓璇————接口
class Api extends Controller
{
	// 俱乐部详情接口
	// http://localhost/yuejian14/public/index.php/club_admin/api/clubInfo?club_id=1
	public function clubInfo(){
		$club_id = $_GET['club_id'];
        $clubInfo=Db::name('clubs')->where("club_id",$club_id)->find();
        if($clubInfo){
            return json($clubInfo);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败		
	}


	// 教练列表接口
	// http://localhost/yuejian14/public/index.php/club_admin/api/coachList
    public function coachList(){

        $coachList=Db::name('club_coach')->select();
        if($coachList){
            return json($coachList);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }	

	// 俱乐部精品课程列表接口
	// http://localhost/yuejian14/public/index.php/club_admin/api/courseList?club_id=1
	public function courseList(){
		$club_id = $_GET['club_id'];
        $courseList=Db::name('club_course')
                        ->where("club_id",$club_id)
                        ->find();
        if($courseList){
            return json($courseList);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败		
	}	   


	// 俱乐部视频列表接口
	// http://localhost/yuejian14/public/index.php/club_admin/api/videoList?club_id=1
	public function videoList(){
		$club_id = $_GET['club_id'];
        $videoList=Db::name('club_video')
                       ->where("club_id",$club_id)
                       ->find();
        if($videoList){
            return json($videoList);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败		
	}

}