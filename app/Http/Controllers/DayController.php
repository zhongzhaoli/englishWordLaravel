<?php
/*
 * @Author: Custer
 * @Date: 2021-10-16 02:20:57
 * @LastEditors: Custer
 * @LastEditTime: 2021-12-28 10:42:04
 * @Description: file content
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DayController extends Controller
{
    public function index(){
        $list = DB::table("day")->get();
        return response()->json(["code" => 200, "data" => $list, "msg" => "操作成功"], 200);
    }
    public function create(Request $request){
        DB::table("day")->insert([
            "name" => $request->get("name"),
        ]);
        return response()->json(["code" => 200, "data" => "", "msg" => "操作成功"], 200);
    }
    public function saveBook(Request $request){
        // $base_img是获取到前端传递的值
        $base_img = explode('base64,', $request->get("img"));
        //  设置文件路径和命名文件名称
        $output_file = md5(time()) . rand(1, 9999999) . '.jpg';
        $path = 'uploads/user/' . $output_file;
        //  创建将数据流文件写入我们创建的文件内容中
        file_put_contents($path, base64_decode($base_img));
        return $path;
    }
}
