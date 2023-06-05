<?php
/*
 * @Author: Custer
 * @Date: 2021-10-16 00:54:42
 * @LastEditors: Custer
 * @LastEditTime: 2021-12-24 15:18:38
 * @Description: file content
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WordController extends Controller
{
    public function index(){
        $list = DB::table("list")->orderBy("isPhrase", 'ASC')->get();
        return response()->json(["code" => 200, "data" => $list, "msg" => "操作成功"], 200);
    }
    public function create(Request $request){
        DB::table("list")->insert([
            "word" => $request->get("word"),
            "desc" => $request->get("desc"),
            "isPhrase" => $request->get("isPhrase"),
            "day" => $request->get("day")
        ]);
        return response()->json(["code" => 200, "data" => "", "msg" => "操作成功"], 200);
    }
    public function selectDay(Request $request){
        $DBList = DB::table("list");
        if($request->get("selectType") != 0){
            $DBList = $DBList->where("isPhrase", $request->get("selectType") - 1);
        }
        if($request->get("day") == 0){
            $DBList = $DBList->orderBy("isPhrase", 'ASC');
        } else {
            $DBList = $DBList->where(["day" => $request->get("day")])->orderBy("isPhrase", 'ASC');
        }
        if($request->get("start")){
            $DBList = $DBList->where("word", "like", $request->get("start").'%');
        }
        if($request->get("keyword")){
            $kw = $request->get("keyword");
            $list = $DBList->where("word", "like" ,'%'.$kw.'%')->orWhere("desc", "like" ,'%'.$kw.'%')->get();
            return response()->json(["code" => 200, "data" => $list, "msg" => "操作成功"], 200);
        }
        return response()->json(["code" => 200, "data" => $DBList->get(), "msg" => "操作成功"], 200);
    }
}
