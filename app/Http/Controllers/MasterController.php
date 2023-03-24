<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
ini_set("memory_limit","250M");
class MasterController extends Controller
{
    public function add(Request $request){
//        echo 333;die;
        //接参
        $data = $request->all();
        $this->name = $data['name'];
        $this->age = $data['age'];
        $this->address = $data['address'];
        //验证参数
        $validator = Validator::make($data, [
            'name' => 'required',
            'age' => 'required',
            'address' => 'required|numeric|min:6'
        ]);
        //如若参数错误，终止程序
        if($validator->errors()->all()){
            return "参数格式错误";
        };
//        print_r($data);die;
        DB::transaction(function(){
            $update_data = DB::update('update `my_number` set `name` = "王阳明" where `id` = ?',[2]);
            $mod_data = DB::select('select * from `my_number` where `id` = ?',[1]);

            //将数据入库
            $info = DB::insert('insert into `my_number` (`name`,`age`,`address`) values (?,?,?)', [$this->name,$this->age,$this->address]);
        });
        return "成功";
    }

    public function create_table(){
        return 1234;
        //建session表
//        Schema::create('sessions', function ($table) {
//            $table->string('id')->primary();
//            $table->foreignId('user_id') ->nullable()->index();
//            $table->string('ip_address', 45)->nullable();
//            $table->text('user_agent')->nullable();
//            $table->text('payload');
//            $table->integer('last_activity')->index();
//        });
        //建log日志表
//        Schema::create('log',function($table){
//            $table->integer('id')->primary();
//            $table->foreignId('user_id',10)->nullable()->index();
//            $table->text('log',255);
//            $table->datetime('add_time',0)->default('1001-01-01');
//            $table->timestamp('update_time',0);
//        });
    }
}
