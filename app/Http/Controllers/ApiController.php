<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\BranchModel;
use App\Models\ApiModel;
use Image;
use Excel;
class ApiController extends Controller
{
    public function student_login(Request $request){
        $model = new BranchModel();
        $post=$request->all();
        $data_school= ApiModel::student_data(array('tbl_user_login.is_active'=>'1','tbl_user_login.user_type'=>$post['type'], 'tbl_user_login.user_id'=>$post['userid'],'tbl_user_login.school_id'=>$post['schoolname'],'tbl_user_login.user_password'=>$post['password'], 'tbl_school.is_active'=>'1'),'first');
        if($data_school!=''){
            $check = $model->getData('tbl_users', array('user_type'=> $post['type'],'school_id'=> $post['schoolname'],'contact_number'=> $post['phonenumber'],'class'=> $post['class'] ), 'first');
            if($check !=""){
                //update
                $data =array(
                    'user_name' => $post['studentname'],
                    'city'      => $post['city'],
                );
                $model->update_data('tbl_users',array('id'=>$check->id), $data);
                $return_data = array(
                    'id'=> $check->id,
                    'user_name' => $check->user_name,
                    'contact_number' => $check->contact_number,
                    'branch_id' => $check->branch_id,
                    'school_id' => $check->school_id,
                    'class'     => $check->class,
                    'city'      => $check->city,
                );
                return json_encode(array('code'=> 200, 'data'=> $return_data));
            }else{
                //insert
                $data =array(
                    'log_id'    => $data_school->login_id,
                    'branch_id' => $data_school->branch_id,
                    'school_id' => $data_school->id,
                    'class'     => $post['class'],
                    'user_type' => $post['type'],
                    'user_name' => $post['studentname'],
                    'contact_number' => $post['phonenumber'],
                    'city'      => $post['city'],
                    'is_active' => '1',
                    'date_time' => date('Y-m-d', time())
                );
                $insert_data = $model->insert_data('tbl_users', $data);
                if($insert_data['code'] == 200){
                    $return_data = array(
                        'id'=> $insert_data['last_id'],
                        'user_name' => $post['studentname'],
                        'contact_number' => $post['phonenumber'],
                        'branch_id' => $data_school->branch_id,
                        'school_id' => $data_school->id,
                        'class'     => $post['class'],
                        'city'      => $post['city'],
                    );
                    return json_encode(array('code'=> 200, 'data'=> $return_data));
                }
            }


            //echo  '<pre>';  print_r($data_school); exit;
        }else{
            return json_encode(array('code'=>319,'msg'=>'user id and password not match try again'));
        }
        //echo  '<pre>';  print_r($post); exit;

    }


    public function all_class(){
        $model = new BranchModel();
      ;
        if(isset($_GET['branch_id'])){
            if($_GET['branch_id']!=''){
                $branch_id = $_GET['branch_id'];

                $data = $model->getData('tbl_class',array('is_active'=>'1','branch_id'=>$branch_id),'get',array('id'=>'Asc'));
                if(count($data)!=0){
                    return json_encode(array('code'=>200,'data'=>$data));
                }
                else{
                    return json_encode(array('code'=>300,'msg'=>'data not found'));
                }

            }
            else{
                return json_encode(array('code'=>300,'msg'=>'Doesnt branch id '));
            }
        }
        else{
            return json_encode(array('code'=>300,'msg'=>'Doesnt find branch id '));

        }


    }

