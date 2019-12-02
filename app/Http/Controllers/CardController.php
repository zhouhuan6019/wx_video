<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function show(Request $request)
    {
        $name = $request->name;                 // 姓名
        $sex = $request->sex;                   // 性别
        $ID_card = $request->num;               // 身份证号码
        $nation = $request->nationality;        // 民族
        $home = $request->address;              // 住址
        $music = $request->music;
//        echo $name;
//        echo $sex;
//        echo $ID_card;
//        echo $nation;
//        echo $home;
//        echo $music;
        if(!empty($name) && !empty($ID_card)){
//            $sql = DB::table('IDcard')->where('ID_card', $ID_card)->where('music', $music)->first();
            $sql = DB::table('IDcard')->where('ID_card', $ID_card)->where('music',$music)->orderBy('id','desc')->get();
            $total = $sql->count();  //统计数量
            if ($total>0){

                return response()->json(['data'=>$sql[0],'message'=>'身份已存在','total'=>$total],201);

            }else{
                DB::table('IDcard')->insert(['ID_card'=>$ID_card,'sex'=>$sex,'name'=>$name,'address'=>$home,'nation'=>$nation, 'music'=>$music]);
                return response()->json('ok',200);
            }

        }else{
            return response()->json(['message'=>'请补全信息', 'code'=> -1, 'status_code'=>422],422);
        }
    }
    public function create(Request $request){
        $name = $request->name;                 // 姓名
        $sex = $request->sex;                   // 性别
        $ID_card = $request->num;               // 身份证号码
        $nation = $request->nationality;        // 民族
        $home = $request->address;              // 住址
        $music = $request->music;

        DB::table('IDcard')->insert(['ID_card'=>$ID_card,'sex'=>$sex,'name'=>$name,'address'=>$home,'nation'=>$nation, 'music'=>$music]);
        return response()->json('ok',200);

    }
}
