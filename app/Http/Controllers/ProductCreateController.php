<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCreateController extends Controller
{
    public function Index(){
        return view('Components.ProductCreate');
    }
}
