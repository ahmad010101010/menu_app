<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashbardeController extends Controller
{
    public function index() {

        return view('admin.dashboard');
    }
}
