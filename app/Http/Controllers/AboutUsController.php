<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cotillon;

class AboutUsController extends Controller
{
    public function aboutUs(){

    $cotillon=Cotillon::find(1);
     return view('main.pagine.aboutUs')->with('cotillon',$cotillon);
    }
}
