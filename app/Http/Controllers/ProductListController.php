<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function Index(){
        return view('Components.ProductList');
    }
}
