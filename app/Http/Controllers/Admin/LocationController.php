<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\States;
class LocationController extends Controller
{
    /* Countries function */
    public function countries(Request $request){
        $countries = Countries::all();
        return view('Admin.Location.countries',compact('countries'));
    }

    public function addCountry(Request $request){
        if ($request->id != '') {
            $request->validate([
                'country_name' => 'required|unique:countries,country_name,' . $request->id,
                'country_code' => 'required|unique:countries,country_code,' . $request->id,
            ]);
            
            $country = Countries::find($request->id);
            $country->country_name = $request->country_name;
            $country->country_code = $request->country_code;
            $country->save();
    
            return response()->json('Successfully updated Country');
        } else {
            $request->validate([
                'country_name' => 'required|unique:countries',
                'country_code' => 'required|unique:countries',
            ]);
    
            $country = new Countries;
            $country->country_name = $request->country_name;
            $country->country_code = $request->country_code;
            $country->save();
    
            return response()->json('Successfully added Country');
        }
    }


    public function removeCountry(Request $request){
        if ($request->has('id')) {
            $countries = Countries::find($request->id);
            if ($countries) {
                $countries->delete();
                return response()->json('Countries deleted successfully');
            } else {
                return response()->json('Countries not found');
            }
        } else {
            return response()->json('Missing Countries');
        }
    }



    /* States function */
    public function states(Request $request){
        $countries = Countries::all();
        $states = States::with('country')->get();

        return view('Admin.Location.states',compact('countries','states'));
    }

    public function addState(Request $request){
        if ($request->id != '') {
            $request->validate([
                'state_name' => 'required|unique:states,state_name,' . $request->id,
                'country_id' => 'required',
            ]);
            
            $state = States::find($request->id);
            $state->state_name = $request->state_name;
            $state->country_id = $request->country_id;
            $state->save();
    
            return response()->json('Successfully updated State');
        } else {
            $request->validate([
                'state_name' => 'required|unique:states',
                'country_id' => 'required',
            ]);
    
            $state = new States;
            $state->state_name = $request->state_name;
            $state->country_id = $request->country_id;
            $state->save();
    
            return response()->json('Successfully added State');
        }
    }

    public function removeState(Request $request){
        if ($request->has('id')) {
            $states = States::find($request->id);
            if ($states) {
                $states->delete();
                return response()->json('States deleted successfully');
            } else {
                return response()->json('States not found');
            }
        } else {
            return response()->json('Missing States');
        }
    }

}
