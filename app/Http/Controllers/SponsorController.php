<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class SponsorController extends Controller
{

    public function index()
    {
        return Sponsor::all();
    }

    public function store(Request $request)
    {
        $sponsor = Sponsor::create($request->only('sps_name'));

        return response($sponsor, HttpResponse::HTTP_CREATED);
    }

    public function show(Sponsor $sponsor)
    {
        return $sponsor;
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        $sponsor->update($request->only('sps_name'));

        return response($sponsor, HttpResponse::HTTP_ACCEPTED);
    }

    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();

        return response(null, HttpResponse::HTTP_NO_CONTENT);
    }
}
