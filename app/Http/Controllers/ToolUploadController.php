<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolUploadController extends Controller
{
    public function index()
    {
        return view('toolupload.index');
    }

    public function store(Request $request)
    {
        // will handle form submission later
    }
}

