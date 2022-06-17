<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        Task::create([
            'name' => $request->name,
            'done' => false,
            'del' => false,
            'create_date' => $request->datenow,
            'end_date' => $request->setdate,
            'plan_id' => $request->idplan
        ]);
        return response()->json(null, 204);
    }
    public function Update(Request $request)
    {
        Task::where('id', '=', $request->id)->update([
            'done' => (bool)$request->done,
            'del' => (bool)$request->del,
        ]);
        return response()->json(null, 204);
    }
}
