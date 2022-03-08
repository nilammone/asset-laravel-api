<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{

    public function index()
    {
        return Room::all();
    }

    public function getRoomOnlyActive()
    {
        return Room::where('room_status', '=', 'Active')->get();
    }


    public function store(Request $request)
    {
        $room = Room::create($request->only('room_no', 'room_type_id', 'room_status'));

        return response($room, Response::HTTP_CREATED);
    }


    public function show(Room $room)
    {
        return $room;
    }


    public function update(Request $request, Room $room)
    {
        $room->update($request->only('room_no', 'room_type_id', 'room_status'));

        return response($room, Response::HTTP_ACCEPTED);
    }


    public function destroy(Room $room)
    {
        $room->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    // get data from rooms (room_type_id) jion roomtypes (rt_id)
    public function getdataJoinroomtypes()
    {
        return DB::table('rooms')->leftJoin('roomtypes', 'rooms.room_type_id', '=', 'roomtypes.rt_id')->get();
    }
}
