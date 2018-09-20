<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;

class Api extends Controller
{
  /*——————————吴超        获取活动——————————
http://localhost/yuejian14/public/index.php/admin/api/getActivity
  */
    public function getActivity(){

        $activityinfo=Db::name('activity')->select();
        if($activityinfo){
            return json($activityinfo);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }
    /*——————————吴超      活动详情——————————
http://localhost/yuejian14/public/index.php/admin/api/ActivityList?aid=7
    */
    public function Activitylist(){
        $aid = $_GET['aid'];
        $activityinfo=Db::name('activity')->where("aid",$aid)->find();
        if($activityinfo){
            return json($activityinfo);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }
    /*——————————吴超     大师列表——————————

    */
    public function master(){
        $club_id = $_GET['club_id'];
        $master=Db::name("club_coach")
                    ->where("coach_ismaster","0")
                    ->where('club_id',$club_id)
                    ->select();
        if($master){
            return json($master);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }
    /*——————————吴超      轮播图——————————*/
    public function pic(){
        $id = $_GET['id'];
        $pic=Db::name('pic')->where("id",$id)->select();
        if($pic){
            return json($pic);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }
    /*——————————吴超      大师问答列表——————————*/
    public function questionlist(){
        $coach_id = $_GET['coach_id'];
        $question=Db::name('question')->where("coach_id",$coach_id)->select();
        if($question){
            return json($question);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }
 /*——————————吴超      大师发布问答列表——————————*/
    public function fabuquestion(){
        $coach_id = $_GET['coach_id'];
        $user_id = $_GET['user_id'];
        $coachcomment = $_GET['coachcomment'];
       
        $data=[
            'coach_id'=>$coach_id,
            'user_id'=>$user_id,
            'coachcomment'=>$coachcomment,
            'usercomment'=>null,
        ];
        $wu=Db::name("question")->join('users',"question.user_id=users.user_id")->join('club_coach',"question.coach_id=club_coach.coach_id")->insert($data);
        if($wu){
            return json($wu);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }
     /*——————————吴超      用户发布问答列表——————————*/
    public function fabuquestion1(){
        $coach_id = $_GET['coach_id'];
        $user_id = $_GET['user_id'];
        $usercomment = $_GET['usercomment'];
       
        $data=[
            'coach_id'=>$coach_id,
            'user_id'=>$user_id,
            'coachcomment'=>null,
            'usercomment'=>$usercomment,
        ];
        $wu=Db::name("question")->join('users',"question.user_id=users.user_id")->join('club_coach',"question.coach_id=club_coach.coach_id")->insert($data);
        if($wu){
            return json($data);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }


    /*——————————吴超      大师详情列表——————————*/
    public function mastershow(){
        $coach_id = $_GET['coach_id'];
        $question=Db::name('club_coach')->where("coach_id",$coach_id)->find();
        if($question){
            return json($question);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }
    /*——————————吴超      活动报名管理——————————*/
    public function activityenroll(){
        $user_id=input("user_id");
        $data=[
            'name'=>input('name'),
            'data'=>input('data'),
            'enroll'=>input('enroll'),
            'cost'=>input('cost'),
        ];
        $activityenroll=Db::name('activity_enroll')->where("user_id",$user_id)->insert($data);
        if($activityenroll){
            return json($activityenroll);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败
    }

/*——————————马兴欣      培训列表页接口——————————*/
    public function trainList(){
        $train = Db::name('trains')->select();
        if($train){
            return json($train);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败       
    }
/*——————————马兴欣      培训列表页(入门)接口——————————*/
//http://localhost/yuejian14/public/index.php/admin/api/train01List
    public function train01List(){
        $train = Db::name('trains')
                     ->where('train_type',"入门")
                     ->select();
        if($train){
            return json($train);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败       
    }    

/*——————————马兴欣      培训列表页(菜鸟)接口——————————*/
//http://localhost/yuejian14/public/index.php/admin/api/train02List
    public function train02List(){
        $train = Db::name('trains')
                     ->where('train_type',"菜鸟")
                     ->select();
        if($train){
            return json($train);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败       
    }   
/*——————————马兴欣      培训列表页(进阶)接口——————————*/
//http://localhost/yuejian14/public/index.php/admin/api/train03List
    public function train03List(){
        $train = Db::name('trains')
                     ->where('train_type',"进阶")
                     ->select();
        if($train){
            return json($train);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败       
    }   
 /*——————————马兴欣      培训详情页接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/trainDetail?train_id=6
    public function trainDetail(){
        // $user_name=$_GET['user_name'];
        $train_id=$_GET["train_id"];
        $train=Db::name('trains')->where("train_id",$train_id)->select();
        if($train){
            return json($train);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败       
    }

 /*——————————马兴欣      奖品列表页接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/awardList
    public function awardList(){
        $award = Db::name('awards')->select();
        if($award){
            return json($award);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败          
    }

 /*——————————马兴欣      奖品兑换列表接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/exchangeList
     public function exchangeList(){
        $exchange = Db::name('exchanges')->select();
        if($exchange){
            return json($exchange);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败          
    }

 /*——————————马兴欣      奖品详情页接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/awardDetail?award_id=1
    public function awardDetail(){
        // $user_name=$_GET['user_name'];

        $award_id=$_GET["award_id"];
        $award=Db::name('awards')->where("award_id",$award_id)->select();
        if($award){
            return json($award);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败       
    }


 /*——————————马兴欣      发帖列表（晒图）接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/postList    
      public function postList(){
        $res = Db::query("select * from posts inner join users on posts.user_id = users.user_id");
        if($res){
            return json($res);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败          
    }

 /*——————————马兴欣      查看用户发帖详情（图片列表）接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/postDetail?post_id=2    
    public function postDetail(){
        // $user_id = Db::name('posts')->column('user_id');
        $post_id=$_GET["post_id"];
        $res = Db::query("select * from posts p,users u where post_id = '$post_id' and p.user_id = u.user_id");
        $see_number = Db::name('posts')
                          ->where('post_id',$post_id)
                          ->setInc('see_number');   /*浏览数+1*/
        if($res && $see_number){
            return json($res);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败     
    }

 /*——————————马兴欣      发帖接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/postReport?post_title=1651&picture=123.jpg&user_id=1&post_id=13
//获取用户晒图信息
    public function postReport(){
        $post_title = $_GET['post_title'];     
        $picture = $_GET['picture'];
        $user_id = $_GET['user_id'];
        // $picture_id = $_GET['picture_id'];
        $post_id = $_GET['post_id'];

        $post_data = [
            'post_title'=>$post_title,
            'user_id'=>$user_id,
            // 'picture_id'=>$picture_id,
        ];
        $posts=Db::name('posts')->insert($post_data);
        if($posts){
            $pictures_data = [
                 'post_id'=>$post_id,
                'user_id'=>$user_id,
                'picture'=>$picture,
            ];
            $pictures=Db::name('pictures')->insert($pictures_data);
            if($pictures){
                return json(['success'=>1]);
            }
        }
        return json(['message'=>失败]);
        // if($pictures && $posts){
        //     return json(['success'=>1]);
        // }else{
        //     return json(['success'=>0]);
        // }
    }


 /*——————————马兴欣      发帖列表（个人中心）接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/userPostDetail?user_id=1    
    public function userPostDetail(){
        $user_id=$_GET["user_id"];
        $post=Db::name('posts')->where("user_id",$user_id)->select();
        if($post){
            return json($post);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败     
    }

 /*——————————马兴欣      用户发帖详情（评论列表）接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/commentList?post_id=1
    public function commentList(){

        $post_id=$_GET["post_id"];
        $comment=Db::name('comments')->where("post_id",$post_id)->select();
        if($comment){
            return json($comment);//返回成功
        }
        return json(['message'=>获取失败]);//返回失败     
    }   

 /*——————————马兴欣      发表评论接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/commentReport?post_id=1&comment_text='12312312312'&user_id=1
    public function commentReport(){
        $post_id=$_GET["post_id"];
        $comment_text = $_GET["comment_text"];
        $user_id = $_GET["user_id"];

        $data = [
            'post_id' => $post_id,
            'comment_text' => $comment_text,
            'user_id' => $user_id,
        ];
        $comment=Db::name('comments')->insert($data);
        if($comment){
            return json(['success'=>1]);
        }else{
            return json(['success'=>0]);
        }
    }
 /*——————————马兴欣      订单列表接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/activity_order
    public function activity_order(){
        $result=Db::name('activity_order')->select();
        if($result){
            return json($result);
        }else{
            return json(['message'=>'获取失败']);
        }   
    }  

 /*——————————马兴欣      订单列表(用户)接口——————————*/   
 // http://localhost/yuejian14/public/index.php/admin/api/useractivity_order?user_id=3
    public function useractivity_order(){
        $user_id=$_GET["user_id"];
        $result=Db::name('activity_order')->where('user_id',$user_id)->select();
        if($result){
            return json($result);
        }else{
            return json(['message'=>'获取失败']);
        }   
    }      

 /*——————————马兴欣      关注大师接口——————————*/   
 //http://localhost/yuejian14/public/index.php/admin/api/attMaster?user_id=2&coach_id=3
    public function attMaster(){
        $user_id=$_GET["user_id"];
        $coach_id=$_GET["coach_id"];
        $result0 = db('attentions')
                   ->where('user_id',$user_id)
                   ->where('coach_id',$coach_id)
                   ->count();
        if($result0 == 0){
        $data = [
            'user_id' => $user_id,
            'coach_id' =>   $coach_id,
        ];
        $result=Db::table('attentions')->insert($data,true);
        $result2 = Db::table('club_coach')->where('coach_id',$coach_id)->setInc('att_num');  /*教练被关注数+1*/
                if($result && $result2){
                    return json(['seccess'=>1]);
                }else{
                    return json(['message'=>'获取失败']);
                }  
        }else{
            return json(['message'=>'获取失败']);
        }
    }    
 /*——————————马兴欣      取消关注大师接口——————————*/   
 //http://localhost/yuejian14/public/index.php/admin/api/unAttMaster?user_id=2&coach_id=3
    public function unAttMaster(){
        $user_id=$_GET["user_id"];
        $coach_id=$_GET["coach_id"];
        $result0 = db('attentions')
                     ->where('user_id',$user_id)
                     ->where('coach_id',$coach_id)
                     ->delete();
        $result2 = Db::table('club_coach')->where('coach_id',$coach_id)->setDec('att_num');  /*教练被关注数-1*/           
        if($result0 && $result2){
            return json(['success'=>1]);
                }else{
                    return json(['success'=>0]);
                } 
    }         

 /*——————————马兴欣      关注俱乐部接口——————————*/   
 //http://localhost/yuejian14/public/index.php/admin/api/attClub?user_id=2&club_id=2
    public function attClub(){
        $user_id=$_GET["user_id"];
        $club_id=$_GET["club_id"];
        $result0 = db('attentions')
                   ->where('user_id',$user_id)
                   ->where('club_id',$club_id)
                   ->count();
        if($result0 == 0){
        $data = [
            'user_id' => $user_id,
            'club_id' =>   $club_id,
        ];

        $result=Db::table('attentions')->insert($data,true);
        $result2 = Db::table('clubs')->where('club_id',$club_id)->setInc('att_num');  /*俱乐部被关注数+1*/
                if($result && $result2){
                    return json(['seccess'=>1]);
                }else{
                    return json(['message'=>'获取失败']);
                }  
        }else{
            return json(['message'=>'获取失败']);
        }
 
    }      
 /*——————————马兴欣      取消关注俱乐部接口——————————*/   
 //http://localhost/yuejian14/public/index.php/admin/api/unAttClub?user_id=2&club_id=2
    public function unAttClub(){
        $user_id=$_GET["user_id"];
        $club_id=$_GET["club_id"];
        $result0 = db('attentions')
                     ->where('user_id',$user_id)
                     ->where('club_id',$club_id)
                     ->delete();
        $result2 = Db::table('clubs')->where('club_id',$club_id)->setDec('att_num');  /*俱乐部被关注数-1*/           
        if($result0 && $result2){
            return json(['success'=>1]);
                }else{
                    return json(['success'=>0]);
                } 
    }

 /*——————————马兴欣      关注比赛接口——————————*/   
 //http://localhost/yuejian14/public/index.php/admin/api/attGame?user_id=2&match_id=19
    public function attGame(){
        $user_id=$_GET["user_id"];
        $match_id=$_GET["match_id"];
        $result0 = db('attentions')
                   ->where('user_id',$user_id)
                   ->where('match_id',$match_id)
                   ->count();
        if($result0 == 0){
        $data = [
            'user_id' => $user_id,
            'match_id' =>   $match_id,
        ];
        $result=Db::table('attentions')->insert($data,true);
        $result2 = Db::table('matches')->where('match_id',$match_id)->setInc('att_num');  /*比赛被关注数+1*/
                if($result && $result2){
                    return json(['seccess'=>1]);
                }else{
                    return json(['message'=>'获取失败']);
                }  
        }else{
            return json(['message'=>'获取失败']);
        }
    }   
 /*——————————马兴欣      取消关注比赛接口——————————*/   
 //http://localhost/yuejian14/public/index.php/admin/api/unAttGame?user_id=2&match_id=19
    public function unAttGame(){
        $user_id=$_GET["user_id"];
        $match_id=$_GET["match_id"];
        $result0 = db('attentions')
                     ->where('user_id',$user_id)
                     ->where('match_id',$match_id)
                     ->delete();
        $result2 = Db::table('matches')->where('match_id',$match_id)->setDec('att_num');  /*比赛被关注数-1*/           
        if($result0 && $result2){
            return json(['success'=>1]);
                }else{
                    return json(['success'=>0]);
                } 
    }
 /*——————————马兴欣      关注活动接口——————————*/   
 //http://localhost/yuejian14/public/index.php/admin/api/attActivity?user_id=2&aid=7
    public function attActivity(){
        $user_id=$_GET["user_id"];
        $aid=$_GET["aid"];
        $result0 = db('attentions')
                   ->where('user_id',$user_id)
                   ->where('aid',$aid)
                   ->count();
        if($result0 == 0){
        $data = [
            'user_id' => $user_id,
            'aid' =>   $aid,
        ];
        $result=Db::table('attentions')->insert($data,true);
        $result2 = Db::table('activity')->where('aid',$aid)->setInc('att_num');  /*活动被关注数+1*/
                if($result && $result2){
                    return json(['seccess'=>1]);
                }else{
                    return json(['message'=>'获取失败']);
                }  
        }else{
            return json(['message'=>'获取失败']);
        }
    } 
 /*——————————马兴欣      取消关注活动接口——————————*/   
 //http://localhost/yuejian14/public/index.php/admin/api/unAttActivity?user_id=2&aid=7
    public function unAttActivity(){
        $user_id=$_GET["user_id"];
        $aid=$_GET["aid"];
        $result0 = db('attentions')
                     ->where('user_id',$user_id)
                     ->where('aid',$aid)
                     ->delete();
        $result2 = Db::table('activity')->where('aid',$aid)->setDec('att_num');  /*活动被关注数-1*/           
        if($result0 && $result2){
            return json(['success'=>1]);
                }else{
                    return json(['success'=>0]);
                } 
    }

 /*——————————马兴欣      关注训练接口——————————*/   
 //http://localhost/yuejian14/public/index.php/admin/api/attTrain?user_id=2&train_id=6
    public function attTrain(){
        $user_id=$_GET["user_id"];
        $train_id=$_GET["train_id"];
        $result0 = db('attentions')
                   ->where('user_id',$user_id)
                   ->where('train_id',$train_id)
                   ->count();
        if($result0 == 0){
        $data = [
            'user_id' => $user_id,
            'train_id' =>   $train_id,
        ];
        $result=Db::table('attentions')->insert($data,true);
        $result2 = Db::table('trains')->where('train_id',$train_id)->setInc('att_num');  /*训练被关注数+1*/
                if($result && $result2){
                    return json(['seccess'=>1]);
                }else{
                    return json(['message'=>'获取失败']);
                }  
        }else{
            return json(['message'=>'获取失败']);
        }
    }        
//  <!--——————————谷春晓       接口——————————-->
    //用户登录接口
    public function Login(){
        //http://localhost/yuejian/public/index.php/admin/Api/Login?user_name=wuchao&user_password=123456
        $user_name=$_GET['user_name'];
        $user_password=$_GET['user_password'];
                        
        $user=Db::name('users')->where('user_name',$user_name)->find();
                    
        if(!$user){
            return json(['success'=>0]);//用户名不存在
        }else if(($user_password)!=$user['user_password']){
            return json(['success'=>2]);//密码错误
        }else{
            $uid=$user['user_id'];
            $state=$user['state'];
            return json(['success'=>1,'uid'=>$uid,'state'=>$state]);
        }           
    }
        
    //用户注册接口
    public function Register(){
        //http://localhost/yuejian/public/index.php/admin/Api/Register?user_name=lihao&user_password=123456&user_phone=123456&user_email=123
        $user_name=$_GET['user_name'];
        $user_password=$_GET['user_password'];
        $user_phone=$_GET['user_phone'];
        $user_email=$_GET['user_email'];
        
        $date=[
            'user_name'=>$user_name,
            'user_password'=>$user_password,
            'user_phone'=>$user_phone,
            'user_email'=>$user_email, 
            'state'=>1, 
        ];
        $user=Db::name('users')->insert($date);     
//      dump($user);exit(); 
        if($user){
            return json(['success'=>1]);
        }else{
            return json(['success'=>0]);
        }
    }
    
    //查看用户信息接口
    public function getUser(){
        //http://localhost/yuejian/public/index.php/admin/Api/getUser?user_id=2
        $user_id=$_GET['user_id'];
        
        $result=Db::name('users')->where('user_id',$user_id)->find();
        
        if($result){
            return json($result);
        }else{
            return json(['message'=>'获取失败']);
        }
    }
    
    //查看俱乐部列表(离我最近)
    public function getClubList(){
        //http://localhost/yuejian14/public/index.php/admin/Api/getClubList
        $clublist1=Db::name('clubs')
                    ->order('distance','acs')
                    ->select();
        $array1=array();
        foreach ($clublist1 as $row) {
            $club_state =$row['club_state'];
            $club_id = $row['club_id'];
            if($club_state==1){
                $clublist2 = Db::name('clubs')->where('club_id',$club_id)->find();
                array_push($array1,$clublist2);
            }else{
                continue;
            } 
        }
        if($array1){
          return json($array1);
        }else{
          return json(['messages'=>'获取失败']);
        }
    }
    //查看俱乐部列表(最具人气)
    public function getAttClubList(){
        //http://localhost/yuejian14/public/index.php/admin/Api/getClubList
        $clublist1=Db::name('clubs')
                    ->order('see_number','acs')
                    ->select();
        $array1=array();
        foreach ($clublist1 as $row) {
            $club_state =$row['club_state'];
            $club_id = $row['club_id'];
            if($club_state==1){
                $clublist2 = Db::name('clubs')->where('club_id',$club_id)->find();
                array_push($array1,$clublist2);
            }else{
                continue;
            } 
        }
        if($array1){
          return json($array1);
        }else{
          return json(['messages'=>'获取失败']);
        }
    }    
    //查看最近比赛列表
    public function getMatchList(){
        //http://localhost/yuejian/public/index.php/admin/Api/getMatchList
        $result=Db::name('matches')->select();
        if($result){
            return json($result);
        }else{
            return json(['message'=>'获取失败']);
        }
    }
    
    //查看比赛详情
    public function getMatchDetails(){
        //http://localhost/yuejian/public/index.php/admin/Api/getMatchDetails?match_id=13
        $match_id=$_GET['match_id'];
        
        $result=Db::name('matches')->where('match_id',$match_id)->find();
        
        if($result){
            return json($result);
        }else{
            return json(['message'=>'获取失败']);
        }
    }
            
}