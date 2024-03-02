<?php

namespace App\Http\Controllers;

use App\Models\Area;

use App\Models\City;
use Illuminate\Http\Request;
use Validator;
use DB;

class AreaController extends Controller
{
    function view()
    {
        return view('backend/admin/area');
    }

    function save(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'country' => 'required',
            'area' => 'required',
            'status' => 'required',
        ]);

        if ($validation->fails()) {
            return ['alert' => "Fill the form properly"];
        }


        $post = $request->all();

        $hid = $post['hid'];

        $state = $post['state'];


        // state
        if (!empty($hid) && empty($post['state'])) {
            $stateObj = Area::select('state')
                ->where('id', $hid)
                ->get()->toArray();

            $state = $stateObj[0]['state'];

        } elseif ($hid && !empty($post['state'])) {
            $state = $post['state'];
        } else {
            $state = $post['state'];
        }


        // city
        if (!empty($hid) && empty($post['city'])) {
            $cityObj = Area::select('city')
                ->where('id', $hid)
                ->get()->toArray();

            $city = $cityObj[0]['city'];
        } elseif ($hid && !empty($post['city'])) {
            $city = $post['city'];
        } else {
            $city = $post['city'];
        }



        if (!is_numeric($hid)) {
            Area::create([
                'country' => $post['country'],
                'state' => $state,
                'city' => $city,
                'area' => $post['area'],
                'status' => $post['status']
            ]);
            return ['msg' => "Data inserted successfully"];

        } else {
            DB::table('areas')
                ->where('id', $hid)
                ->update([
                    'country' => $post['country'],
                    'state' => $state,
                    'city' => $city,
                    'area' => $post['area'],
                    'status' => $post['status']
                ]);
            return ['msg' => "Data updated successfully"];

        }



    }

    function edit(Request $request)
    {
        $post = $request->all();

        $editId = $post['editId'];


        $areaEdit = Area::select('*')->where('id', $editId)->get();


        return response()->json(['areaEdit' => $areaEdit]);
    }


    function list()
    {

        $areas = Area::all()->toArray();


        $data = [];

        foreach ($areas as $area) {

            // country
            $countryData = DB::table('areas')
                ->join('countries', 'areas.country', '=', 'countries.id')
                ->where('areas.country', $area['country'])
                ->select('countries.country')
                ->get()->toArray();


            $countryStdObj = get_object_vars($countryData[0]);

            $country = $countryStdObj['country'];


            // state
            $stateData = DB::table('areas')
                ->join('states', 'areas.state', '=', 'states.id')
                ->where('areas.state', $area['state'])
                ->select('states.state')
                ->first();


            if (isset($stateData)) {
                $stateStdObj = get_object_vars($stateData);
            }

            // cities

            $cityData = DB::table('areas')
                ->join('cities', 'areas.city', '=', 'cities.id')
                ->where('areas.city', $area['city'])
                ->select('cities.city')
                ->first();


            if (isset($cityData)) {
                $cityStdObj = get_object_vars($cityData);
            }


            $data[] = [
                'id' => $area['id'],
                'country' => $country,
                'state' => $stateStdObj ? $stateStdObj['state'] : '',
                'city' => $cityStdObj ? $cityStdObj['city'] : '',
                'area' => $area['area'],
                'status' => $area['status'],
                'action' => '<button id="' . $area['id'] . '" class="btn btn-warning edit">Edit</button> |  <button id="' . $area['id'] . '" class="btn btn-danger delete">Delete</button>',
            ];
        }

        return response()->json(['data' => $data]);
    }

    function city_data(Request $request)
    {

        $post = $request->all();

        $state = $post['state'];

        $city_data = City::select('id', 'city')->where('state', $state)->where('status', '!=', -1)->get()->toArray();

        return $city_data;
    }


    function delete(Request $request)
    {
        $post = $request->all();

        $delId = $post['id'];

        $delete = Area::find($delId)->delete();




        if ($delete) {
            echo '<pre>';
            print_r("Data deleted successfully");
            die;
        } else {
            echo '<pre>';
            print_r("Issue in query");
            die;
        }
    }
}
