<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CityRequest;
use App\Http\Models\City;
use App\Http\Models\Country;
use Redirect;

class CityController extends Controller {

    public function index() {
        $cities = City::all();
        return view('admin.city.index', compact('cities'));
    }

    public function create() {
        $countries = Country::lists('name', 'id');
        return view('admin.city.create', compact('countries'));
    }

    public function store(CityRequest $request) {
        $data = $request->all();
        $data['country_code'] = Country::find($data['country_id'])->code;
        City::create($data);
        return Redirect::back()->with('success', 'تم اضافة المدينة بنجاح');
    }

    public function show($id) {
        
    }

    public function edit($id) {
        $countries = Country::lists('name', 'id');
        $city = City::find($id);
        return view('admin.city.edit', compact('city', $city, 'countries', $countries));
    }

    public function update(CityRequest $request, $id) {
        $input = $request->all();
        City::find($id)->update($input);
        return Redirect::back()->with('success', 'تم تعديل البيانات بنجاح');
    }

    public function destroy($id) {
        City::destroy($id);
        return Redirect::back()->with('success', 'تم الحذف بنجاح');
    }

    public function getCity() {
        if (isset($_GET['country']))
            $country = $_GET['country'];
        else
            $country = $_GET['country_code'];

        $cities = City::where('country_code', $country)->get();
        return $cities;
    }

}
