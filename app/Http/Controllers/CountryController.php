<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Validator;
use DB;

class CountryController extends Controller
{

   function view()
   {
      return view('backend/admin/country');
   }
   function save(Request $request)
   {

      $validation = Validator::make($request->all(), [
         'country' => 'required',
         'status' => 'required',
      ]);

      if ($validation->fails()) {
         return ['alert' => "Fill the form properly"];
      }


      $post = $request->all();

      $hid = $post['hid'];



      if (!is_numeric($hid)) {
         Country::create([
            'country' => $post['country'],
            'status' => $post['status']
         ]);
         return ['msg' => "Data inserted successfully"];
      } else {
         DB::table('countries')
            ->where('id', $post['hid'])
            ->update([
               'country' => $post['country'],
               'status' => $post['status']
            ]);
         return ['msg' => "Data updated successfully"];
      }

   }



   function list()
   {

      $countries = Country::all()->toArray();


      $data = [];

      foreach ($countries as $country) {

         $data[] = [
            'id' => $country['id'],
            'name' => $country['country'],
            'status' => $country['status'],
            'action' => '<button id="' . $country['id'] . '" class="btn btn-warning edit">Edit</button> ||  <button id="' . $country['id'] . '" class="btn btn-danger delete">Delete</button>',
         ];
      }

      return response()->json(['data' => $data]);
   }

   function edit(Request $request)
   {
      $post = $request->all();

      $editId = $post['editId'];


      $countryEdit = Country::select('*')->where('id', $editId)->get();

      return response()->json(['countryEdit' => $countryEdit]);
   }
   function delete(Request $request)
   {
      $post = $request->all();

      $delId = $post['id'];

      $delete = Country::find($delId)->delete();

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
