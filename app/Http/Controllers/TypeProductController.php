<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class TypeProductController extends Controller
{
    public function type() {
        return response()->json(['data' => Category::all()]);
    }
}
