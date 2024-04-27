<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class ApiModel extends Model
{
    public static function student_data($where="",$type="get"){
        $sql=DB::table('tbl_user_login')->select('tbl_school.*','tbl_user_login.user_type','tbl_user_login.id as login_id');
        $sql->join('tbl_school','tbl_school.id','=','tbl_user_login.school_id');
        if($where!=""){
            $sql->where($where);

        }
        switch($type){
            case 'first':
                $result = $sql->first();
                break;
            case 'get':
                $result = $sql->get();
                break;
            case 'paginate':
                $result = $sql->paginate(20);
                break;
        }
        return $result;
    }
}
