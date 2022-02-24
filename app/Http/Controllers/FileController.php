<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    // upload
    function upload(Request $request)
    {
        $result = $request->file('file')->store('public');
        return ["result" => $result];
    }
}
