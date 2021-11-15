<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;

class AddressController extends Controller
{
    function countries($q)
    {
        return Country::where('name', 'like', "%$q%")->get();
    }

    function states(Request $request)
    {
        return State::where([['country_id', '=', $request->country_id], ['name', 'like', "%$request->name%"]])->get();
    }

    function cities(Request $request)
    {
        return City::where([['state_id', '=', $request->state_id], ['name', 'like', "%$request->name%"]])->get();
    }
}
