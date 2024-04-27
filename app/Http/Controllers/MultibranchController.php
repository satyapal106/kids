<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\FunctionModel;
use App\Models\LoginModel;
use App\Models\BranchModel;
use Image;
use Excel;
class MultibranchController extends Controller
{
    public function branch_dashboard(){
        if(Session::has('branch')){
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "Admin Panel";
            $data['nav'] = "branch-dashboard";
            $data['data'] = $model->getData('tbl_branch',array('id'=>$branch_id),'first');
            //echo '<pre>'; print_r($data); exit;
            return view('branch.branch-dashboard', $data);
        }else{
            return redirect('/branch');
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
    public function new_School()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-school";
            //$data['data'] = $model->getData('tbl_subject',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            return view('branch.new-school', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    // public function  post_new_School(Request $request){
    //     if(Session::has('branch')){
    //         $post = $request->all();
    //         $post['input']['branch_id'] = session::get('branch')->branch_id;
    //         //echo "<pre>";print_r($post);exit;
    //         $model = new BranchModel();
    //         $post['input']['is_active'] = "1";
    //         $post['input']['date_time'] = date('Y-m-d', time());
    //         //echo "<pre>";print_r($post);exit;
    //         $sql = $model->insert_data('tbl_school',$post['input']);
    //         //echo "<pre>";print_r($sql);exit;
    //         if($sql['code'] == 200){
    //             Session::flash('success', 'School insert successful.');
    //         }else{
    //             Session::flash('error', 'getting error.');
    //         }
    //         return redirect($_SERVER['HTTP_REFERER']);
    //     }else{
    //         return redirect('/auth');
    //     }
    // }
    public function post_new_school(Request $request)
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $post['input']['branch_id'] = session::get('branch')->branch_id;
            
            $post = $request->all();

            if ($post['where']['id'] == "") {

                $data=array(
                    'branch_id' =>session::get('branch')->branch_id,
                    'name'=> $post['input']['name'],
                    'contact_person'=> $post['input']['contact_person'],
                    'school_email'=> $post['input']['school_email'],
                    'contact_email'=> $post['input']['contact_email'],
                    'contact_number'=> $post['input']['contact_number'],
                    'zip'=> $post['input']['zip'],
                    'city'=> $post['input']['city'],
                    'state'=> $post['input']['state'],
                    'country'=> $post['input']['country'],
                    'note'=> $post['input']['note'],
                    'is_active'=>'1',
                    'date_time'=> date('Y-m-d', time()),
                );
                //echo '<pre>'; print_r($data); exit;
                //insert
                $check = $model->getData('tbl_school', array('name' => $post['input']['name']), 'first');
                if ($check == "") {
                    //insert
                    $sql = $model->insert_data('tbl_school',$data);
                    if ($sql['code'] == 200) {
                        $school_id=$sql['last_id'];
                         $tchr_data= array(
                            'branch_id' =>session::get('branch')->branch_id,
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
                                'branch_id' =>session::get('branch')->branch_id,
                                'school_id'=> $school_id,
                                'user_type'=> 'student',
                                'user_id'=> $post['input']['student_id'],
                                'user_password'=> $post['input']['student_password'],
                                'is_active'=>'1',
                                'date_time'=> date('Y-m-d', time()),
                             );
                             $sql2 = $model->insert_data('tbl_user_login',$stu_data);
                             if ($sql2['code'] == 200) {
                                Session::flash('success', 'Insert New  School Successful.');
                            } 
    
                        }
                       
                    } else {
                        Session::flash('error', 'Getting Error');
                    }
                } else {
                    Session::flash('warning', $post['input']['name'] . ' School name Already exits.');

                }
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
    public function All_school(){
        if(Session::has('branch')){
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "All-School";
            $data['nav'] = "all-school";
            //$data['data'] = $model->getData('tbl_school', '', 'get');
            $data['data'] = $model->getAllSchool('get', array('tbl_branch.id'=>Session::get('branch')->branch_id,'tbl_school.branch_id'=>Session::get('branch')->branch_id,'tbl_school.is_delete'=>'1'));
            //$data['login_detail'] = $model->getLogin('get', array('tbl_branch.id'=>Session::get('branch')->branch_id, 'tbl_user_login.user_type'=>'student',));
            //echo '<pre>'; print_r($data['data']); exit;
            return view('branch.all-school', $data);
        }else{
            return redirect('/auth');
        }
    }
    public function update_school($id){
        $url = url()->current();
        if(Session::has('branch')){
        	//echo $id; exit;
            $model = new BranchModel();
            $data['details'] = $model->getData('tbl_school',array('id'=>$id),'first');
            //echo "<pre>";print_r($data);exit;
            $data["title"] = "edit-school";
            $data['nav'] = "edit-school";
            return view('branch.edit-school' ,$data);
        }else{
            return redirect('/auth?url=' . $url);
        }
    }
    public function post_update_school(Request $request){
        if(Session::has('branch')){
            $post=$request->all();
            $post['input']['branch_id'] = session::get('branch')->branch_id;
            //echo '<pre>'; print_r($post); exit;
            $model = new BranchModel();
            $post['input']['date_time'] = date('Y-m-d', time());
            $post['input']['is_active'] = "1";
            //echo '<pre>'; print_r($post['input']); exit;
            $sql = $model->update_data_all('tbl_school',$post['input'],$post['where']);

            if($sql['code'] == 200){
                Session::flash('success', 'school Updated successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect('branch/all-school');
        }else{
            return redirect('/auth');
        }
    } 
    public function new_slider()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-slider";
            //$data['data'] = $model->getData('tbl_subject',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            return view('branch.new-slider', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function  post_new_slider(Request $request){
        if(Session::has('branch')){
            $post = $request->all();
            $post['input']['branch_id'] = session::get('branch')->branch_id;
            //echo "<pre>";print_r($post);exit;
            $model = new BranchModel();
            if ($request->hasFile('slider')) {
                $image = $request->file('slider');
                $path = "admin-assets/images/slider/";
                $uploadImage = $this->storeImages($image, $path, 1920, 500);
                $post['input']['slider'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            $post['input']['is_active'] = "1";
            $post['input']['date_time'] = date('Y-m-d', time());
            //echo "<pre>";print_r($post);exit;
            $sql = $model->insert_data('tbl_slider',$post['input']);
            //echo "<pre>";print_r($sql);exit;
            if($sql['code'] == 200){
                Session::flash('success', 'slider insert successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect($_SERVER['HTTP_REFERER']);
        }else{
            return redirect('/auth');
        }
    }
    public function All_slider()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "all-slider";
            $data['data'] = $model->getData('tbl_slider',array('branch_id'=>Session::get('branch')->branch_id,'is_active'=>'1'), 'get');
            return view('branch.all-slider', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function About()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "about";
            $check= $model->getData('tbl_about', array('branch_id'=>Session::get('branch')->branch_id), 'first');
            if($check!=""){
                return redirect('branch/about-detail');
            }
            return view('branch.about',$data);
           } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function  post_about(Request $request){
        if(Session::has('branch')){
            $post = $request->all();
            $post['input']['branch_id'] = session::get('branch')->branch_id;
            //echo "<pre>";print_r($post);exit;
            $model = new BranchModel();
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $path = "admin-assets/images/about/";
                $uploadImage = $this->storeImages($image, $path, 500, 500);
                $post['input']['image'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            $post['input']['is_active'] = "1";
            $post['input']['date_time'] = date('Y-m-d', time());
            //echo "<pre>";print_r($post);exit;
            $sql = $model->insert_data('tbl_about',$post['input']);
            //echo "<pre>";print_r($sql);exit;
            if($sql['code'] == 200){
                Session::flash('success', 'about detial insert successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect($_SERVER['HTTP_REFERER']);
        }else{
            return redirect('/auth');
        }
    } 
    public function About_detail()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "about";
            $data['about']= $model->getData('tbl_about', array('branch_id'=>Session::get('branch')->branch_id), 'first');
            return view('branch.about-detail', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function update_about($id){
        $url = url()->current();
        if(Session::has('branch')){
        	//echo $id; exit;
            $model = new BranchModel();
            $data['about'] = $model->getData('tbl_about',array('id'=>$id),'first');
            //echo "<pre>";print_r($data);exit;
            $data["title"] = "kids School || Admin";
            $data['nav'] = "edit-about";
            return view('branch.edit-about-detail' ,$data);
        }else{
            return redirect('/auth?url=' . $url);
        }
    }
    public function post_update_about(Request $request){
        if(Session::has('branch')){
            $post=$request->all();
            $post['input']['branch_id'] = session::get('branch')->branch_id;
            //echo '<pre>'; print_r($post); exit;
            $model = new BranchModel();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = "admin-assets/images/about/";
                $uploadImage = $this->storeImages($image, $path, 500, 500);
                $post['input']['image'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            //echo '<pre>'; print_r($post['input']); exit;
            $post['input']['date_time'] = date('Y-m-d', time());
            $post['input']['is_active'] = "1";
            //echo '<pre>'; print_r($post['input']); exit;
            $sql = $model->update_data_all('tbl_about',$post['input'],$post['where']);

            if($sql['code'] == 200){
                Session::flash('success', 'about detail Updated successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect('branch/about-detail');
        }else{
            return redirect('/auth');
        }
    }
    public function Contact()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "contact";
            $check= $model->getData('tbl_contact', array('branch_id'=>Session::get('branch')->branch_id), 'first');
            if($check!=""){
                return redirect('branch/contact-detail');
            }
            return view('branch.contact', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function  post_contact(Request $request){
        if(Session::has('branch')){
            $post = $request->all();
            $post['input']['branch_id'] = session::get('branch')->branch_id;
            //echo "<pre>";print_r($post);exit;
            $model = new BranchModel();
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $path = "admin-assets/images/contact/";
                $uploadImage = $this->storeImages($image, $path, 500, 500);
                $post['input']['image'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            $post['input']['is_active'] = "1";
            $post['input']['date_time'] = date('Y-m-d', time());
            //echo "<pre>";print_r($post);exit;
            $sql = $model->insert_data('tbl_contact',$post['input']);
            //echo "<pre>";print_r($sql);exit;
            if($sql['code'] == 200){
                Session::flash('success', 'contact detial insert successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect($_SERVER['HTTP_REFERER']);
        }else{
            return redirect('/auth');
        }
    } 
    public function Contact_detail()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "contact";
            $data['contact']= $model->getData('tbl_contact', array('branch_id'=>Session::get('branch')->branch_id), 'first');
            return view('branch.contact-detail', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function update_contact($id){
        $url = url()->current();
        if(Session::has('branch')){
        	//echo $id; exit;
            $model = new BranchModel();
            $data['contact'] = $model->getData('tbl_contact',array('id'=>$id),'first');
            //echo "<pre>";print_r($data);exit;
            $data["title"] = "kids School || Admin";
            $data['nav'] = "edit-contact";
            return view('branch.edit-contact-detail' ,$data);
        }else{
            return redirect('/auth?url=' . $url);
        }
    }
    public function post_update_contact(Request $request){
        if(Session::has('branch')){
            $post=$request->all();
            $post['input']['branch_id'] = session::get('branch')->branch_id;
            //echo '<pre>'; print_r($post); exit;
            $model = new BranchModel();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = "admin-assets/images/contact/";
                $uploadImage = $this->storeImages($image, $path, 500, 500);
                $post['input']['image'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            //echo '<pre>'; print_r($post['input']); exit;
            $post['input']['date_time'] = date('Y-m-d', time());
            $post['input']['is_active'] = "1";
            //echo '<pre>'; print_r($post['input']); exit;
            $sql = $model->update_data_all('tbl_contact',$post['input'],$post['where']);

            if($sql['code'] == 200){
                Session::flash('success', 'contact detail Updated successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect('branch/contact-detail');
        }else{
            return redirect('/auth');
        }
    }
    public function new_class()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            //echo '<pre>'; print_r($branch_id); exit;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-class";
            //$data['data'] = $model->getData('tbl_class',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            return view('branch.new-class', $data);

        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function post_new_class(Request $request)
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            //echo "<pre>";print_r($branch_id);exit;
            $post = $request->all();
            if($request->hasFile('class_image')) {
                $image = $request->file('class_image');
                $path = "admin-assets/images/class-image/";
                $uploadImage = $this->storeImages($image, $path, 500, 500);
                $post['input']['class_image'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            if ($post['where']['id'] == "") {
                $post['input']['branch_id'] = session::get('branch')->branch_id;
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
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "all-class";
            $data['data'] = $model->getData('tbl_class',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            return view('branch.all-class', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function update_class()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $data['id'] = $_GET['id'];
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-class";
            $data['details'] = $model->getData('tbl_class', array('id' => $_GET['id'],'branch_id'=>Session::get('branch')->branch_id), 'first', array('id' => 'Desc'));
            return view('branch.new-class', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function new_subject()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-subject";
            //$data['data'] = $model->getData('tbl_subject',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            return view('branch.new-subject', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
   
    public function storeImagesPdf($pic,$destinationPath){
        $extension = $pic->getClientOriginalExtension();
        $theam_image = rand(11111, 99999) . time().'.' . $extension; 
        $pic->move($destinationPath, $theam_image); 
        return $destinationPath.'/'.$theam_image;
    }
    public function post_new_subject(Request $request)
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            //echo "<pre>";print_r($branch_id);exit;
            $post = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = "admin-assets/images/subject_image/";
                $uploadImage = $this->storeImages($image, $path, 500, 500);
                $post['input']['image'] = $path . '/thumbnail_images/' . $uploadImage;
            }
                if ($request->hasFile('subject_icon')) {
                $image = $request->file('subject_icon');
                $path = "admin-assets/images/subject_icon/";
                $uploadImage = $this->storeImages($image, $path, 100, 100);
                $post['input']['subject_icon'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            if ($post['where']['id'] == "") {
                $post['input']['branch_id'] = session::get('branch')->branch_id;
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
    // public function  post_new_subject(Request $request){
    //     if(Session::has('branch')){
    //         $post = $request->all();
    //         $post['input']['branch_id'] = session::get('branch')->branch_id;
    //         //echo "<pre>";print_r($post);exit;
    //         $model = new BranchModel();
            // if ($request->hasFile('image')) {
            //     $image = $request->file('image');
            //     $path = "admin-assets/images/subject_image/";
            //     $uploadImage = $this->storeImages($image, $path, 500, 500);
            //     $post['input']['image'] = $path . '/thumbnail_images/' . $uploadImage;
            // }
            //     if ($request->hasFile('subject_icon')) {
            //     $image = $request->file('subject_icon');
            //     $path = "admin-assets/images/subject_icon/";
            //     $uploadImage = $this->storeImages($image, $path, 100, 100);
            //     $post['input']['subject_icon'] = $path . '/thumbnail_images/' . $uploadImage;
            // }
    //         $post['input']['is_active'] = "1";
    //         $post['input']['date_time'] = date('Y-m-d', time());
    //         //echo "<pre>";print_r($post);exit;
    //         $sql = $model->insert_data('tbl_subject',$post['input']);
    //         //echo "<pre>";print_r($sql);exit;
    //         if($sql['code'] == 200){
    //             Session::flash('success', 'subject insert successful.');
    //         }else{
    //             Session::flash('error', 'getting error.');
    //         }
    //         return redirect($_SERVER['HTTP_REFERER']);
    //     }else{
    //         return redirect('/auth');
    //     }
    // }
    public function All_subject()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "all-subject";
            $data['data'] = $model->getData('tbl_subject',array('branch_id'=>Session::get('branch')->branch_id,'is_delete'=>'1'), 'get');
            return view('branch.all-subject', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function update_subject()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $data['id'] = $_GET['id'];
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-subject";
            $data['details'] = $model->getData('tbl_subject', array('id' => $_GET['id'],'branch_id'=>Session::get('branch')->branch_id), 'first', array('id' => 'Desc'));
            return view('branch.new-subject', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    // public function update_subject($id){
    //     $url = url()->current();
    //     if(Session::has('branch')){
    //     	//echo $id; exit;
    //         $model = new BranchModel();
    //         $data['subject'] = $model->getData('tbl_subject',array('id'=>$id),'first');
    //         //echo "<pre>";print_r($data);exit;
    //         $data["title"] = "edit-subject";
    //         $data['nav'] = "edit-subject";
    //         return view('branch.edit-subject' ,$data);
    //     }else{
    //         return redirect('/auth?url=' . $url);
    //     }
    // } 
    public function post_update_subject(Request $request){
        if(Session::has('branch')){
            $post=$request->all();
            $post['input']['branch_id'] = session::get('branch')->branch_id;
            //echo '<pre>'; print_r($post); exit;
            $model = new BranchModel();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = "admin-assets/images/subject_image/";
                $uploadImage = $this->storeImages($image, $path, 100, 100);
                $post['input']['image'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            if ($request->hasFile('subject_icon')) {
                $image = $request->file('subject_icon');
                $path = "admin-assets/images/subject_icon/";
                $uploadImage = $this->storeImages($image, $path, 100, 100);
                $post['input']['subject_icon'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            //echo '<pre>'; print_r($post['input']); exit;
            $post['input']['date_time'] = date('Y-m-d', time());
            $post['input']['is_active'] = "1";
            //echo '<pre>'; print_r($post['input']); exit;
            $sql = $model->update_data_all('tbl_subject',$post['input'],$post['where']);

            if($sql['code'] == 200){
                Session::flash('success', 'subject Updated successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect('branch/all-subject');
        }else{
            return redirect('/auth');
        }
    }
    public function deleteSubject($id){
        if(Session::has('branch')){
            //$post['input']['branch_id'] = session::get('branch')->branch_id;
            //echo '<pre>'; print_r($post['input']); exit;
            $model = new BranchModel();
            $sql = $model->delete_data('tbl_subject',array('id'=>$id));
            if($sql['code'] == 200){
                Session::flash('success', 'Subject Deleted successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect('branch/all-subject');
        }else{
            return redirect('/auth');
        }
    }
    public function get_subject($book){
        if(Session::has('branch')){
        $model = new BranchModel();
        $data['nav'] = "info";
        $data['detail_subject'] = $model->getData('tbl_subject', array('is_active'=> '1'), 'get');
        $data['subject'] = $model->getData('tbl_subject', array('subject_url'=>$book), 'first');
        if($data['subject'] ==""){
            return redirect('/404');
        }
        $data['title'] = $data['subject']->subject;
        $data['meta'] = $data['subject']->subject;
        $data['subject_id'] = $data['subject']->id;
        $data['detail'] = $model->getAllnotes('paginate', array('tbl_notes.subject_id'=> $data['subject']->id, 'tbl_notes.is_active'=> '1'));
        return view('branch.subject-book', $data);
        }else{
            return redirect('/auth');
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
    public function get_single_details(){
        if(Session::has('branch')){
            $model = new BranchModel();
            $sql = $model->getData('tbl_'.$_GET['tab'], $_GET['where'], 'first');
            return json_encode(array('code'=> 200, 'data'=> $sql));
        }else{
            return json_encode(array('code'=>404, 'msg'=>'Auth not fond try again.'));
        }
    }
    public function logout(){
        Session::forget('branch');
        return redirect('/auth');
    }
    public function new_book()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-book";
            $data['subject'] = $model->getData('tbl_subject','', 'get');
            $data['class'] = $model->getData('tbl_class','', 'get');
            return view('branch.new-book', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function post_new_book(Request $request)
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            //echo "<pre>";print_r($branch_id);exit;
            $post = $request->all();
            if($request->hasFile('book_pic')) {
                $image = $request->file('book_pic');
                $path = "admin-assets/images/books/";
                $uploadImage = $this->storeImages($image, $path, 500, 500);
                $post['input']['book_pic'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            if ($post['where']['id'] == "") {
                $post['input']['branch_id'] = session::get('branch')->branch_id;
                //insert
                // $check = $model->getData('tbl_school', array('category_url' => $post['input']['category_url']), 'first');
                // if ($check == "") {
                    //insert
                    $sql = $model->insert_data('tbl_book', array_merge($post['input'], array('is_active' => '1', 'date_time' => date('Y-m-d', time()))));
                    if ($sql['code'] == 200) {
                        Session::flash('success', 'New books Insert Successful.');
                    } else {
                        Session::flash('error', 'Getting Error');
                    }
                // } else {
                //     Session::flash('warning', $post['input']['name'] . ' Category exits.');

                // }
            } else {
                //update
                $sql = $model->update_data('tbl_book', $post['where'], $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update book Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function all_book(){
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "Kids School Admin";
            $data['nav'] = "all-book";
            $data['class'] = $model->getData('tbl_class',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            $data['subject'] = $model->getData('tbl_subject',array('branch_id'=>Session::get('branch')->branch_id,'is_delete'=>'1'), 'get');
            $data['data'] = $model->getAllBook('paginate', array('tbl_book.branch_id'=>Session::get('branch')->branch_id,'tbl_book.is_delete'=>'1'));
            
            //$data['data'] = $model->getData('tbl_notes',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            
            //echo '<pre>'; print_r($data['data']); exit;
            return view('branch.all-book', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function update_book()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $data['id'] = $_GET['id'];
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-school";
            $data['class'] = $model->getData('tbl_class','', 'get');
            $data['subject'] = $model->getData('tbl_subject','', 'get');
            $data['details'] = $model->getData('tbl_book', array('id' => $_GET['id'],'branch_id'=>Session::get('branch')->branch_id), 'first', array('id' => 'Desc'));
            return view('branch.new-book', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function post_update_book(Request $request){
        if(Session::has('branch')){
            $post=$request->all();
            $post['input']['branch_id'] = session::get('branch')->branch_id;
            //echo '<pre>'; print_r($post); exit;
            $model = new BranchModel();
            if($request->hasFile('upload')) {
                $destinationPath ='admin-assets/images/subject_image/';
                $post['input']['upload'] = $this->storeImagesPdf($post['upload'], $destinationPath);
            }
            if ($request->hasFile('head_image')) {
                $image = $request->file('head_image');
                $path = "admin-assets/images/upload-media/";
                $uploadImage = $this->storeImages($image, $path, 500, 500);
                $post['input']['head_image'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            //echo '<pre>'; print_r($post['input']); exit;
            $post['input']['date_time'] = date('Y-m-d', time());
            $post['input']['is_active'] = "1";
            //echo '<pre>'; print_r($post['input']); exit;
            $sql = $model->update_data_all('tbl_notes',$post['input'],$post['where']);

            if($sql['code'] == 200){
                Session::flash('success', 'book Updated successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect('branch/all-book');
        }else{
            return redirect('/auth');
        }
    }
    public function chapter_by_book($co_url){
        $url=url()->current();
        if(Session::has('branch')){
            $model=new BranchModel();
            $data['book']=$model->getData('tbl_book',array('book_url'=>$co_url),'first');
            //echo '<pre>'; print_r($data); exit;
            if($data['book']==""){
                return redirect('/404');
            }
            $data['book_id']=$data['book']->id;
            $data['data'] = $model->getAllUploadCourse('paginate',array('tbl_book_course.branch_id'=>Session::get('branch')->branch_id,'tbl_book_course.book_id'=>$data['book']->id,'tbl_book_course.is_delete'=> '1'));
           // echo '<pre>'; print_r($data['data']); exit;
            $data['detail'] = $model->getAllUploadCourse('first',array('tbl_book_course.branch_id'=>Session::get('branch')->branch_id,'tbl_book_course.book_id'=>$data['book']->id,'tbl_book_course.is_delete'=> '1'));
            //echo '<pre>'; print_r($data['data']); exit;
            $data['title'] = "kids School || Admin";
            return view('branch.all-chapter', $data);
        }else {
            return redirect('/auth?url=' . $url);
        }
    }
     public function  post_new_chapter(Request $request){
         if(Session::has('branch')){
             $post = $request->all();
             $post['input']['branch_id'] = session::get('branch')->branch_id;
             //echo "<pre>";print_r($post);exit;
             $model = new BranchModel();
             if($request->hasFile('upload')) {
                 $destinationPath ='admin-assets/images/subject_image/';
                 $post['input']['upload'] = $this->storeImagesPdf($post['upload'], $destinationPath);
             }
             $post['input']['is_active'] = "1";
             $post['input']['date_time'] = date('Y-m-d', time());
             //echo "<pre>";print_r($post);exit;
             $sql = $model->insert_data('tbl_book_course',$post['input']);
             //echo "<pre>";print_r($sql);exit;
             if($sql['code'] == 200){
                 Session::flash('success', 'new chapter insert successful.');
             }else{
                 Session::flash('error', 'getting error.');
             }
             return redirect($_SERVER['HTTP_REFERER']);
         }else{
             return redirect('/auth');
         }
     }
    public function new_chapter()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-book";
            $data['class'] = $model->getData('tbl_class',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            $data['subject'] = $model->getData('tbl_subject',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            $data['school'] = $model->getData('tbl_school',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            return view('branch.new-chapter', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function new_school_book()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-book";
            $data['class'] = $model->getData('tbl_class','', 'get');
            $data['subject'] = $model->getData('tbl_subject','', 'get');
            $data['school'] = $model->getData('tbl_school',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            $data['book'] = $model->getData('tbl_book',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            return view('branch.new-school-book', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function post_new_school_book(Request $request)
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $post = $request->all();
            //echo '<pre>'; print_r($post); exit;
            if ($post['where']['id'] == "") {
                $post['input']['branch_id'] = session::get('branch')->branch_id;
                //insert
                // $check = $model->getData('tbl_school', array('category_url' => $post['input']['category_url']), 'first');
                // if ($check == "") {
                    //insert
                    $sql = $model->insert_data('tbl_book_school', array_merge($post['input'], array('is_active' => '1', 'date_time' => date('Y-m-d', time()))));
                    if ($sql['code'] == 200) {
                        Session::flash('success', 'New school book Insert Successful.');
                    } else {
                        Session::flash('error', 'Getting Error');
                    }
                    //echo '<pre>'; print_r($sql); exit;
                // } else {
                //     Session::flash('warning', $post['input']['name'] . ' Category exits.');

                // }
            } else {
                //update
                $sql = $model->update_data('tbl_book_school', $post['where'], $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update school book Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function All_school_book()
        {
            $url = url()->current();
            if (Session::has('branch')) {
                $model = new BranchModel();
                $branch_id = Session::get('branch')->branch_id;
                $data['title'] = "kids School || Admin";
                $data['nav'] = "all-school-book";
//                $data['class'] = $model->getData('tbl_class','', 'get');
//                $data['subject'] = $model->getData('tbl_subject','', 'get');
//                $data['school'] = $model->getData('tbl_school',array('branch_id'=>Session::get('branch')->branch_id), 'get');
//                $data['book'] = $model->getData('tbl_book',array('branch_id'=>Session::get('branch')->branch_id), 'get');
                $data['data'] = $model->getAllSchoolBook('paginate',array('tbl_book_school.branch_id'=>Session::get('branch')->branch_id,'tbl_book_school.is_delete'=> '1'));
                //echo "<pre>";print_r($data['data']);exit;
                return view('branch.all-school-book', $data);
            } else {
                return redirect('/auth?url=' . $url);
            }
        }
    public function update_school_book()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $data['id'] = $_GET['id'];
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-school";
            $data['class'] = $model->getData('tbl_class','', 'get');
            $data['subject'] = $model->getData('tbl_subject','', 'get');
            $data['school'] = $model->getData('tbl_school',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            $data['book'] = $model->getData('tbl_book',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            $data['details'] = $model->getData('tbl_book_school', array('id' => $_GET['id'],'branch_id'=>Session::get('branch')->branch_id), 'first', array('id' => 'Desc'));
            return view('branch.new-school-book', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function new_upload_course()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-book";
            $data['media'] = $model->getData('tbl_media','', 'get');
            $data['class'] = $model->getData('tbl_class','', 'get');
            $data['subject'] = $model->getData('tbl_subject','', 'get');
            $data['school'] = $model->getData('tbl_school',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            $data['book'] = $model->getData('tbl_book',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            return view('branch.upload-course', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    } 
    public function post_upload_course(Request $request)
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $post = $request->all();
            if($request->hasFile('upload')) {
                $destinationPath ='admin-assets/images/subject_image/';
                $post['input']['upload'] = $this->storeImagesPdf($post['upload'], $destinationPath);
            }
            //echo '<pre>'; print_r($post); exit;
            if ($post['where']['id'] == "") {
                $post['input']['branch_id'] = session::get('branch')->branch_id;
                //insert
                // $check = $model->getData('tbl_school', array('category_url' => $post['input']['category_url']), 'first');
                // if ($check == "") {
                    //insert
                    $sql = $model->insert_data('tbl_book_course', array_merge($post['input'], array('is_active' => '1', 'date_time' => date('Y-m-d', time()))));
                    if ($sql['code'] == 200) {
                        Session::flash('success', 'New book course Insert Successful.');
                    } else {
                        Session::flash('error', 'Getting Error');
                    }
                    //echo '<pre>'; print_r($sql); exit;
                // } else {
                //     Session::flash('warning', $post['input']['name'] . ' Category exits.');

                // }
            } else {
                //update
                $sql = $model->update_data('tbl_book_course', $post['where'], $post['input']);
                if ($sql['code'] == 200) {
                    Session::flash('success', 'Update  book course Successful.');
                } else {
                    Session::flash('error', 'Getting Error');
                }
            }
            return redirect($_SERVER['HTTP_REFERER']);


        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function All_upload_course()
        {
            $url = url()->current();
            if (Session::has('branch')) {
                $model = new BranchModel();
                $branch_id = Session::get('branch')->branch_id;
                $data['title'] = "kids School || Admin";
                $data['nav'] = "all-school-book";
                $data['class'] = $model->getData('tbl_class',array('branch_id'=>Session::get('branch')->branch_id), 'get');
                $data['subject'] = $model->getData('tbl_subject',array('branch_id'=>Session::get('branch')->branch_id), 'get');
                $data['school'] = $model->getData('tbl_school',array('branch_id'=>Session::get('branch')->branch_id), 'get');
                $data['book'] = $model->getData('tbl_book',array('branch_id'=>Session::get('branch')->branch_id), 'get');
                $data['data'] = $model->getAllUploadCourse('paginate',array('tbl_book_course.branch_id'=>Session::get('branch')->branch_id,'tbl_book_course.is_delete'=> '1'));
                //echo "<pre>";print_r($data['data']);exit;
                return view('branch.all-upload-course', $data);
            } else {
                return redirect('/auth?url=' . $url);
            }
        }
    public function update_upload_course()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $data['id'] = $_GET['id'];
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "new-school";
            $data['class'] = $model->getData('tbl_class',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            $data['subject'] = $model->getData('tbl_subject',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            $data['school'] = $model->getData('tbl_school',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            $data['book'] = $model->getData('tbl_book',array('branch_id'=>Session::get('branch')->branch_id), 'get');
            $data['details'] = $model->getData('tbl_book_course', array('id' => $_GET['id']), 'first', array('id' => 'Desc'));
            //echo "<pre>";print_r($data['details']);exit; 
            return view('branch.upload-course', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function Setting()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "setting";
            $check= $model->getData('tbl_setting', array('branch_id'=>Session::get('branch')->branch_id), 'first');
            
            if($check!=""){
                return redirect('branch/setting-detail');
            }
            return view('branch.setting', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function  post_setting(Request $request){
        if(Session::has('branch')){
            $post = $request->all();
            $post['input']['branch_id'] = session::get('branch')->branch_id;
            //echo "<pre>";print_r($post);exit;
            $model = new BranchModel();
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $path = "admin-assets/images/logo/";
                $uploadImage = $this->storeImages($image, $path, 100, 100);
                $post['input']['logo'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            $post['input']['is_active'] = "1";
            $post['input']['date_time'] = date('Y-m-d', time());
            //echo "<pre>";print_r($post);exit;
            $sql = $model->insert_data('tbl_setting',$post['input']);
            //echo "<pre>";print_r($sql);exit;
            if($sql['code'] == 200){
                Session::flash('success', 'setting insert successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect($_SERVER['HTTP_REFERER']);
        }else{
            return redirect('/auth');
        }
    }
    public function Setting_detail()
    {
        $url = url()->current();
        if (Session::has('branch')) {
            $model = new BranchModel();
            $branch_id = Session::get('branch')->branch_id;
            $data['title'] = "kids School || Admin";
            $data['nav'] = "about";
            $data['setting']= $model->getData('tbl_setting', array('branch_id'=>Session::get('branch')->branch_id), 'first');
            //echo "<pre>";print_r(Session::get('branch')->branch_id);exit;
            return view('branch.setting-detail', $data);
        } else {
            return redirect('/auth?url=' . $url);
        }
    }
    public function update_setting($id){
        $url = url()->current();
        if(Session::has('branch')){
        	//echo $id; exit;
            $model = new BranchModel();
            $data['about'] = $model->getData('tbl_setting',array('id'=>$id),'first');
            //echo "<pre>";print_r($data);exit;
            $data["title"] = "kids School || Admin";
            $data['nav'] = "edit-about";
            return view('branch.edit-about-detail' ,$data);
        }else{
            return redirect('/auth?url=' . $url);
        }
    }
    public function post_update_setting(Request $request){
        if(Session::has('branch')){
            $post=$request->all();
            $post['input']['branch_id'] = session::get('branch')->branch_id;
            //echo '<pre>'; print_r($post); exit;
            $model = new BranchModel();
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $path = "admin-assets/images/logo/";
                $uploadImage = $this->storeImages($image, $path, 100, 100);
                $post['input']['logo'] = $path . '/thumbnail_images/' . $uploadImage;
            }
            //echo '<pre>'; print_r($post['input']); exit;
            $post['input']['date_time'] = date('Y-m-d', time());
            $post['input']['is_active'] = "1";
            //echo '<pre>'; print_r($post['input']); exit;
            $sql = $model->update_data_all('tbl_setting',$post['input'],$post['where']);

            if($sql['code'] == 200){
                Session::flash('success', 'setting detail Updated successful.');
            }else{
                Session::flash('error', 'getting error.');
            }
            return redirect('branch/setting-detail');
        }else{
            return redirect('/auth');
        }
    }
}
