<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Validator;
use DB;

class StateController extends Controller
{
    function view()
    {
        return view('backend/admin/state');
    }

    function save(Request $request)
    {

        $post = $request->all();

        $hid = $post['hid'];

        $validation = Validator::make($request->all(), [
            'country' => 'required',
            'state' => 'required',
            'status' => 'required',
        ]);

        if ($validation->fails()) {
            return ['alert' => "Fill the form properly"];
        }


        if (!is_numeric($hid)) {
            State::create([
                'country' => $post['country'],
                'state' => $post['state'],
                'status' => $post['status']

            ]);
            return ['msg' => "Data inserted successfully"];
        } else {
            DB::table('states')
                ->where('id', $post['hid'])
                ->update([
                    'country' => $post['country'],
                    'state' => $post['state'],
                    'status' => $post['status']
                ]);
            return ['msg' => "Data updated successfully"];
        }
    }

    function edit(Request $request)
    {
        $post = $request->all();

        $editId = $post['editId'];



        $stateEdit = State::select('*')->where('id', $editId)->get();


        return response()->json(['stateEdit' => $stateEdit]);
    }


    function list()
    {

        $states = State::all()->toArray();


        $data = [];



        foreach ($states as $state) {



            // country join
            $countryData = DB::table('states')
                ->join('countries', 'states.country', '=', 'countries.id')
                ->where('states.country', $state['country'])
                ->select('countries.country')
                ->get()
                ->toArray();


            if (isset($countryData)) {
                $countryStdObj = get_object_vars($countryData[0]);
            }


            $data[] = [
                'id' => $state['id'],
                'country' => $countryStdObj ? $countryStdObj['country'] : "",
                'state' => $state['state'],
                'status' => $state['status'],
                'action' => '<button id="' . $state['id'] . '" class="btn btn-warning edit">Edit</button> ||  <button id="' . $state['id'] . '" class="btn btn-danger delete">Delete</button>',
            ];
        }

        return response()->json(['data' => $data]);
    }

    function country_data(Request $request)
    {

        $country_data = Country::select('id', 'country')->where('status', '!=', -1)->get()->toArray();


        return $country_data;

    }


    function delete(Request $request)
    {
        $post = $request->all();

        $delId = $post['id'];

        $delete = State::find($delId)->delete();

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
