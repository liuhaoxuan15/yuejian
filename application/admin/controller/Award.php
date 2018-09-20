<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Award extends Controller
{


	public function index(){
		$awards = Db::query('select * from awards');
		$this->assign("alist",$awards);
		return $this->fetch();
	}
  


/*——————————马兴欣   删除奖品——————————*/
    public function delete($award_id){
    	if(Db::name("awards")->delete($award_id))
		{
			// echo Db::name("awards")->getLastSql();exit;
			$this->success('删除成功');
		}else $this->error('删除失败');

    }
    public function add(){
        return $this->fetch();
    }

/*——————————马兴欣   添加奖品——————————*/    
    public function upload(){
    	//上传
        //

        $info="";
        $file = request()->file('award_pic');
        if($file){
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'awards');//DS为/
        }

        if (request()->isPost()) {
        	$data=[
        	  'award_name'=>input('param.award_name'),
              'award_intro'=>input('param.award_intro'),
              'award_info'=>input('param.award_info'),
        	  'award_pic'=>$info->getFilename(),   	  
        	  'award_value'=>input('param.award_value'),
        	  'award_num'=>input('param.award_num'),
        	];
        }
          //验证器
    $validate = \think\Loader::validate('Award');

            if(!$validate->check($data)){
                $this->error($validate->getError());
        }

        //存入数据库
		
		$res=Db::name("awards")-> insert($data);
		if($res){
			$this->success("添加成功");
		}else{
			$this->error("添加失败");
		}
  
	 }

/*——————————马兴欣   已兑换列表——————————*/
	 public function change(){
	 	$awards=Db::name("awards")->select();
        $this->assign("awards",$awards);

        $users=Db::name("users")->select();
        $this->assign("users",$users);
       
   	    $exchanges = Db::query('select * from exchanges e,awards a ,users u where e.award_id=a.award_id and e.user_id = u.user_id order by e.exchange_id desc');
		$this->assign("elist",$exchanges);
		return $this->fetch();
	 	
	 }

/*——————————马兴欣   修改奖品——————————*/
    public function edit($award_id){
        $res = Db::name("awards")->where('award_id',$award_id)->find();

        $this->assign("awards",$res);
        return $this->fetch();
    }

    public function update(){
        $award_id = input("award_id");
        
        $info="";
        $file = request()->file('award_pic');//
        if($file){

        $res = Db::name("awards")->where('award_id',$award_id)->find();
        $award_pic = $res["award_pic"];
        unlink(ROOT_PATH.'public'.DS.'static'.DS.'awards'.DS.$award_pic);   
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'awards');
                     
      if(request()->isPOST()){
            $data=[
              'award_name'=>input('param.award_name'),
              'award_intro'=>input('param.award_intro'),
              'award_info'=>input('param.award_info'), 
              'award_pic'=>$info->getFilename(),
              'award_value'=>input('param.award_value'),
              'award_num'=>input('param.award_num'),
        ];
          }
            //验证器
    $validate = \think\Loader::validate('Award');

            if(!$validate->check($data)){
                $this->error($validate->getError());
        }

        //存入数据库;
      $res = Db::name("awards")->where("award_id",$award_id)->update($data);
      if($res){
        $this->success("修改信息成功");
     
      }else{
       $this->error("修改失败");
        //dump($this);     
       }
      }else{
      if(request()->isPOST()){
            $data=[
              'award_name'=>input('param.award_name'),
              'award_intro'=>input('param.award_intro'),
              'award_info'=>input('param.award_info'),     
              'award_value'=>input('param.award_value'),
              'award_num'=>input('param.award_num'),
        ];
          }
      $res = Db::name("awards")->where("award_id",$award_id)->update($data);
      if($res){
        $this->success("修改信息成功");
        // echo "{\"success\":\"1\"}
      }else{
     $this->error("修改失败");
        //dump($this);     
      } 
}
}

}