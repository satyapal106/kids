<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\BranchModel;
use Image;
use Excel;

class BranchController extends Controller
{
    public function admin_profile()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $data['title'] = "Kids || Admin";
            $data['nav'] = "admin-profile";
            $data['data'] = $model->getData('tbl_login',array('role_id'=>'1'),'first');
            return view('admin.admin_profile', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function update_admin_profile($id)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            //echo $id; exit;
            $model = new BranchModel();
            $data['data'] = $model->getData('tbl_login', array('id' => $id), 'first');
            //echo "<pre>";print_r($data);exit;
            $data["title"] = "edit-admin-profile";
            $data["nav"] = "edit-admin-profile";
            return view('admin.edit-admin-profile', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function update_admin_password(Request $request){
        if(Session::has('admin')){
            $model = new BranchModel();
            $post = $request->all();
           // echo "<pre>";print_r(Session::get('admin')->id);exit;
            $admin = $model->getData('tbl_login', array('id'=> Session::get('admin')->id), 'first');
            //echo "<pre>";print_r($admin);exit;
            if($admin!=""){
                if(md5($post['old_password']) == $admin->password){
                    if($post['confirm_password'] == $post['new_password']){
                        $sql = $model->update_data('tbl_login', array('id'=> Session::get('admin')->id), array('password'=> md5($post['new_password']), 'salt_password'=>$post['new_password']));
                        if($sql['code'] == 200){
                            Session::flash('success', 'Thanks! Password update successful..');
                        }else{
                            Session::flash('error', 'Opps! Getting error.');
                        }

                    }else{
                        Session::flash('warning', 'Opps! Confirm password not match.');
                    }

                }else{
                    Session::flash('warning', 'Opps! Old password not match.');
                }
                return redirect($_SERVER['HTTP_REFERER']);
            }else{
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            return redirect('/');
        }
    }
    public function update_profile(Request  $request){
        if(Session::has('admin')){
            $post = $request->all();
            //echo "<pre>";print_r($post);exit;
            $model = new BranchModel();
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $path = "admin-assets/images/";
                $uploadImage = $this->storeImages($image, $path, 300, 300);
                $post['input']['image'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            $sql = $model->update_data('tbl_login', array('id'=>$post['where']['id']), $post['input']);
            if($sql['code'] == 200){
                Session::flash('success', 'Thanks! Your profile is update..');
            }else{
                Session::flash('danger', 'Opps! Getting error');
            }
            return redirect($_SERVER['HTTP_REFERER']);
        }else{
            return redirect('/');
        }
    }
    public function new_media()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $data['title'] = "Kids || Admin";
            $data['nav'] = "new-media";
            $data['data'] = $model->getData('tbl_media','','get',array('id'=>'Asc'));
            return view('admin.new-media', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function  post_new_media(Request $request){
        if(Session::has('admin')){
            $post = $request->all();
            $model = new BranchModel();
            $post['input']['is_active'] = "1";
            $post['input']['date_time'] = date('Y-m-d', time());
            $sql = $model->insert_data('tbl_media',$post['input']);
            //echo "<pre>";print_r($sql);exit;
            if($sql['code'] == 200){
                Session::flash('success', 'new media insert successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect($_SERVER['HTTP_REFERER']);
        }else{
            return redirect('/auth');
        }
    }
    public function update_media($id){
        $url = url()->current();
        if(Session::has('admin')){
        	//echo $id; exit;
            $model = new BranchModel();
            $data['media'] = $model->getData('tbl_media',array('id'=>$id),'first');
            //echo "<pre>";print_r($data);exit;
            $data["title"] = "edit-media";
            $data["nav"] = "edit-media";
            return view('admin.edit-media' ,$data);
        }else{
            return redirect('/auth?url=' . $url);
        }
    }public function post_update_media(Request $request){
        if(Session::has('admin')){
            $post=$request->all();
            //echo '<pre>'; print_r($post); exit;
            $model = new BranchModel();
            $post['input']['date_time'] = date('Y-m-d', time());
            $post['input']['is_active'] = "1";
            //echo '<pre>'; print_r($post['input']); exit;
            $sql = $model->update_data_all('tbl_media',$post['input'],$post['where']);

            if($sql['code'] == 200){
                Session::flash('success', 'media Updated successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect('admin/new-media');
        }else{
            return redirect('/auth');
        }
    } 
    public function new_branch()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-branch";
            $lastId = $model->getLastId('tbl_branch', 'id', '');
            if ($lastId == "") {
                $data['last_id'] = 1;
            } else {
                $data['last_id'] = $lastId->id + 1;
            }
            $data['data'] = $model->getData('tbl_branch', '', 'get');
            return view('admin.new-branch', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function storeImages($pic, $destinationPath, $width, $height)
    {
        //$originalImage= $request->file('filename');
        $thumbnailImage = Image::make($pic);
        $thumbnailPath = $destinationPath . 'thumbnail_images/';
        $originalPath = $destinationPath;
        $file = time() . $pic->getClientOriginalName();
        $thumbnailImage->save($originalPath . $file);
        $thumbnailImage->resize($width, $height);
        $thumbnailImage->save($thumbnailPath . $file);
        return $file;
    }
    public function post_new_branch(Request $request)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $post = $request->all();
            if($request->hasFile('logo')) {
                $image = $request->file('logo');
                $path = "admin-assets/images/branch_logo/";
                $uploadImage = $this->storeImages($image, $path, 100, 100);
                $post['input']['logo'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            if ($post['where']['id'] == "") {
                //insert
                $sql = $model->insert_data('tbl_branch', array_merge($post['input'], array('is_active' => '1', 'date_time' => date('Y-m-d', time()))));
                if ($sql['code'] == 200) {
                    $branch_id = $sql['last_id'];
                    if(count($post['branch_login']) !=0){
                        foreach ($post['branch_login'] as $row){
                            $data_login = array(
                                'branch_id' => $branch_id,
                                'name' => $row['name'],
                                'email' => $row['email'],
                                'password' => md5($row['password']),
                                'salt_password' => $row['salt_password'],
                                'is_active' => '1',
                                'date_time' => date('Y-m-d', time()),
                            );
                            $model->insert_data('tbl_login', $data_login);
                        }
                    }
                    Session::flash('success', 'branch Insert Successful.');

                } else {
                    Session::flash('success', 'Getting Error');
                }
                //echo '<pre>'; print_r($sql['input']); exit;
                
            } else {
                //echo '<pre>'; print_r($post['input']); exit;
                $sql = $model->update_data('tbl_branch',$post['where'], $post['input']);
                if ($sql['code'] == 200) {
                     Session::flash('success', 'Update branch Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function All_branch(){
        if(Session::has('admin')){
            $model = new BranchModel();
            $data['title'] = "Admin Panel";
            $data['nav'] = "home";
            $data['data'] = $model->getData('tbl_branch', '', 'get');
            //echo '<pre>'; print_r($data['data']); exit;
            return view('admin.all-branch', $data);
        }else{
            return redirect('/auth');
        }
    }
    public function update_branch()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $data['id'] = $_GET['id'];
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-branch";
            $data['details'] = $model->getData('tbl_branch', array('id' => $_GET['id']), 'first', array('id' => 'Desc'));

            return view('admin.new-branch', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function get_single_details(){
        if(Session::has('admin')){
            $model = new BranchModel();
            $sql = $model->getData('tbl_'.$_GET['tab'], $_GET['where'], 'first');
            return json_encode(array('code'=> 200, 'data'=> $sql));
        }else{
            return json_encode(array('code'=>404, 'msg'=>'Auth not fond try again.'));
        }
    }
    public function update_status(Request $request){
        $model = new BranchModel();
        $post = $request->all();
        $sql = $model->update_data('tbl_' . $post['tab'], $post['where'], $post['input']);
        if ($sql['code'] == 200) {
            return json_encode(array('code' => 200, 'msg' => 'Status update successful.'));
        } else {
            return json_encode(array('code' => 400, 'msg' => 'Getting Errro.'));
        }
    }
    public function QrCode_generate($id){
        if(Session::has('admin')){
            //echo $id; exit;
            $id = base64_decode($id);
            $model = new BranchModel();
            //$data['course'] =$model->getData('tbl_course', array('is_active'=>'1'),'get',array('title'=>'ASC'));
            $data['branch'] = $model->getData('tbl_branch',array('id'=>$id),'first');
            //echo "<pre>";print_r($data);exit;
            $data["title"] = "dashboard";
            return view('admin.dashboard' ,$data);
        }else{
            return redirect('admin/login');
        }
    } 
    public function loginBranch($id){
            $model = new BranchModel();
            $data['branch'] = $model->getData('tbl_branch',array('id'=>$id),'first');
            //echo "<pre>";print_r($data);exit;
            $data["title"] = "login-branch";
            return view('branch.branch-dashboard' ,$data);
        } 
        public function new_school()
        {
            $url = url()->current();
            if (Session::has('admin')) {
                $model = new BranchModel();
                $data['title'] = "kids School || Admin";
                $data['nav'] = "new-school";
                $data['branch'] = $model->getData('tbl_branch', '', 'get');
                $lastId=$model->getLastId('tbl_school','id','');
                if($lastId == ""){
                    $data['last_id']= 1;
                }else{
                    $data['last_id']= $lastId->id + 1;
                }
                return view('admin.new-school', $data);
            } else {
                return redirect('/auth?url=' . $url);
            }
        }
    public function post_new_school(Request $request)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $post = $request->all();
            if ($post['where']['id'] == "") {

                $data=array(
                    'name'=> $post['input']['name'],
                    'branch_id'=> $post['input']['branch_id'],
                    'contact_person'=> $post['input']['contact_person'],
                    'school_email'=> $post['input']['school_email'],
                    'contact_email'=> $post['input']['contact_email'],
                    'contact_number'=> $post['input']['contact_number'],
                    'contact_person'=> $post['input']['contact_person'],
                    'zip'=> $post['input']['zip'],
                    'city'=> $post['input']['city'],
                    'state'=> $post['input']['state'],
                    'country'=> $post['input']['country'],
                    'note'=> $post['input']['note'],
                    'is_active'=>'1',
                    'date_time'=> date('Y-m-d', time()),
                );
                //insert
                // $check = $model->getData('tbl_school', array('category_url' => $post['input']['category_url']), 'first');
                // if ($check == "") {
                    //insert
                    $sql = $model->insert_data('tbl_school',$data);
                    if ($sql['code'] == 200) {
                        $school_id=$sql['last_id'];
                         $tchr_data= array(
                            'branch_id'=> $post['input']['branch_id'],
                            'school_id'=> $school_id,
                            'user_type'=> 'teacher',
                            'user_id'=> $post['input']['teacher_id'],
                            'user_password'=> $post['input']['teacher_password'],
                            'is_active'=>'1',
                            'date_time'=> date('Y-m-d', time()),
                         );
                         $sql1 = $model->insert_data('tbl_user_login',$tchr_data);
                         if ($sql1['code'] == 200) {
                            $school_id=$sql['last_id'];
                             $stu_data= array(
                                'branch_id'=> $post['input']['branch_id'],
                                'school_id'=> $school_id,
                                'user_type'=> 'student',
                                'user_id'=> $post['input']['student_id'],
                                'user_password'=> $post['input']['student_password'],
                                'is_active'=>'1',
                                'date_time'=> date('Y-m-d', time()),
                             );
                             $sql2 = $model->insert_data('tbl_user_login',$stu_data);
                             if ($sql2['code'] == 200) {
                                Session::flash('success', 'Update School Successful.');
                            } 
    
                        }
                       
                    } else {
                        Session::flash('error', 'Getting Error');
                    }
                // } else {
                //     Session::flash('warning', $post['input']['name'] . ' Category exits.');

                // }
            } else {
                //update
                $sql = $model->update_data('tbl_school', $post['where'], $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update School Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function All_School(){
        if(Session::has('admin')){
            $model = new BranchModel();
            $data['title'] = "Admin Panel";
            $data['nav'] = "home";
            //$data['data'] = $model->getData('tbl_school', '', 'get');
            $data['data'] = $model->getAllSchool('paginate',array('tbl_school.is_delete'=> '1'));
            //echo '<pre>'; print_r($data['data']); exit;
            return view('admin.all-school', $data);
        }else{
            return redirect('/auth');
        }
    }
    public function update_school()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $data['id'] = $_GET['id'];
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-school";
            $data['branch'] = $model->getData('tbl_branch', '', 'get');
            $data['details'] = $model->getData('tbl_school', array('id' => $_GET['id']), 'first', array('id' => 'Desc'));
            $data['teacher'] = $model->getData('tbl_user_login', array('school_id' => $_GET['id'],'user_type'=>'teacher'), 'first', array('id' => 'Desc'));
            $data['student'] = $model->getData('tbl_user_login', array('school_id' => $_GET['id'],'user_type'=>'student'), 'first', array('id' => 'Desc'));
            return view('admin.new-school', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function All_teacher(){
        if(Session::has('admin')){
            $model = new BranchModel();
            $data['title'] = "Admin Panel";
            $data['nav'] = "home";
            $data['teacher'] = $model->getData('tbl_branch', array('user_type'=>'teacher'), 'get');
            //echo '<pre>'; print_r($data['data']); exit;
            return view('admin.all-teacher', $data);
        }else{
            return redirect('/auth');
        }
    }
    public function new_class()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-class";
            return view('admin.new-class', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function post_new_class(Request $request)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $post = $request->all();
            if($request->hasFile('class_image')) {
                $image = $request->file('class_image');
                $path = "admin-assets/images/class/";
                $uploadImage = $this->storeImages($image, $path, 500, 500);
                $post['input']['class_image'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            if ($post['where']['id'] == "") {
                //insert
                // $check = $model->getData('tbl_school', array('category_url' => $post['input']['category_url']), 'first');
                // if ($check == "") {
                    //insert
                    $sql = $model->insert_data('tbl_class', array_merge($post['input'], array('is_active' => '1', 'date_time' => date('Y-m-d', time()))));
                    if ($sql['code'] == 200) {
                        Session::flash('success', 'New class Insert Successful.');
                    } else {
                        Session::flash('error', 'Getting Error');
                    }
                // } else {
                //     Session::flash('warning', $post['input']['name'] . ' Category exits.');

                // }
            } else {
                //update
                $sql = $model->update_data('tbl_class', $post['where'], $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update class Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }
        public function All_class()
        {
            $url = url()->current();
            if (Session::has('admin')) {
                $model = new BranchModel();
                $data['title'] = "kids School || Admin";
                $data['nav'] = "all-class";
                $data['data'] = $model->getData('tbl_class', '', 'get',array('id'=>'Asc'));
                return view('admin.all-class', $data);
            } else {
                return redirect('/auth?url=' . $url);
            }
        }
    public function update_class()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $data['id'] = $_GET['id'];
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-class";
            $data['details'] = $model->getData('tbl_class', array('id' => $_GET['id']), 'first', array('id' => 'Desc'));
            return view('admin.new-class', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }

    public function new_subject()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-subject";
            return view('admin.new-subject', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function post_new_subject(Request $request)
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $post = $request->all();
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $path = "admin-assets/images/subject_image/";
                $uploadImage = $this->storeImages($image, $path, 500, 500);
                $post['input']['image'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            if ($post['where']['id'] == "") {
                //insert
                // $check = $model->getData('tbl_school', array('category_url' => $post['input']['category_url']), 'first');
                // if ($check == "") {
                    //insert
                    $sql = $model->insert_data('tbl_subject', array_merge($post['input'], array('is_active' => '1', 'date_time' => date('Y-m-d', time()))));
                    if ($sql['code'] == 200) {
                        Session::flash('success', 'New subject Insert Successful.');
                    } else {
                        Session::flash('error', 'Getting Error');
                    }
                // } else {
                //     Session::flash('warning', $post['input']['name'] . ' Category exits.');

                // }
            } else {
                //update
                $sql = $model->update_data('tbl_subject', $post['where'], $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update subject Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }
        public function All_subject()
        {
            $url = url()->current();
            if (Session::has('admin')) {
                $model = new BranchModel();
                $data['title'] = "kids School || Admin";
                $data['nav'] = "all-subject";
                $data['data'] = $model->getData('tbl_subject', '', 'get',array('id'=>'Desc'));
                return view('admin.all-subject', $data);
            } else {
                return redirect('/auth?url=' . $url);
            }
        }
    public function update_subject()
    {
        $url = url()->current();
        if (Session::has('admin')) {
            $model = new BranchModel();
            $data['id'] = $_GET['id'];
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-subject";
            $data['details'] = $model->getData('tbl_subject', array('id' => $_GET['id']), 'first', array('id' => 'Desc'));
            return view('admin.new-subject', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
        public function get_address(Request $request){
            $post = $request->all();
            $url = "http://www.postalpincode.in/api/pincode/".$post['pincode'];
            $address = $this->thiCurl($url);
            $address = json_decode($address, true);
            //echo '<pre>'; print_r($address); exit;
            $data = array();
            if(count($address['PostOffice']) !=0){
                $data['district']   = $address['PostOffice'][0]['District'];
                $data['region']     = $address['PostOffice'][0]['Region'];
                $data['state']      = $address['PostOffice'][0]['State'];
                $data['country']    = $address['PostOffice'][0]['Country'];
            }
            //echo '<pre>'; print_r($data); exit;
            return json_encode($data);
    
        }
        public function thiCurl($url){
            $curl_handle=curl_init();
            curl_setopt($curl_handle,CURLOPT_URL,$url);
            curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
            curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
            $buffer = curl_exec($curl_handle);
            curl_close($curl_handle);
            return $buffer;
        }

        public function BranchBySchool(Request $request)
        {
            $post = $request->all();
            $model = new BranchModel();
            $sql = $model->getData('tbl_school', array('branch_id' => $post['branch_id'], 'is_active' => '1'), 'get');
            $div = '<option value="">Select School</option>';
            if (count($sql) != 0) {
                foreach ($sql as $row) {
                    $div .= '<option value="' . $row->id . '">' . $row->name . '</option>';
                }

            }
            return json_encode(array('code' => 200, 'data' => $div));
        }
}
