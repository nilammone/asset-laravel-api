<?php

namespace App\Http\Controllers;

use App\Models\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;;

class RoomtypeController extends Controller
{

    public function index()
    {
        return Roomtype::all();
    }


    public function store(Request $request)
    {
        $roomtype = Roomtype::create($request->only('rt_name'));

        return response($roomtype, HttpResponse::HTTP_CREATED);
    }


    public function show(Roomtype $roomtype)
    {
        return $roomtype;
    }


    public function update(Request $request, Roomtype $roomtype)
    {
        $roomtype->update($request->only('rt_name'));

        return response($roomtype, HttpResponse::HTTP_ACCEPTED);
    }


    public function destroy(Roomtype $roomtype)
    {
        $roomtype->delete();

        return response(null, HttpResponse::HTTP_NO_CONTENT);
    }
}
