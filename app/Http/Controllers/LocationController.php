<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getByUid($uid)
    {
        $location = Location::where('uid', $uid)->first();

        return $location;
    }
}
