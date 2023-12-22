<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
public function index(){
    return view('backend.export.list_export');
}
public function create(){
    return view('backend.export.add_export');
}
}