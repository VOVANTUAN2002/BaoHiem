<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $insurances = Insurance::all();

        $params = [
            'insurances' => $insurances,
        ];
        return view('admin.home.index', $params);
    }
}
