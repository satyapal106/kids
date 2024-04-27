<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class FunctionModel extends Model
{
    public static function getData($table, $where="", $type, $orderby="", $orwhere ="", $groupBy =""){
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
        if($groupBy !=""){
            $sql->groupBy($groupBy);
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
            case 'count':
                $result = $sql->count();
                break;
        }
        return $result;
    }

    public static function getSum($table, $where="", $col){
        $sql = DB::table($table);
        if($where!=""){
            $sql->where($where);
        }

        $result = $sql->sum($col);
        return $result;
    }

    public static function getDataCount($table, $where="", $groupBy=""){
        $sql = DB::table($table);
        if($where!=""){
            $sql->where($where);
        }
        if($groupBy !=""){
            $sql->groupBy($groupBy);
        }

        $result = $sql->count();
        return $result;
    }

    public static function insert_data($table, $insert){
        $sql = DB::table($table)->insertGetId($insert);
        if($sql!=""){
            return array('code'=> 200, 'msg'=> 'Data Insert Successful.', 'last_id'=> $sql);

        }else{
            return array('code'=> 404, 'msg'=> 'Data Not insert');
        }
    }

    public static function insert_multi_data($table, $insert){
        $sql = DB::table($table)->insert($insert);
        if($sql!=""){
            return array('code'=> 200, 'msg'=> 'Data Insert Successful.');

        }else{
            return array('code'=> 404, 'msg'=> 'Data Not insert');
        }
    }

    public static function update_data($table, $where, $data){
        $sql = DB::table($table)->where($where);

        $return = $sql->update($data);
        if($return){
            return array('code'=> 200, 'msg'=> 'Data update success.');

        }else{
            return array('code'=> 404, 'msg'=> 'Data Not update');
        }


    }

    public static function getLastId($table, $col, $where){
        $sql = DB::table($table)->select($col);
        if($where !=""){
            $sql->where($where);
        }
        return $sql->orderBy('id', 'Desc')->first();

    }

    public static function getDataByLike($table, $type='get', $where='', $whereLike=''){
        $sql = DB::table($table);
        if($where !=""){
            $sql->where($where);
        }
        if($whereLike !=""){
            foreach ($whereLike as $key=>$row){
                $sql->where($key, 'LIKE', '%'.$row.'%');
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
}
