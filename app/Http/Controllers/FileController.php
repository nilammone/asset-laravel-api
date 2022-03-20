<?php

namespace App\Http\Controllers;

use Exception;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class FileController extends Controller
{

    // upload
    function upload(Request $request)
    {
        $result = $request->file('file')->store('public');
        return ["result" => $result];
    }

    // delete image
    function deleteimage($filename)
    {

        try {
            Storage::disk('public')->delete($filename);
            return ["result" => "success"];
        } catch (Throwable $e) {
            report($e);

            return ["Error" => $e];
        }
    }
}
