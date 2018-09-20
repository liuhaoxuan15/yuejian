<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

//<!--——————————谷春晓		最近比赛——————————-->
class Game extends Controller 
{
    public function index()
    {
    	$matches=Db::name("matches")->select();
        $this->assign("matches",$matches);   	
    	return $this->fetch();
    }
    
//  添加比赛
    public function game_add()
    {
    	$file = request()->file('match_pic');
        if($file) {
        	$info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'match_img');
        }
        if(request()->isPost()){//检查传参方式是否为POST
        $data=[
            'match_name'=>input('match_name'),
            'match_pic'=>$info->getFilename(),
            'match_address'=>input('match_address'),
            'match_time'=>input('match_time'),
            'match_intro'=>input('match_intro'),
            'match_phone'=>input('match_phone'),
            'match_url'=>input('match_url'),

//          'aid'=>input('aid'),
        ];

            $res=Db::table('matches')->insert($data);

            if($res){
//          	$this->success('添加成功');
                return  $this->redirect('game/index');//模板跳转
            }else{
                $this->error('添加失败');
            }
        }
        return $this->fetch();

    }
    
//  删除比赛
    public function delete($id){
			$res = Db::name("matches")->where("match_id=$id")->find();
			$match_pic= $res["match_pic"];
			if(Db::name("matches")->delete($id)){

				// 删除图片
			unlink(ROOT_PATH.'public'.DS.'static'.DS.'match_img'.DS.$match_pic);
				
				$this->success("删除成功");
				
						
			}else{
				$this->error("删除失败");
			}
	}
	
//	修改比赛
    public function game_edit($id)
    {
    	$res = Db::name("matches")->where('match_id',$id)->find();

    	$this->assign("matches",$res);
		return $this->fetch();
    }
    
    public function game_update()
    {
    	$match_id = input("match_id");
		$info="";
    	$file = request()->file('match_pic');//手册里上传文件
    	if($file){
	    	$res = Db::name("matches")->where("match_id=$match_id")->find();
	    	$match_pic = $res["match_pic"];
	    	unlink(ROOT_PATH.'public'.DS.'static'.DS.'match_img'.DS.$match_pic);		
	        	$info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'  . DS . 'match_img');
	        	         
	      	if(request()->isPOST()){
	//    		$typename=input('param.typename');
				$data=[
				'match_name'=>input('match_name'),
	            'match_pic'=>$info->getFilename(),
	            'match_address'=>input('match_address'),
	            'match_time'=>input('match_time'),
	            'match_intro'=>input('match_intro'),
	            'match_phone'=>input('match_phone'),
	            'match_url'=>input('match_url'),
	            'match_id'=>input("match_id"),
	
				];
	         }
	        //存入数据库;
	      	$res = Db::name("matches")->where("match_id",$match_id)->update($data);
	      	if($res){
	        	$this->success("修改比赛信息成功",'game/index');
//	        	return  $this->redirect('game/index');
	        // echo "{\"success\":\"1\"}
	      	}else{
	      $this->error("修改视频名失败");
				dump($this);     
	      	}
		}
		else{
	      	if(request()->isPOST()){
				$data=[
				'match_name'=>input('match_name'),
	            'match_address'=>input('match_address'),
	            'match_time'=>input('match_time'),
	            'match_intro'=>input('match_intro'),
	            'match_phone'=>input('match_phone'),
	            'match_url'=>input('match_url'),
	            'match_id'=>input("match_id"),
				];
	        }
	      	$res = Db::name("matches")->where("match_id",$match_id)->update($data);
	      	if($res){
	        	$this->success("修改比赛信息成功",'game/index');
//	        	$this->redirect('game/index');
	        // echo "{\"success\":\"1\"}
	      	}else{
		      $this->error("修改视频名失败");
				dump($this);     
	      	}	
		}
	}
}
