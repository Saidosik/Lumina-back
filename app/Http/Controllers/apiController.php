<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function form(Request $request){
        dd($request);
    }

    public function forma(Request $request){
        return response()->json([
            "okey letsgo",
            $request->all()
        ]);
    }
    
}
