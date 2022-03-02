<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BuildingController extends Controller
{

    public function index()
    {
        return Building::all();
    }


    public function store(Request $request)
    {
        $building = Building::create($request->only('bd_no', 'bd_type_id', 'bd_status'));

        return response($building, Response::HTTP_CREATED);
    }


    public function show(Building $building)
    {
        return $building;
    }


    public function update(Request $request, Building $building)
    {
        $building->update($request->only('bd_no', 'bd_type_id', 'bd_status'));

        return response($building, Response::HTTP_ACCEPTED);
    }


    public function destroy(Building $building)
    {
        $building->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    // get data from buildings bd_type_id join buildingtypes bdt_id
    public function getdataJoinbuildingtypes()
    {
        return DB::table('buildings')->leftJoin('buildingtypes', 'buildings.bd_type_id', '=', 'buildingtypes.bdt_id')->get();
    }
}
