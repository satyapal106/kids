<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class LoginModel extends Model
{
    public static function loginAdmin($post){
        $data = DB::table('tbl_login')->select('tbl_login.id', 'tbl_login.name', 'tbl_login.email', 'tbl_login.branch_id', 'tbl_login.role_id', 'tbl_role.role_title', 'tbl_role.role_permission')
                ->join('tbl_role', 'tbl_role.id', '=', 'tbl_login.role_id')
                ->where(array('tbl_login.email'=> trim($post['email']), 'tbl_login.password'=> md5($post['password']), 'tbl_login.is_active'=> '1'))->first();
        return $data;
    }
}
