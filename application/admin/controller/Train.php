<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Train extends Controller
{
	public function train(){
		$trains = Db::query('select * from trains');
		$this->assign("tlist",$trains);
		return $this->fetch();

	}
/*——————————马兴欣   删除培训信息——————————*/ 
	public function delete($train_id){

		if(Db::name("trains")->delete($train_id))
		{
			// echo Db::name("trains")->getLastSql();exit;
			$this->success('删除成功');
		}else $this->error('删除失败');

	}
	public function add(){
		return $this->fetch();
	}

/*——————————马兴欣   添加培训信息——————————*/ 	
    public function upload(){
    	        //上传
    
        //
        $info="";
        $file = request()->file('train_pic');
        if($file){
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'trains');//DS为/
          }

		//取值 $t    =$_POST["typename"];
		if (request()->isPost()) {
			
		$data=[
               'train_name'=>input('param.train_name'),
    		   'train_type'=>input('param.train_type'),
    		   'train_intro'=>input('param.train_intro'),   
    		   'train_attention'=>input('param.train_attention'),
    		   'train_pic'=>$info->getFilename(),
    		   'train_time'=>input('param.train_time'), 
    		   'train_address'=>input('param.train_address'), 
    		   'train_price'=>input('param.train_price'), 
		];

		}
        //验证器
		$validate = \think\Loader::validate('Train');

            if(!$validate->check($data)){
                $this->error($validate->getError());
        }
		//存入数据库
		
		$res=Db::name("trains")-> insert($data);
		if($res){
			$this->success("添加培训成功");
		}else{
			$this->error("添加培训失败");
		}

	}

/*——————————马兴欣   修改培训信息——————————*/ 
	public function edit($train_id){
        $res = Db::name("trains")->where('train_id',$train_id)->find();

    	$this->assign("trains",$res);
		return $this->fetch();


	}


    public function update(){
        $train_id = input("train_id");
        
		$info="";
    	$file = request()->file('train_pic');//
    	if($file){

    	$res = Db::name("trains")->where("train_id=$train_id")->find();
    	$train_pic = $res["train_pic"];
    	unlink(ROOT_PATH.'public'.DS.'static'.DS.'trains'.DS.$train_pic);	
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static'.DS.'trains');
        	         
      if(request()->isPOST()){
			$data=[
	               'train_name'=>input('param.train_name'),
	    		   'train_type'=>input('param.train_type'),
	    		   'train_intro'=>input('param.train_intro'),   
	    		   'train_attention'=>input('param.train_attention'),
	    		   'train_pic'=>$info->getFilename(),
	    		   'train_time'=>input('param.train_time'), 
	    		   'train_address'=>input('param.train_address'), 
	    		   'train_price'=>input('param.train_price'), 
		];
          }
      		$validate = \think\Loader::validate('Train');
            if(!$validate->check($data)){
                $this->error($validate->getError());
                
        }    
        //存入数据库;
      $res = Db::name("trains")->where("train_id",$train_id)->update($data);
      if($res){
        $this->success("修改信息成功");
     
      }else{
     $this->error("修改失败");
		//dump($this);     
      }
}else{
      if(request()->isPOST()){
			$data=[
	               'train_name'=>input('param.train_name'),
	    		   'train_type'=>input('param.train_type'),
	    		   'train_intro'=>input('param.train_intro'),   
	    		   'train_attention'=>input('param.train_attention'),

	    		   'train_time'=>input('param.train_time'), 
	    		   'train_address'=>input('param.train_address'), 
	    		   'train_price'=>input('param.train_price'), 
		];
          }
      $res = Db::name("trains")->where("train_id",$train_id)->update($data);
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