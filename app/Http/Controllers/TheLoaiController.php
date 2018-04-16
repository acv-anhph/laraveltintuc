<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TheLoaiController extends Controller
{
    public function get_list()
    {
        return view('admin.theloai.list');
    }
}
