<?php

namespace App\Http\Controllers;

use App\Models\Typeasset;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class TypeassetController extends Controller
{

    public function index()
    {
        return Typeasset::all();
    }

    public function getTypeassetOnlyActive()
    {
        $gettypeactive = Typeasset::where('tass_status', '=', 'Active')->get();

        return $gettypeactive;
    }

    // get by group asset id
    public function getByGroupassetId($gid)
    {

        $getbygid = Typeasset::where('tass_gass_id', '=', $gid)->get();

        // return Response::json([
        //     'message' => 'success',
        //     'data' => $getbygid
        // ]);
        return $getbygid;
    }


    public function store(Request $request)
    {
        $typeasset = Typeasset::create($request->only('tass_name', 'tass_gass_id', 'tass_status'));

        return response($typeasset, HttpResponse::HTTP_CREATED);
    }


    public function show(Typeasset $typeasset)
    {
        return $typeasset;
    }


    public function update(Request $request, Typeasset $typeasset)
    {
        $typeasset->update($request->only('tass_name', 'tass_gass_id', 'tass_status'));

        return response($typeasset, HttpResponse::HTTP_ACCEPTED);
    }


    public function destroy(Typeasset $typeasset)
    {
        $typeasset->delete();

        return response(null, HttpResponse::HTTP_NO_CONTENT);
    }

    // get data from typeassets join groupassets
    public function getdataJoingroupasset()
    {
        return DB::table('typeassets')->leftJoin('groupassets', 'typeassets.tass_gass_id', '=', 'groupassets.gass_id')->get();
    }
}
