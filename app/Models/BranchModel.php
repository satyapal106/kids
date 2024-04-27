<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class BranchModel extends Model
{
    function getData($table, $where="", $type, $orderby="", $orwhere =""){
        $sql = DB::table($table);
        if($where!=""){
            $sql->where($where);
        }
        if($orwhere !=""){
            $sql->orWhere($orwhere);
        }
        if($orderby !=""){
            foreach ($orderby as $key=>$row){
                $sql->orderBy($key, $row);
            }
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

    function insert_data($table, $insert){
        $sql = DB::table($table)->insertGetId($insert);
        if($sql!=""){
            return array('code'=> 200, 'msg'=> 'Data Insert Successful.', 'last_id'=> $sql);

        }else{
            return array('code'=> 404, 'msg'=> 'Data Not insert');
        }
    }
    function delete_data($table,$where){
        $sql = DB::table($table)->where($where)->delete();
        if($sql){
            $result = array('code'=>200, 'msg'=>'deleted successful..');
        }else{
            $result = array('code'=>400, 'msg'=>'deleted error');
        }
        return $result;
    }
    function update_data($table, $where, $data){
        $sql = DB::table($table)->where($where)->update($data);
        if($sql){
            return array('code'=> 200, 'msg'=> 'Data update success.');

        }else{
            return array('code'=> 404, 'msg'=> 'Data Not update');
        }
	}
    function update_data_all($table, $data, $where){
        $sql = DB::table($table)->where($where)->update($data);
        if($sql){
            $result = array('code'=>200, 'msg'=>'update successful..');
        }else{
            $result = array('code'=>400, 'msg'=>'update error');
        }
        return $result;
    }
    function getLastId($table, $col, $where=""){
        $sql = DB::table($table)->select($col);
        if($where !=""){
            $sql->where($where);
        }
        return $sql->orderBy('id', 'Desc')->first();
    }
    function getClass($id){
        $sql = DB::table('tbl_class')
                ->select('tbl_class.*','tbl_branch.id')
                ->join('tbl_branch', '.tbl_branch.id', '=', 'tbl_class.id')
                ->where(array('tbl_intrested.interested_to' =>$id, 'tbl_intrested.is_active' => '2'))
                //->orwhere(array('tbl_intrested.interested_form' =>$interested_form,'tbl_intrested.is_active' => '2'))*/
                ->get();
            echo "<pre>"; print_r( $sql); exit;
        return $sql;
    }
    function getAllNotes($type, $where="", $like="", $limit="", $orderBy=""){
        $sql = DB::table('tbl_notes')
                ->select('tbl_notes.*','tbl_class.class','tbl_subject.subject','tbl_school.name')
                ->leftJoin('tbl_school', 'tbl_school.id', '=', 'tbl_notes.school_id')
                ->leftJoin('tbl_class', 'tbl_class.id', '=', 'tbl_notes.class_id')
                ->leftJoin('tbl_subject', 'tbl_subject.id', '=', 'tbl_notes.subject_id');
        if($where != ""){
            $sql->where($where);
        }
        if($like !=""){
            foreach ($like as $key=>$row){
                if($row !=""){
                    $sql->where($key, 'LIKE', '%'.$row.'%');
                }

            }

        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){
            $result = $sql->first();
        }else if($type == "get"){
            if($limit !=""){
                $sql->limit($limit);
            }
            $result = $sql->get();
        }else if($type == 'paginate'){
            $result = $sql->paginate(20);
        }
        return $result;
    }
    function getAllBook($type, $where="", $like="", $limit="", $orderBy=""){
        $sql = DB::table('tbl_book')
                ->select('tbl_book.*','tbl_class.class','tbl_subject.subject')
                ->leftJoin('tbl_class', 'tbl_class.id', '=', 'tbl_book.class_id')
                ->leftJoin('tbl_subject', 'tbl_subject.id', '=', 'tbl_book.subject_id');
            if($where != ""){
            $sql->where($where);
        }
        if($like !=""){
            foreach ($like as $key=>$row){
                if($row !=""){
                    $sql->where($key, 'LIKE', '%'.$row.'%');
                }

            }

        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){
            $result = $sql->first();
        }else if($type == "get"){
            if($limit !=""){
                $sql->limit($limit);
            }
            $result = $sql->get();
        }else if($type == 'paginate'){
            $result = $sql->paginate(20);
        }
        return $result;
    }
    public static function getAllSchoolBook($type='get', $where="", $like="", $limit="", $orderBy=""){
        $sql = DB::table('tbl_book_school')
                ->select('tbl_book_school.id as school_book_id','tbl_class.class','tbl_subject.subject','tbl_subject.subject_url','tbl_school.name','tbl_book.*','tbl_book_course.book_id')
                ->Join('tbl_class', 'tbl_class.id', '=', 'tbl_book_school.class_id')
                ->Join('tbl_subject', 'tbl_subject.id', '=', 'tbl_book_school.subject_id')
                ->Join('tbl_school', 'tbl_school.id', '=', 'tbl_book_school.school_id')
                ->Join('tbl_book', 'tbl_book.id', '=', 'tbl_book_school.book_id')
                ->Join('tbl_book_course', 'tbl_book_course.book_id', '=', 'tbl_book.id');
        if($where != ""){
            $sql->where($where);
        }
        if($like !=""){
            foreach ($like as $key=>$row){
                if($row !=""){
                    $sql->where($key, 'LIKE', '%'.$row.'%');
                }

            }

        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){
            $result = $sql->first();
        }else if($type == "get"){
            if($limit !=""){
                $sql->limit($limit);
            }
            $result = $sql->get();
        }else if($type == 'paginate'){
            $result = $sql->paginate(20);
        }
        return $result;
    }
    function getAllUploadCourse($type, $where="", $like="", $limit="", $orderBy=""){
        $sql = DB::table('tbl_book_course')
                ->select('tbl_book_course.id as course_id','tbl_book_course.*','tbl_class.class','tbl_subject.*','tbl_school.name','tbl_book.*')
                ->leftJoin('tbl_school', 'tbl_school.id', '=', 'tbl_book_course.school_id')
                ->leftJoin('tbl_class', 'tbl_class.id', '=', 'tbl_book_course.class_id')
                ->leftJoin('tbl_subject', 'tbl_subject.id', '=', 'tbl_book_course.subject_id')
                ->leftJoin('tbl_book', 'tbl_book.id', '=', 'tbl_book_course.book_id');
        if($where != ""){
            $sql->where($where);
        }
        if($like !=""){
            foreach ($like as $key=>$row){
                if($row !=""){
                    $sql->where($key, 'LIKE', '%'.$row.'%');
                }

            }

        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){
            $result = $sql->first();
        }else if($type == "get"){
            if($limit !=""){
                $sql->limit($limit);
            }
            $result = $sql->get();
        }else if($type == 'paginate'){
            $result = $sql->paginate(20);
        }
        return $result;
    }
//    function getAllSchool($type, $where="", $like="", $limit="", $orderBy=""){
//        $sql = DB::table('tbl_school')
//                ->select('tbl_school.*','tbl_branch.branch')
//                ->leftJoin('tbl_branch', 'tbl_branch.id', '=', 'tbl_school.branch_id');
//                ->leftJoin('tbl_user_login', 'tbl_user_login.id', '=', 'tbl_school.branch_id');
//           if($where != ""){
//            $sql->where($where);
//        }
//        if($like !=""){
//            foreach ($like as $key=>$row){
//                if($row !=""){
//                    $sql->where($key, 'LIKE', '%'.$row.'%');
//                }
//
//            }
//
//        }
//        if($orderBy !=""){
//            foreach ($orderBy as $key=>$row){
//                $sql->orderBy($key, $row);
//            }
//        }
//        if($type == 'first'){
//            $result = $sql->first();
//        }else if($type == "get"){
//            if($limit !=""){
//                $sql->limit($limit);
//            }
//            $result = $sql->get();
//        }else if($type == 'paginate'){
//            $result = $sql->paginate(20);
//        }
//        return $result;
//    }
    public static function getAllSchool($type, $where="", $like="", $limit="", $orderBy=""){
        //echo '<pre>'; print_r( 'getAllSchool'); exit;
        $sql = DB::table('tbl_school')
            ->select('tbl_school.id as school_id','tbl_school.*','tbl_branch.id as branch_id','tbl_branch.branch')
            ->leftJoin('tbl_branch', 'tbl_branch.id', '=', 'tbl_school.branch_id');
        if($where != ""){
            $sql->where($where);
        }
        if($like !=""){
            foreach ($like as $key=>$row){
                if($row !=""){
                    $sql->where($key, 'LIKE', '%'.$row.'%');
                }

            }

        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){
            $result = $sql->first();
        }else if($type == "get"){
            if($limit !=""){
                $sql->limit($limit);
            }
            $result = $sql->get();
        }else if($type == 'paginate'){
            $result = $sql->paginate(20);
        }
        return $result;
    }
    function getLogin($type, $where="", $like="", $limit="", $orderBy=""){
        //echo '<pre>'; print_r( 'getAllSchool'); exit;
        $sql = DB::table('tbl_user_login')
            ->select('tbl_user_login.*','tbl_school.id','tbl_branch.id')
            ->leftJoin('tbl_branch', 'tbl_branch.id', '=', 'tbl_user_login.branch_id')
            ->leftJoin('tbl_school', 'tbl_school.id', '=', 'tbl_user_login.school_id');
        if($where != ""){
            $sql->where($where);
        }
        if($like !=""){
            foreach ($like as $key=>$row){
                if($row !=""){
                    $sql->where($key, 'LIKE', '%'.$row.'%');
                }

            }

        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){
            $result = $sql->first();
        }else if($type == "get"){
            if($limit !=""){
                $sql->limit($limit);
            }
            $result = $sql->get();
        }else if($type == 'paginate'){
            $result = $sql->paginate(20);
        }
        return $result;
    }
    function getschoolClass($type, $where="", $like="", $limit="", $orderBy=""){
        //echo '<pre>'; print_r( 'getAllSchool'); exit;
        $sql = DB::table('tbl_book_school')
            ->select('tbl_book_school.*','tbl_class.*','tbl_subject.*','tbl_book.*','tbl_branch.id')
            ->leftJoin('tbl_class', 'tbl_class.id', '=', 'tbl_book_school.class_id')
            ->leftJoin('tbl_subject', 'tbl_subject.id', '=', 'tbl_book_school.subject_id')
            ->leftJoin('tbl_book', 'tbl_book.id', '=', 'tbl_book_school.book_id')
            ->leftJoin('tbl_branch', 'tbl_branch.id', '=', 'tbl_book_school.branch_id');
        if($where != ""){
            $sql->where($where);
        }
        if($like !=""){
            foreach ($like as $key=>$row){
                if($row !=""){
                    $sql->where($key, 'LIKE', '%'.$row.'%');
                }

            }

        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){
            $result = $sql->first();
        }else if($type == "get"){
            if($limit !=""){
                $sql->limit($limit);
            }
            $result = $sql->get();
        }else if($type == 'paginate'){
            $result = $sql->paginate(20);
        }
        return $result;
    }
    function getschoolbookbyclassid($type, $where="", $like="", $limit="", $orderBy=""){
        echo '<pre>'; print_r( 'getschoolbookbyclassid'); exit;
        $sql = DB::table('tbl_book_school')
            ->select('tbl_book_school.*','tbl_class.*','tbl_subject.*','tbl_book.*','tbl_branch.id')
            ->leftJoin('tbl_class', 'tbl_class.id', '=', 'tbl_book_school.class_id')
            ->leftJoin('tbl_subject', 'tbl_subject.id', '=', 'tbl_book_school.subject_id')
            ->leftJoin('tbl_book', 'tbl_book.id', '=', 'tbl_book_school.book_id')
            >leftJoin('tbl_book_school', 'tbl_book_school.subject_id', '=', 'tbl_book_course.subject_id')
            ->leftJoin('tbl_branch', 'tbl_branch.id', '=', 'tbl_book_school.branch_id');
        if($where != ""){
            $sql->where($where);
        }
        if($like !=""){
            foreach ($like as $key=>$row){
                if($row !=""){
                    $sql->where($key, 'LIKE', '%'.$row.'%');
                }

            }

        }
        if($orderBy !=""){
            foreach ($orderBy as $key=>$row){
                $sql->orderBy($key, $row);
            }
        }
        if($type == 'first'){
            $result = $sql->first();
        }else if($type == "get"){
            if($limit !=""){
                $sql->limit($limit);
            }
            $result = $sql->get();
        }else if($type == 'paginate'){
            $result = $sql->paginate(20);
        }
        return $result;
    }
}
