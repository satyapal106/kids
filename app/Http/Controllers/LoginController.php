<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\FunctionModel;
use App\Models\LoginModel;
use App\Models\BranchModel;

class LoginController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            return redirect('admin/dashboard');
        }elseif(Session::has('branch')){
            return redirect('branch/branch-dashboard');
        }else{
            $data['title'] = "Login Admin Panel";
            $data['nav'] = "login";
            return view('admin.login', $data);
        } 
    }
    public function loginAdmin(Request $request){
        if(Session::has('admin')){
            return redirect('admin/dashboard');
        }elseif(Session::has('branch')){
            return redirect('branch/branch-dashboard');
        }else{
            $post = $request->all();
            $data = LoginModel::loginAdmin($post);
            if($data->branch_id == 0){
                //echo '<pre>';print_r('admin');
                Session::put('admin',$data);
            }else{
                //echo '<pre>';print_r('branch');
                Session::put('branch',$data);
            }
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function dashboard(){
        if(Session::has('admin')){
            $model = new BranchModel();
            $data['title'] = "Kids || Admin ";
            $data['nav'] = "home";
            $data['data'] = $model->getData('tbl_branch', '', 'get');
            //echo '<pre>'; print_r($data['data']); exit;
            //echo '<pre>'; print_r(Session::get('admin')); exit;
            //echo '<pre>'; print_r(Session::get('admin')); 
            return view('admin.dashboard', $data);
        }else{
            return redirect('/auth');
        }
    }
    public function Logout()
    {

      Session::flush();
      return redirect('auth/')->with('alert', 'You have logged out');
    }
}
