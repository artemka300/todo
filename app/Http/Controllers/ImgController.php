<?php

namespace App\Http\Controllers;

use App\Models\Img;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImgController extends Controller
{
    public function create(Request $request){
      $file =  Storage::url(Storage::put('logoplan', $request->img))    ;
        Img::create([
           'name'=>$request->name,
           'path'=>$file,
        ]);

   }
}
