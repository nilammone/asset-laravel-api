<?php

namespace App\Http\Controllers;

use App\Models\Suppiler;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class SuppilerController extends Controller
{

    public function index()
    {
        return Suppiler::all();
    }

    public function store(Request $request)
    {
        $suppiler = Suppiler::create($request->only('sp_name'));

        return response($suppiler, HttpResponse::HTTP_CREATED);
    }


    public function show(Suppiler $suppiler)
    {
        return $suppiler;
    }


    public function update(Request $request, Suppiler $suppiler)
    {
        $suppiler->update($request->only('sp_name'));

        return response($suppiler, HttpResponse::HTTP_ACCEPTED);
    }

    public function destroy(Suppiler $suppiler)
    {
        $suppiler->delete();

        return response(null, HttpResponse::HTTP_NO_CONTENT);
    }
}
