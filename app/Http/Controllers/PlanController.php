<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function create(Request $request){
         Plan::create([
            'name'=>$request->name,
            'del'=>false,
            'img_id'=>1,
            'user_id'=>1,
         ]);
        return response()->json(null,204);
    }
    public function get(){
       return response()->json(['data'=>Plan::get()],200)  ;
   }
}
