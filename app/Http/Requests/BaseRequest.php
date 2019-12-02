<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /*
     * 所有请求和响应返回json格式
     *
     * */

   public function wantsJson(){
       return true;
   }
   public function expectsJson(){
       return true;
   }
}
