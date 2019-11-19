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
        $num = $request->num;                   // 身份证号码
        $nationality = $request->nationality;   // 民族
        $address = $request->address;           // 住址

//        echo $name;
//        echo $sex;
//        echo $num;
//        echo $nationality;
//        echo $address;

        if(!empty($name) && !empty($num)){
            $sql = DB::table('IDcard')->where('ID_crad', $num)->first();
            if ($sql){
                return response()->json(['message'=>'身份信息已存在', 'code'=> -1, 'status_code'=>422],422);
            }else{
                DB::table('IDcard')->insert(['ID_crad'=>$num,'sex'=>$sex,'name'=>$name,'home'=>$address,'nation'=>$nationality]);
//            $sql = DB::table('IDcard')->where('id',352)->get();
                return response()->json('ok',200);
            }

        }else{
            return response()->json(['message'=>'请补全信息', 'code'=> -1, 'status_code'=>422],422);
        }


    }
}
