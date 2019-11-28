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
        $ID_crad = $request->num;               // 身份证号码
        $nation = $request->nationality;        // 民族
        $home = $request->address;              // 住址
        $music = $request->music;
//        echo $name;
//        echo $sex;
//        echo $ID_crad;
//        echo $nation;
//        echo $home;
//        echo $music;
        if(!empty($name) && !empty($ID_crad)){
            $sql = DB::table('IDcard')->where('ID_crad', $ID_crad)->first();
            if ($sql){
                    $data = [
                        'data' => [
                            'crad' => $sql->ID_crad,
                            'name' => $sql->name,
                            'music' => $sql->music,
                            'createtime' => $sql->created_at,
                        ],
                        'message' => '身份信息已存在'
                    ];
                return response()->json($data,201);
//                return response()->json(['message'=>'身份信息已存在是否继续添加', 'code'=> -1, 'status_code'=>422],200);
            }else{
                DB::table('IDcard')->insert(['ID_crad'=>$ID_crad,'sex'=>$sex,'name'=>$name,'home'=>$home,'nation'=>$nation, 'music'=>$music]);
//            $sql = DB::table('IDcard')->where('id',352)->get();
                return response()->json('ok',200);
            }

        }else{
            return response()->json(['message'=>'请补全信息', 'code'=> -1, 'status_code'=>422],422);
        }
    }
    public function create(Request $request){
        $name = $request->name;                 // 姓名
        $sex = $request->sex;                   // 性别
        $ID_crad = $request->num;               // 身份证号码
        $nation = $request->nationality;        // 民族
        $home = $request->address;              // 住址
        $music = $request->music;

        DB::table('IDcard')->insert(['ID_crad'=>$ID_crad,'sex'=>$sex,'name'=>$name,'home'=>$home,'nation'=>$nation, 'music'=>$music]);
        return response()->json('ok',200);

    }
}
