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
            'create_date'=> $request->datenow,
            'end_date'=>$request->setdate,
            'plan_id'=> $request->idplan
        ]);
        return response()->json(null,204);
    }
}
