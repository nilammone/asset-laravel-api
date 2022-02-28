<?php

namespace App\Http\Controllers;

use App\Models\Buildingtype;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;;

class BuildingtypeController extends Controller
{

    public function index()
    {
        return Buildingtype::all();
    }


    public function store(Request $request)
    {
        $buildingtype = Buildingtype::create($request->only('bdt_name'));

        return response($buildingtype, HttpResponse::HTTP_CREATED);
    }


    public function show(Buildingtype $buildingtype)
    {
        return $buildingtype;
    }


    public function update(Request $request, Buildingtype $buildingtype)
    {
        $buildingtype->update($request->only('bdt_name'));

        return response($buildingtype, HttpResponse::HTTP_ACCEPTED);
    }


    public function destroy(Buildingtype $buildingtype)
    {
        $buildingtype->delete();

        return response(null, HttpResponse::HTTP_NO_CONTENT);
    }
}
