<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    public function dropzone()
    {
        return view('dropzone');
    }
}
