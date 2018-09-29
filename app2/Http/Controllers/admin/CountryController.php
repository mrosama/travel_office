<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CountryRequest;
use App\Http\Models\Country;
use App\Http\Models\City;
use Redirect;

class CountryController extends Controller {

    public function index() {
        $countries = Country::all();
        return view('admin.country.index', compact('countries', $countries));
    }

    public function create() {
        return view('admin.country.create');
    }

    public function store(CountryRequest $request) {
        $data = $request->all();
        if ($request->hasFile('logo')) {
            if ($request->file('logo')->isValid()) {
                $uploadPath = 'images/country'; // upload Path
                $data['logo'] = uploadFile($uploadPath, $request->file('logo'));
            } else {
                return Redirect::back()->with('error', 'حدث خطأ اثناء رفع الملف يرجى التأكد من نوع الملف المرفوع');
            }
        }
        Country::create($data);
        return Redirect::back()->with('success', 'تم اضافة الدولة بنجاح');
    }

    public function show($id) {
        
    }

    public function edit($id) {
        $country = Country::find($id);
        return view('admin.country.edit', compact('country', $country));
    }

    public function update(CountryRequest $request, $id) {
        $country = Country::find($id);
        $data = $request->all();
        if ($request->hasFile('logo')) {
            if ($request->file('logo')->isValid()) {
                $uploadPath = 'images/country'; // upload Path
                $data['logo'] = uploadFile($uploadPath, $request->file('logo'));

                // after upload new image remove old
                \File::delete($country->logo);
            } else {
                return Redirect::back()->with('error', 'حدث خطأ اثناء رفع الملف يرجى التأكد من نوع الملف المرفوع');
            }
        }
        $country->update($data);
        return Redirect::back()->with('success', 'تم تعديل البيانات بنجاح');
    }

    public function destroy($id) {

        $country = Country::find($id);
        Country::destroy($id);
        \File::delete($country->logo); // after destroy Country remove Image related with
        City::where('country_code', $country->code)->delete(); // after destroy Country remove City related with
        return Redirect::back()->with('success', 'تم الحذف بنجاح');
    }

}
