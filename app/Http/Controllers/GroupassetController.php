<?php

namespace App\Http\Controllers;

use App\Models\Groupasset;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class GroupassetController extends Controller
{

    public function index()
    {
        return Groupasset::all();
    }

    public function getGroupassetOnlyActive()
    {
        return Groupasset::where('gass_status', '=', 'Active')->get();
    }


    public function store(Request $request)
    {
        $groupasset = Groupasset::create($request->only('gass_name', 'gass_status'));

        return response($groupasset, HttpResponse::HTTP_CREATED);
    }


    public function show(Groupasset $groupasset)
    {
        return $groupasset;
    }


    public function update(Request $request, Groupasset $groupasset)
    {
        $groupasset->update($request->only('gass_name', 'gass_status'));

        return response($groupasset, HttpResponse::HTTP_ACCEPTED);
    }


    public function destroy(Groupasset $groupasset)
    {
        $groupasset->delete();

        return response(null, HttpResponse::HTTP_NO_CONTENT);
    }
}