    public function get_subject_by_class(){

        $model = new BranchModel();
        if(isset($_GET['class_id'])){
            if($_GET['class_id']!=''){
                $class_id = $_GET['class_id'];

                $data = $model->getData('tbl_book',array('is_active'=>'1','class_id'=>$class_id),'get',array('id'=>'Asc'));
                if(count($data)!=0){
                    return json_encode(array('code'=>200,'data'=>$data));
                }
                else{
                    return json_encode(array('code'=>300,'msg'=>'data not found'));
                }

            }
            else{
                return json_encode(array('code'=>300,'msg'=>'Doesnt branch id '));
            }
        }
        else{
            return json_encode(array('code'=>300,'msg'=>'Doesnt find branch id '));

        }





}
    public function all_school(){
        $model = new BranchModel();

        $data = $model->getData('tbl_school',array('is_active'=>'1'),'get',array('id'=>'Asc'));
        if(count($data)!=0){
            return json_encode(array('code'=>200,'data'=>$data));
        }
        else{
            return json_encode(array('code'=>300,'msg'=>'data not found'));
        }
    }
    public function all_subject(){
        $model = new BranchModel();
        $data = $model->getData('tbl_subject',array('is_active'=>'1'),'get',array('id'=>'Asc'));
        //echo  '<pre>';  print_r($data); exit;
        if(count($data)!=0){
            return json_encode(array('code'=>200,'data'=>$data));
        }
        else{
            return json_encode(array('code'=>300,'msg'=>'data not found'));
        }
    }
    public function all_book(){
        $model = new BranchModel();
        $data = $model->getData('tbl_subject',array('is_active'=>'1'),'first',array('id'=>'Asc'));
        $data = $model->getAllBook('tbl_subject',array('is_active'=>'1'),'get',array('id'=>'Asc'));
        //echo  '<pre>';  print_r($data); exit;
        if(count($data)!=0){
            return json_encode(array('code'=>200,'data'=>$data));
        }
        else{
            return json_encode(array('code'=>300,'msg'=>'data not found'));
        }
    }
    
    
    public function getAllBookBySchool(Request $request)
    
    {
        $post = $request->all();
        $data = BranchModel::getAllSchoolBook('get',array('tbl_book.is_delete'=>'1','tbl_book.is_active'=>'1' ,'tbl_book_school.is_active'=>'1','tbl_book_school.class_id'=>trim($post['class_id']),'tbl_book_school.school_id'=>trim($post['school_id']),'tbl_book_school.subject_id'=>trim($post['subject_id']),'tbl_class.is_active'=>'1','tbl_subject.is_active'=>'1'),'','',array('tbl_book.id'=>'Asc'));
        if(count($data)!=0){
            return json_encode(array('code'=>200 , 'data'=>$data));
            
        }
        else{
             return json_encode(array('code'=>400 , 'msg'=>'data not found'));
        }
    }

    public function getAllVideoBySubject(Request $request){
        $post = $request->all();
        $data = BranchModel::getAllSchoolBook('get',array('tbl_book_course.is_delete'=>'1','tbl_book_course.is_active'=>'1','tbl_book_course.book_id'=>trim($post['book_id']), 'tbl_book_course.school_id'=>trim($post['school_id']),'tbl_book.id'=>trim($post['id'])) , '' ,'' , array('tbl_book.id'=>'Asc'));

        if(count($data)!=0){
            return json_encode(array('code'=>200 , 'data'=>$data));

        }
        else{
            return json_encode(array('code'=>400 , 'msg'=>'data not found'));
        }


    }
    public function getAllLogin(Request $request)
    {
        $model = new BranchModel();
        $post=$request->all();
        $data_school= ApiModel::student_data(array('tbl_user_login.is_active'=>'1', 'tbl_user_login.user_id'=>$post['userid'],'tbl_user_login.user_password'=>$post['password'],'tbl_user_login.user_type'=>$post['type'], 'tbl_school.is_active'=>'1'),'first');
        if($data_school!=''){
            $check = $model->getData('tbl_users', array('contact_number'=> $post['phonenumber'] ), 'first');
            if($check !="") {
                //update
                $data = array(
                    'contact_number' => $post['phonenumber']

                );
                $model->update_data('tbl_users', array('id' => $check->id), $data);
                $return_data = array(
                    'id' => $check->id,
                    'user_name' => $check->user_name,
                    'contact_number' => $check->contact_number,
                    'branch_id' => $check->branch_id,
                    'school_id' => $check->school_id,
                    'class' => $check->class,
                    'type'=>$check->user_type,
                    'city' => $check->city,
                );
                if(count($return_data) !=0){
                    return json_encode(array('code' => 200, 'data' => $return_data));
                }else{
                    return json_encode(array('code'=> 301, 'msg'=> 'data not found'));
                }


            }
      }
    }

    public function getDataByBranchId(Request $request){

        $post = $request->all();
        $data = BranchModel::getAllSchool('get',array('tbl_school.is_active'=>'1','tbl_branch.is_active'=>'1','tbl_branch.id'=>trim($post['branch_id'])), '' ,'',array('tbl_branch.id'=>'Asc'));
        if(count($data)!=0){
            return json_encode(array('code'=>200 , 'data'=>$data));

        }
        else{
            return json_encode(array('code'=>400 , 'msg'=>'data not found'));
        }


    }
}
