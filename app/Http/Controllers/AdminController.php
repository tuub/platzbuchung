<?php

namespace App\Http\Controllers;

use App\Closing;
use App\Location;
use App\Resource;
use App\TimeSlot;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public static function getLocations()
    {
        return Location::get();
    }

    public static function getLocation($id)
    {
        return Location::find($id);
    }

    public function saveLocation(Request $request)
    {
        $data = $request->all();
        $op = Location::create($data);
        return $op;
    }

    public function updateLocation(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $op = Location::find($id)->update($data);
        return $op;
    }

    public function deleteLocation(Request $request)
    {
        $id = $request->id;
        $op = Location::find($id)->delete();
        return $op;
    }

    public static function getResources(Request $request)
    {
        //return Location::with('resources')->find($request->location_id);
        return Resource::with('location', 'time_slots')->where('location_id', $request->location_id)->get();
    }

    public static function getResource($id)
    {
        return Resource::find($id);
    }

    public function saveResource(Request $request)
    {
        $data = $request->all();
        $op = Resource::create($data);
        return $op;
    }

    public function updateResource(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $op = Resource::find($id)->update($data);
        return $op;
    }

    public function deleteResource(Request $request)
    {
        $id = $request->id;
        $op = Resource::find($id)->delete();
        return $op;
    }

    public static function getTimeSlots(Request $request)
    {
        return Resource::with('time_slots')->find($request->resource_id);
    }

    public static function getTimeSlot($id)
    {
        return TimeSlot::find($id);
    }

    public function saveTimeSlot(Request $request)
    {
        $data = $request->all();
        $time_slot = TimeSlot::create($data);
        $time_slot->resource()->attach($request->resource_id);

        return true;
    }

    public function updateTimeSlot(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $time_slot = TimeSlot::find($id)->update($data);

        return true;
    }

    public function deleteTimeSlot(Request $request)
    {
        $id = $request->id;
        $op = TimeSlot::find($id)->delete();
        return $op;
    }

    public static function getClosings($location_id)
    {
        return Closing::where('location_id', $location_id)->get();
    }

    public static function getClosing($id)
    {
        return Closing::find($id);
    }

    public function saveClosing(Request $request)
    {
        $data = $request->all();
        $op = Closing::create($data);
        return $op;
    }

    public function updateClosing(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $op = Closing::find($id)->update($data);
        return $op;
    }

    public function deleteClosing(Request $request)
    {
        $id = $request->id;
        $op = Closing::find($id)->delete();
        return $op;
    }

}
