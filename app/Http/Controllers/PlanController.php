<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function create(Request $request)
    {
        Plan::create([
            'name' => $request->name,
            'del' => false,
            'img_id' => $request->imgid,
            'user_id' => 1,
        ]);
        return response()->json(null, 204);
    }
    public function get()
    {
        return response()->json(['data' => Plan::get()], 200);
    }
    public function editname(Request $request)
    {
        Plan::where('id', '=', $request->id)->update([
            'name' => $request->name
        ]);
        return response()->json(null, 204);
    }
    public function delete(Request $request)
    {
        Plan::where('id', '=', $request->id)->delete();
        return response()->json(null, 204);
    }
}
