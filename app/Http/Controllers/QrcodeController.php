<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\FunctionModel;
use App\Models\LoginModel;
use App\Models\BranchModel;
class QrcodeController extends Controller
{
    public function branch_site($branch_id){
        $data = FunctionModel::getData('tbl_branch', array('is_active'=> '1', 'id'=> base64_decode($branch_id)), 'first');
        if($data !=""){
            return json_encode(array('code'=> 200, 'data'=> $data));

        }else{
            return json_encode(array('code'=> 410, 'msg'=> 'This site can not reach try again later'));
        }

    }
}
