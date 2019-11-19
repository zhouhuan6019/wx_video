<?php

namespace App\Http\Controllers;
use App\Models\Coding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Coding10Controller extends Controller
{
    public function select(){
        $conding10 = Coding::select(['id','title','image_url'])->get();
        $total = $conding10->count();   //计算总数
        $data = [
            'coding10' => $conding10,
            'total' => $total
        ];
        return $data;
    }
    public function select_id(Request $request){
        $id = $request->input('id');
        $coding10 = Coding::select('id','note','title')->where('id',$id)->first();
        $conding_video = DB::table('c_vido')->select('id','c_title','c_url')->where('coding_id', $id)->get();
        if($conding_video->isEmpty()){
            return response()->json(['message'=>'查询不到任何数据', 'code'=> -1, 'status_code'=>422],422);
        }else{
            $data = array(
                'data' => $coding10,
                'vido' => $conding_video
            );
            return $data;
            //        return response()->json($coding10,201);
        }
    }
    public function video_id(Request $request){
        $coding_id = $request->input('coding_id');
        $coding10 = DB::table('c_vido')->where('id', $coding_id)->value('c_url');
        return $coding10;
    }
    public function search(Request $request){
        $title = $request->input('title');
        $conding = Coding::select('id','image_url')->where('title','like','%'.$title.'%')->get();
        $total = $conding->count();   //计算总数
        $data = [
            'coding' => $conding,
            'total' => $total
        ];
        return $data;
    }
}
