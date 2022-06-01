<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        Task::create([
            'name'=> $request->name,
            'done'=> false,
            'del'=> false,
            'create_date'=> date("Y-m-d H:i:s"),
            'end_date'=>date("Y-m-d H:i:s",strtotime('+ 1 days')),
            'plan_id'=> 2
        ]);
        return '';
    }
}
