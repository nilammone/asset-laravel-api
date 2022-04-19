<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{

    public function index()
    {
        return Asset::all();
    }


    public function store(Request $request)
    {
        $asset = Asset::create($request->only('asset_no', 'asset_name', 'asset_group_id', 'asset_type_id', 'asset_startdate', 'asset_enddate', 'asset_sp_id', 'asset_room_id', 'asset_building_id', 'asset_user_id', 'asset_status', 'asset_create_at', 'asset_move_at', 'asset_clearing_at', 'asset_remark', 'asset_sps_id'));

        return response($asset, Response::HTTP_CREATED);
    }


    public function show(Asset $asset)
    {
        return $asset;
    }


    public function update(Request $request, Asset $asset)
    {
        $asset->update($request->only('asset_no', 'asset_name', 'asset_group_id', 'asset_type_id', 'asset_startdate', 'asset_enddate', 'asset_sp_id', 'asset_room_id', 'asset_building_id', 'asset_user_id', 'asset_status', 'asset_create_at', 'asset_move_at', 'asset_clearing_at', 'asset_remark', 'asset_sps_id'));

        return response($asset, Response::HTTP_ACCEPTED);
    }


    public function destroy(Asset $asset)
    {
        $asset->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    // get data from join all table that relationship
    public function getdataJoinmore()
    {
        return DB::table('assets')
            ->leftJoin('groupassets', 'assets.asset_group_id', '=', 'groupassets.gass_id')
            ->leftJoin('typeassets', 'assets.asset_type_id', '=', 'typeassets.tass_id')
            ->leftJoin('suppilers', 'assets.asset_sp_id', '=', 'suppilers.sp_id')->leftJoin('rooms', 'assets.asset_room_id', '=', 'rooms.room_id')->leftJoin('buildings', 'assets.asset_building_id', '=', 'buildings.bd_id')
            ->leftJoin('mergeuserempdept', 'assets.asset_user_id', '=', 'mergeuserempdept.v1id')
            ->leftJoin('sponsors', 'assets.asset_sps_id', '=', 'sponsors.sps_id')
            ->get();
    }

    // get data from join all table that relationship
    public function getdataJoinmoreActiveByDate($startDate, $endDate)
    {
        return DB::table('assets')
            ->leftJoin('groupassets', 'assets.asset_group_id', '=', 'groupassets.gass_id')
            ->leftJoin('typeassets', 'assets.asset_type_id', '=', 'typeassets.tass_id')
            ->leftJoin('suppilers', 'assets.asset_sp_id', '=', 'suppilers.sp_id')
            ->leftJoin('rooms', 'assets.asset_room_id', '=', 'rooms.room_id')
            ->leftJoin('buildings', 'assets.asset_building_id', '=', 'buildings.bd_id')
            ->leftJoin('mergeuserempdept', 'assets.asset_user_id', '=', 'mergeuserempdept.v1id')
            ->leftJoin('sponsors', 'assets.asset_sps_id', '=', 'sponsors.sps_id')
            ->where('assets.asset_status', '=', 'Active')
            ->where('assets.asset_startdate', '>=', $startDate)
            ->where('assets.asset_startdate', '<=', $endDate)
            ->get();
    }

    // get data from join all table that relationship
    public function getdataJoinmoreActiveNotDate()
    {
        return DB::table('assets')
            ->leftJoin('groupassets', 'assets.asset_group_id', '=', 'groupassets.gass_id')
            ->leftJoin('typeassets', 'assets.asset_type_id', '=', 'typeassets.tass_id')
            ->leftJoin('suppilers', 'assets.asset_sp_id', '=', 'suppilers.sp_id')
            ->leftJoin('rooms', 'assets.asset_room_id', '=', 'rooms.room_id')
            ->leftJoin('buildings', 'assets.asset_building_id', '=', 'buildings.bd_id')
            ->leftJoin('mergeuserempdept', 'assets.asset_user_id', '=', 'mergeuserempdept.v1id')
            ->leftJoin('sponsors', 'assets.asset_sps_id', '=', 'sponsors.sps_id')
            ->where('assets.asset_status', '=', 'Active')
            ->get();
    }

    // get data report all
    public function getDataReportAll($startDate, $endDate)
    {
        $sdata = DB::table('assets')
            ->leftJoin('groupassets', 'assets.asset_group_id', '=', 'groupassets.gass_id')
            ->leftJoin('mergeuserempdept', 'assets.asset_user_id', '=', 'mergeuserempdept.v1id')
            ->where('assets.asset_status', '=', 'Active')
            ->where('assets.asset_startdate', '>=', $startDate)
            ->where('assets.asset_startdate', '<=', $endDate)
            ->groupBy('assets.asset_group_id')
            ->groupBy('assets.asset_user_id')
            ->selectRaw('assets.asset_group_id, assets.asset_user_id, count(*) as total_amount, groupassets.gass_name, mergeuserempdept.v1deptname')
            ->get();

        return $sdata;
    }

    // get data report all not Date
    public function getDataReportAllNotDate()
    {
        $sdata = DB::table('assets')
            ->leftJoin('groupassets', 'assets.asset_group_id', '=', 'groupassets.gass_id')
            ->leftJoin('mergeuserempdept', 'assets.asset_user_id', '=', 'mergeuserempdept.v1id')
            ->where('assets.asset_status', '=', 'Active')
            ->groupBy('assets.asset_group_id')
            ->groupBy('assets.asset_user_id')
            ->selectRaw('assets.asset_group_id, assets.asset_user_id, count(*) as total_amount, groupassets.gass_name, mergeuserempdept.v1deptname')
            ->get();

        return $sdata;
    }
}
