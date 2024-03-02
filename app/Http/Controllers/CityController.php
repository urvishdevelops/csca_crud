<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Validator;
use DB;

class CityController extends Controller
{
    function view()
    {
        return view('backend/admin/city');
    }

    function save(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'country' => 'required',
            'city' => 'required',
            'status' => 'required',
        ]);

        if ($validation->fails()) {
            return ['alert' => "Fill the form properly"];
        }


        $post = $request->all();

        $hid = $post['hid'];

        // state
        if ($hid && $post['state'] == "") {
            $stateObj = City::select('state')
                ->where('id', $post['hid'])
                ->get()->toArray();

            $state = $stateObj[0]['state'];
        } elseif ($post['hid'] && !empty($post['state'])) {
            $state = $post['state'];
        } else {
            $state = $post['state'];
        }


        if (!is_numeric($hid)) {
            City::create([
                'country' => $post['country'],
                'state' => $state,
                'city' => $post['city'],
                'status' => $post['status']
            ]);
            return ['msg' => "Data inserted successfully"];
        } else {
            DB::table('cities')
                ->where('id', $post['hid'])
                ->update([
                    'country' => $post['country'],
                    'state' => $state,
                    'city' => $post['city'],
                    'status' => $post['status']
                ]);

            return ['msg' => "Data updated successfully"];
        }

    }

    function edit(Request $request)
    {
        $post = $request->all();

        $editId = $post['editId'];


        $cityEdit = City::select('*')->where('id', $editId)->get();


        return response()->json(['cityEdit' => $cityEdit]);
    }


    function list()
    {

        $cities = City::all()->toArray();


        $data = [];

        foreach ($cities as $city) {

            // country
            $countryData = DB::table('cities')
                ->join('countries', 'cities.country', '=', 'countries.id')
                ->where('cities.country', $city['country'])
                ->select('countries.country')
                ->get()->toArray();


            $countryStdObj = get_object_vars($countryData[0]);

            $country = $countryStdObj['country'];


            // state
            $stateData = DB::table('cities')
                ->join('states', 'cities.state', '=', 'states.id')
                ->where('cities.state', $city['state'])
                ->select('states.state')
                ->get()->toArray();


            $stateStdObj = get_object_vars($stateData[0]);


            $state = $stateStdObj['state'];



            $data[] = [
                'id' => $city['id'],
                'country' => $country,
                'state' => $state,
                'city' => $city['city'],
                'status' => $city['status'],
                'action' => '<button id="' . $city['id'] . '" class="btn btn-warning edit">Edit</button> |  <button id="' . $city['id'] . '" class="btn btn-danger delete">Delete</button>',
            ];
        }

        return response()->json(['data' => $data]);
    }

    function state_data(Request $request)
    {

        $post = $request->all();

        $country = $post['country'];

        $state_data = State::select('id', 'state')->where('country', $country)->where('status', '!=', -1)->get()->toArray();

        return $state_data;
    }


    function delete(Request $request)
    {
        $post = $request->all();

        $delId = $post['id'];

        $delete = City::find($delId)->delete();

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
