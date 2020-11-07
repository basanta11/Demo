<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function getList(){
        $data=Area::select('name','id')->get();
        foreach($data as $d){
            $d->value=$d->id;
            $d->text=$d->name;

        }
        return response()->json($data);

        }
}
